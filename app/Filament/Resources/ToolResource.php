<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToolResource\Pages;
use App\Models\Tool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;

class ToolResource extends Resource
{
    protected static ?string $model = Tool::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('نام')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('توضیحات')
                    ->rows(4)
                    ->nullable(),
                Forms\Components\TextInput::make('link')
                    ->label('لینک')
                    ->url()
                    ->nullable()
                    ->maxLength(255),
                ImageLibraryPicker::make('image_id')
                    ->label('تصویر')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('توضیحات')
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('لینک')
                    ->url(fn ($record) => $record->link)
                    ->openUrlInNewTab()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image.path')
                    ->label('تصویر')
                    ->getStateUsing(fn ($record) => $record->image ? $record->image->path : null),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTools::route('/'),
            'create' => Pages\CreateTool::route('/create'),
            'edit' => Pages\EditTool::route('/{record}/edit'),
        ];
    }
}