<?php

namespace App\Filament\Pages;

use App\Models\PageView;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class Analytics extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'System';
    protected static ?int    $navigationSort  = 3;
    protected static ?string $navigationLabel = 'Analytics';
    protected static string  $view            = 'filament.pages.analytics';

    public string $range = '30';

    public function getViewData(): array
    {
        $days  = (int) $this->range;
        $from  = now()->subDays($days - 1)->startOfDay();

        // ── Summary cards ──────────────────────────────────────────────
        $totalRange = PageView::where('created_at', '>=', $from)->count();
        $today      = PageView::whereDate('created_at', today())->count();
        $yesterday  = PageView::whereDate('created_at', today()->subDay())->count();
        $thisWeek   = PageView::where('created_at', '>=', now()->startOfWeek())->count();

        // ── Daily visits (last N days) ──────────────────────────────────
        $daily = PageView::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as visits')
            )
            ->where('created_at', '>=', $from)
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('visits', 'date');

        $dailyLabels = [];
        $dailyData   = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = now()->subDays($i)->format('Y-m-d');
            $dailyLabels[] = now()->subDays($i)->format('M d');
            $dailyData[]   = $daily[$d] ?? 0;
        }

        // ── By hour of day ──────────────────────────────────────────────
        $hourly = PageView::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as visits')
            )
            ->where('created_at', '>=', $from)
            ->groupBy('hour')
            ->pluck('visits', 'hour');

        $hourlyLabels = array_map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00', range(0, 23));
        $hourlyData   = array_map(fn($h) => $hourly[$h] ?? 0, range(0, 23));

        // ── By day of week ──────────────────────────────────────────────
        $weekday = PageView::select(
                DB::raw('DAYOFWEEK(created_at) as dow'),
                DB::raw('COUNT(*) as visits')
            )
            ->where('created_at', '>=', $from)
            ->groupBy('dow')
            ->pluck('visits', 'dow');

        $dowNames = [1 => 'Sun', 2 => 'Mon', 3 => 'Tue', 4 => 'Wed', 5 => 'Thu', 6 => 'Fri', 7 => 'Sat'];
        $weekdayLabels = array_values($dowNames);
        $weekdayData   = array_map(fn($d) => $weekday[$d] ?? 0, array_keys($dowNames));

        // ── Top pages ───────────────────────────────────────────────────
        $topPages = PageView::select('page', DB::raw('COUNT(*) as visits'))
            ->where('created_at', '>=', $from)
            ->groupBy('page')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        // ── Top countries ───────────────────────────────────────────────
        $countries = PageView::select('country', 'country_code', DB::raw('COUNT(*) as visits'))
            ->where('created_at', '>=', $from)
            ->whereNotNull('country')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        // ── By continent ────────────────────────────────────────────────
        $continents = PageView::select('continent', DB::raw('COUNT(*) as visits'))
            ->where('created_at', '>=', $from)
            ->whereNotNull('continent')
            ->groupBy('continent')
            ->orderByDesc('visits')
            ->get();

        $continentLabels = $continents->pluck('continent')->toArray();
        $continentData   = $continents->pluck('visits')->toArray();

        // ── By device ───────────────────────────────────────────────────
        $devices = PageView::select('device', DB::raw('COUNT(*) as visits'))
            ->where('created_at', '>=', $from)
            ->groupBy('device')
            ->orderByDesc('visits')
            ->get();

        return compact(
            'totalRange', 'today', 'yesterday', 'thisWeek', 'days',
            'dailyLabels', 'dailyData',
            'hourlyLabels', 'hourlyData',
            'weekdayLabels', 'weekdayData',
            'topPages', 'countries',
            'continentLabels', 'continentData',
            'devices'
        );
    }
}
