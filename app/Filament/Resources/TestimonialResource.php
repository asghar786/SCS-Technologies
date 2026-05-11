<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('client_name')->required()->maxLength(255),
            Forms\Components\TextInput::make('company')->maxLength(255),
            Forms\Components\TextInput::make('position')->maxLength(255),
            Forms\Components\Select::make('rating')
                ->options([1 => '1 Star', 2 => '2 Stars', 3 => '3 Stars', 4 => '4 Stars', 5 => '5 Stars'])
                ->default(5)
                ->required(),
            Forms\Components\Toggle::make('active')->default(true)->inline(false),
            Forms\Components\Textarea::make('quote')->required()->rows(4)->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')->image()->directory('testimonials')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('position')->toggleable(),
                Tables\Columns\TextColumn::make('rating')->sortable(),
                Tables\Columns\IconColumn::make('active')->boolean()->sortable(),
            ])
            ->filters([Tables\Filters\TernaryFilter::make('active')])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
