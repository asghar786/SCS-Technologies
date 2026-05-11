<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    // Skip these path prefixes
    private const SKIP_PREFIXES = ['admin', 'livewire', '_debugbar', 'telescope', 'horizon'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            $this->record($request);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET')) return false;
        if ($response->getStatusCode() !== 200) return false;
        if ($request->ajax()) return false;

        $path = ltrim($request->path(), '/');
        foreach (self::SKIP_PREFIXES as $prefix) {
            if (str_starts_with($path, $prefix)) return false;
        }

        // Skip bots
        $ua = strtolower($request->userAgent() ?? '');
        foreach (['bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'wget', 'curl'] as $bot) {
            if (str_contains($ua, $bot)) return false;
        }

        return true;
    }

    private function record(Request $request): void
    {
        try {
            $ip       = $request->ip();
            $location = $this->getLocation($ip);
            $ua       = $request->userAgent() ?? '';

            PageView::create([
                'url'        => substr($request->fullUrl(), 0, 500),
                'page'       => '/' . ltrim($request->path(), '/'),
                'ip'         => $ip,
                'country'    => $location['country']      ?? null,
                'country_code' => $location['countryCode'] ?? null,
                'continent'  => $location['continent']    ?? null,
                'region'     => $location['regionName']   ?? null,
                'city'       => $location['city']         ?? null,
                'device'     => $this->detectDevice($ua),
                'browser'    => $this->detectBrowser($ua),
                'referrer'   => substr($request->headers->get('referer', ''), 0, 500) ?: null,
                'session_id' => session()->getId(),
            ]);
        } catch (\Throwable) {
            // Never break the page over analytics
        }
    }

    private function getLocation(string $ip): array
    {
        if (in_array($ip, ['127.0.0.1', '::1', 'localhost'])) {
            return ['country' => 'Local', 'countryCode' => 'LC', 'continent' => 'Local', 'regionName' => 'Local', 'city' => 'Local'];
        }

        return Cache::remember("geo_{$ip}", now()->addDays(7), function () use ($ip) {
            try {
                $json = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country,countryCode,continent,regionName,city", false,
                    stream_context_create(['http' => ['timeout' => 2]])
                );
                return $json ? (array) json_decode($json, true) : [];
            } catch (\Throwable) {
                return [];
            }
        });
    }

    private function detectDevice(string $ua): string
    {
        $ua = strtolower($ua);
        if (preg_match('/tablet|ipad|playbook|silk/i', $ua)) return 'tablet';
        if (preg_match('/mobile|android|iphone|ipod|blackberry|phone|windows phone/i', $ua)) return 'mobile';
        return 'desktop';
    }

    private function detectBrowser(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Edg')     => 'Edge',
            str_contains($ua, 'OPR') || str_contains($ua, 'Opera') => 'Opera',
            str_contains($ua, 'Chrome')  => 'Chrome',
            str_contains($ua, 'Firefox') => 'Firefox',
            str_contains($ua, 'Safari')  => 'Safari',
            str_contains($ua, 'MSIE') || str_contains($ua, 'Trident') => 'IE',
            default => 'Other',
        };
    }
}
