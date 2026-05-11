<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('title')->required()->maxLength(255)->label('Job Title'),
            Forms\Components\TextInput::make('order')->numeric()->default(0),
            Forms\Components\Toggle::make('active')->default(true)->inline(false),
            Forms\Components\Textarea::make('bio')->rows(4)->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')->image()->directory('team')->columnSpanFull(),
            Forms\Components\TextInput::make('linkedin')->url()->maxLength(255),
            Forms\Components\TextInput::make('twitter')->url()->maxLength(255),
            Forms\Components\TextInput::make('facebook')->url()->maxLength(255),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->sortable()->width(60),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\IconColumn::make('active')->boolean()->sortable(),
            ])
            ->defaultSort('order')
            ->filters([Tables\Filters\TernaryFilter::make('active')])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
