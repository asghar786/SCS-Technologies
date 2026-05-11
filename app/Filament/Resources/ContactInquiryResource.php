<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInquiryResource\Pages;
use App\Models\ContactInquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Inquiries';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\TextInput::make('service')->disabled(),
            Forms\Components\TextInput::make('subject')->disabled()->columnSpanFull(),
            Forms\Components\Textarea::make('message')->disabled()->rows(6)->columnSpanFull(),
            Forms\Components\DateTimePicker::make('read_at')->label('Marked as Read')->disabled(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(),
                Tables\Columns\TextColumn::make('service')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('subject')->limit(40)->toggleable(),
                Tables\Columns\IconColumn::make('read_at')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Received'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('unread')
                    ->label('Unread Only')
                    ->query(fn ($query) => $query->whereNull('read_at')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('mark_read')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->visible(fn (ContactInquiry $record) => $record->read_at === null)
                    ->action(fn (ContactInquiry $record) => $record->update(['read_at' => now()])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInquiries::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
