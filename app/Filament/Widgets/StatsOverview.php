<?php

namespace App\Filament\Widgets;

use App\Models\ContactInquiry;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Services', Service::active()->count())
                ->description('Active services')
                ->icon('heroicon-o-wrench-screwdriver')
                ->color('primary'),

            Stat::make('Projects', Project::count())
                ->description('Portfolio projects')
                ->icon('heroicon-o-briefcase')
                ->color('success'),

            Stat::make('Blog Posts', Post::published()->count())
                ->description(Post::whereNull('published_at')->count() . ' drafts')
                ->icon('heroicon-o-document-text')
                ->color('info'),

            Stat::make('Inquiries', ContactInquiry::count())
                ->description(ContactInquiry::whereNull('read_at')->count() . ' unread')
                ->icon('heroicon-o-envelope')
                ->color('warning'),
        ];
    }
}
