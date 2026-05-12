<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
                        TextInput::make('facebook')->label('Facebook URL')->prefixIcon('heroicon-o-link')->placeholder('https://facebook.com/yourpage'),
                        TextInput::make('twitter')->label('Twitter / X URL')->prefixIcon('heroicon-o-link')->placeholder('https://twitter.com/yourhandle'),
                        TextInput::make('linkedin')->label('LinkedIn URL')->prefixIcon('heroicon-o-link')->placeholder('https://linkedin.com/company/yourpage'),
                        TextInput::make('youtube')->label('YouTube URL')->prefixIcon('heroicon-o-link')->placeholder('https://youtube.com/@yourchannel'),
                        TextInput::make('instagram')->label('Instagram URL')->prefixIcon('heroicon-o-link')->placeholder('https://instagram.com/yourhandle'),
                        TextInput::make('tiktok')->label('TikTok URL')->prefixIcon('heroicon-o-link')->placeholder('https://tiktok.com/@yourhandle'),
                        TextInput::make('pinterest')->label('Pinterest URL')->prefixIcon('heroicon-o-link')->placeholder('https://pinterest.com/yourprofile'),
                        TextInput::make('threads')->label('Threads URL')->prefixIcon('heroicon-o-link')->placeholder('https://threads.net/@yourhandle'),
                    ])->columns(2),

                    Tabs\Tab::make('Hero Slides')->schema([
                        Section::make('Slide 1')->schema([
                            TextInput::make('hero_title_1')->label('Title'),
                            TextInput::make('hero_subtitle_1')->label('Subtitle'),
                            FileUpload::make('hero_image_1')
                                ->label('Desktop Background (1920×900)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 1920×900 (landscape).')
                                ->columnSpan(1),
                            FileUpload::make('hero_image_1_mobile')
                                ->label('Mobile Background (768×1024)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 768×1024 (portrait).')
                                ->columnSpan(1),
                        ])->columns(2),
                        Section::make('Slide 2')->schema([
                            TextInput::make('hero_title_2')->label('Title'),
                            TextInput::make('hero_subtitle_2')->label('Subtitle'),
                            FileUpload::make('hero_image_2')
                                ->label('Desktop Background (1920×900)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 1920×900 (landscape).')
                                ->columnSpan(1),
                            FileUpload::make('hero_image_2_mobile')
                                ->label('Mobile Background (768×1024)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 768×1024 (portrait).')
                                ->columnSpan(1),
                        ])->columns(2),
                        Section::make('Slide 3')->schema([
                            TextInput::make('hero_title_3')->label('Title'),
                            TextInput::make('hero_subtitle_3')->label('Subtitle'),
                            FileUpload::make('hero_image_3')
                                ->label('Desktop Background (1920×900)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 1920×900 (landscape).')
                                ->columnSpan(1),
                            FileUpload::make('hero_image_3_mobile')
                                ->label('Mobile Background (768×1024)')
                                ->image()
                                ->disk('public')
                                ->directory('hero-slides')
                                ->visibility('public')
                                ->helperText('JPG/PNG — auto-converted to WebP at 768×1024 (portrait).')
                                ->columnSpan(1),
                        ])->columns(2),
                    ]),

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
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->helperText('Replaces the text logo in the navigation'),
                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
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

                    Tabs\Tab::make('WhatsApp')->schema([
                        Toggle::make('whatsapp_enabled')
                            ->label('Enable WhatsApp Floating Button')
                            ->helperText('Show the WhatsApp chat button on all frontend pages')
                            ->columnSpanFull(),
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number')
                            ->placeholder('+13059065182')
                            ->helperText('Enter with country code, digits only or with + prefix — e.g. +13059065182')
                            ->columnSpanFull(),
                    ])->columns(1),

                    Tabs\Tab::make('Pages')->schema([
                        RichEditor::make('disclaimer')
                            ->label('Disclaimer')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                        RichEditor::make('privacy_policy')
                            ->label('Privacy Policy')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                        RichEditor::make('terms_conditions')
                            ->label('Terms & Conditions')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                    ])->columns(1),

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

        // Preserve existing DB values for file uploads and any field left empty on this tab
        $preserveFields = [
            'logo', 'favicon',
            'hero_image_1', 'hero_image_2', 'hero_image_3',
            'hero_image_1_mobile', 'hero_image_2_mobile', 'hero_image_3_mobile',
            'facebook', 'twitter', 'linkedin', 'youtube', 'instagram',
            'tiktok', 'pinterest', 'threads',
        ];
        $existing = Setting::whereIn('key', $preserveFields)->pluck('value', 'key');
        foreach ($preserveFields as $field) {
            if (empty($data[$field]) && !empty($existing[$field])) {
                $data[$field] = $existing[$field];
            }
        }

        foreach (['hero_image_1', 'hero_image_2', 'hero_image_3'] as $key) {
            if (!empty($data[$key]) && !str_ends_with($data[$key], '.webp')) {
                $data[$key] = $this->convertToWebP($data[$key], 1920, 900);
            }
        }

        foreach (['hero_image_1_mobile', 'hero_image_2_mobile', 'hero_image_3_mobile'] as $key) {
            if (!empty($data[$key]) && !str_ends_with($data[$key], '.webp')) {
                $data[$key] = $this->convertToWebP($data[$key], 768, 1024);
            }
        }

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

    private function convertToWebP(string $storagePath, int $targetW = 1920, int $targetH = 900): string
    {
        $fullPath = storage_path('app/public/' . $storagePath);

        if (!file_exists($fullPath)) {
            return $storagePath;
        }

        $info = @getimagesize($fullPath);
        if (!$info) {
            return $storagePath;
        }

        $image = match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($fullPath),
            'image/png'  => imagecreatefrompng($fullPath),
            'image/gif'  => imagecreatefromgif($fullPath),
            'image/webp' => null,
            default      => null,
        };

        if ($image === null) {
            return $storagePath;
        }

        $srcW = imagesx($image);
        $srcH = imagesy($image);

        $targetW = 1920;
        $targetH = 900;

        // Center-crop to maintain aspect ratio
        $srcRatio = $srcW / $srcH;
        $tgtRatio = $targetW / $targetH;

        if ($srcRatio > $tgtRatio) {
            $cropH = $srcH;
            $cropW = (int) round($srcH * $tgtRatio);
            $cropX = (int) round(($srcW - $cropW) / 2);
            $cropY = 0;
        } else {
            $cropW = $srcW;
            $cropH = (int) round($srcW / $tgtRatio);
            $cropX = 0;
            $cropY = (int) round(($srcH - $cropH) / 2);
        }

        $resized = imagecreatetruecolor($targetW, $targetH);
        imagecopyresampled($resized, $image, 0, 0, $cropX, $cropY, $targetW, $targetH, $cropW, $cropH);
        imagedestroy($image);

        $webpPath     = preg_replace('/\.[^.]+$/', '.webp', $storagePath);
        $webpFullPath = storage_path('app/public/' . $webpPath);

        imagewebp($resized, $webpFullPath, 85);
        imagedestroy($resized);

        if ($storagePath !== $webpPath && file_exists($fullPath)) {
            @unlink($fullPath);
        }

        return $webpPath;
    }
}
