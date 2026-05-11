<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeroSlideResource extends Resource
{
    protected static ?string $model          = HeroSlide::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort = 0;
    protected static ?string $navigationLabel = 'Hero Slides';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Slide Content')->schema([
                TextInput::make('badge')
                    ->label('Badge Text')
                    ->placeholder('MBE Certified · Est. 1999')
                    ->helperText('Small label shown above the title'),
                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Buttons')->schema([
                TextInput::make('btn1_text')->label('Button 1 — Text')->placeholder('About Us'),
                TextInput::make('btn1_url')->label('Button 1 — URL')->placeholder('/about'),
                TextInput::make('btn2_text')->label('Button 2 — Text')->placeholder('Request for Call'),
                TextInput::make('btn2_url')->label('Button 2 — URL')
                    ->placeholder('#callback')
                    ->helperText('Use #callback to open the Request for Call modal'),
            ])->columns(2),

            Section::make('Background Images')->schema([
                FileUpload::make('desktop_image')
                    ->label('Desktop Background (1920×900)')
                    ->image()
                    ->disk('public')
                    ->directory('hero-slides')
                    ->visibility('public')
                    ->helperText('JPG/PNG — auto-converted to WebP 1920×900'),
                FileUpload::make('mobile_image')
                    ->label('Mobile Background (768×1024)')
                    ->image()
                    ->disk('public')
                    ->directory('hero-slides')
                    ->visibility('public')
                    ->helperText('JPG/PNG — auto-converted to WebP 768×1024. Falls back to desktop if empty.'),
            ])->columns(2),

            Toggle::make('active')->label('Active')->default(true)->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->label('#')->sortable()->width('60px'),
                ImageColumn::make('desktop_image')->disk('public')->label('Image')->width(80)->height(45),
                TextColumn::make('title')->limit(50)->searchable(),
                TextColumn::make('subtitle')->limit(60)->color('gray'),
                IconColumn::make('active')->boolean(),
                TextColumn::make('updated_at')->label('Updated')->since()->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit'   => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
