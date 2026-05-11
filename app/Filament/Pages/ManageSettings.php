<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'System';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Site Settings';
    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->tabs([

                    Tabs\Tab::make('General')->schema([
                        TextInput::make('site_name')->label('Site Name')->required(),
                        TextInput::make('tagline')->label('Tagline'),
                        TextInput::make('phone')->label('Phone'),
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('address_miami')->label('Address — Miami'),
                        TextInput::make('address_orlando')->label('Address — Orlando'),
                        TextInput::make('address_sc')->label('Address — Florence SC'),
                        TextInput::make('address_tx')->label('Address — San Antonio TX'),
                        Textarea::make('footer_about')->label('Footer About Text')->rows(3)->columnSpanFull(),
                    ])->columns(2),

                    Tabs\Tab::make('Social Media')->schema([
                        TextInput::make('facebook')->label('Facebook URL')->url()->prefixIcon('heroicon-o-link'),
                        TextInput::make('twitter')->label('Twitter / X URL')->url()->prefixIcon('heroicon-o-link'),
                        TextInput::make('linkedin')->label('LinkedIn URL')->url()->prefixIcon('heroicon-o-link'),
                        TextInput::make('youtube')->label('YouTube URL')->url()->prefixIcon('heroicon-o-link'),
                        TextInput::make('instagram')->label('Instagram URL')->url()->prefixIcon('heroicon-o-link'),
                    ])->columns(2),

                    Tabs\Tab::make('Hero Slides')->schema([
                        TextInput::make('hero_title_1')->label('Slide 1 — Title'),
                        TextInput::make('hero_subtitle_1')->label('Slide 1 — Subtitle'),
                        TextInput::make('hero_title_2')->label('Slide 2 — Title'),
                        TextInput::make('hero_subtitle_2')->label('Slide 2 — Subtitle'),
                        TextInput::make('hero_title_3')->label('Slide 3 — Title'),
                        TextInput::make('hero_subtitle_3')->label('Slide 3 — Subtitle'),
                    ])->columns(2),

                    Tabs\Tab::make('Stats')->schema([
                        TextInput::make('stat_years')->label('Years in Business'),
                        TextInput::make('stat_employees')->label('Employees'),
                        TextInput::make('stat_projects')->label('Completed Projects'),
                        TextInput::make('stat_states')->label('States Served'),
                    ])->columns(2),

                    Tabs\Tab::make('SEO')->schema([
                        TextInput::make('seo_title')->label('Meta Title')->columnSpanFull(),
                        Textarea::make('seo_description')->label('Meta Description')->rows(3)->columnSpanFull(),
                        Textarea::make('seo_keywords')->label('Meta Keywords')->rows(2)->columnSpanFull(),
                    ])->columns(1),

                    Tabs\Tab::make('Branding')->schema([
                        FileUpload::make('logo')
                            ->label('Site Logo')
                            ->image()
                            ->directory('branding')
                            ->helperText('Replaces the text logo in the navigation'),
                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->directory('branding')
                            ->helperText('Browser tab icon (.png or .ico, 32×32 recommended)'),
                    ])->columns(2),

                    Tabs\Tab::make('Analytics')->schema([
                        TextInput::make('google_analytics_id')
                            ->label('Google Analytics ID')
                            ->placeholder('G-XXXXXXXXXX')
                            ->helperText('Your GA4 Measurement ID from Google Analytics'),
                        TextInput::make('clarity_id')
                            ->label('Microsoft Clarity ID')
                            ->placeholder('xxxxxxxxxx')
                            ->helperText('Your Clarity Project ID from clarity.microsoft.com'),
                    ])->columns(2),

                ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $now  = now();

        $rows = array_map(
            fn ($k, $v) => ['key' => $k, 'value' => $v ?? '', 'created_at' => $now, 'updated_at' => $now],
            array_keys($data),
            array_values($data)
        );

        Setting::upsert($rows, ['key'], ['value', 'updated_at']);
        cache()->forget('site_settings');

        Notification::make()->title('Settings saved successfully')->success()->send();
    }
}
