<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('icon')
                    ->placeholder('fa-solid fa-network-wired')
                    ->helperText('Font Awesome class, e.g. fa-solid fa-wifi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->inline(false),
            ])->columns(2),

            Forms\Components\Section::make('Description')->schema([
                Forms\Components\Textarea::make('short_desc')
                    ->label('Short Description')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('full_desc')
                    ->label('Full Description')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Image')->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('services')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->sortable()->width(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('icon')->searchable()->toggleable(),
                Tables\Columns\IconColumn::make('active')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('active'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
