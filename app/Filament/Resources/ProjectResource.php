<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

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
                Forms\Components\TextInput::make('client')->maxLength(255),
                Forms\Components\TextInput::make('category')->maxLength(255),
                Forms\Components\TextInput::make('order')->numeric()->default(0),
                Forms\Components\Toggle::make('featured')->inline(false),
            ])->columns(2),

            Forms\Components\Section::make('Description')->schema([
                Forms\Components\RichEditor::make('description')->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Images')->schema([
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('projects')
                    ->label('Thumbnail'),
                Forms\Components\FileUpload::make('images')
                    ->image()
                    ->multiple()
                    ->directory('projects')
                    ->label('Gallery Images'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->sortable()->width(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('category')->searchable()->toggleable(),
                Tables\Columns\IconColumn::make('featured')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
