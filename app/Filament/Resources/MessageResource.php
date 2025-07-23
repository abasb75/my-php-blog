<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_way')
                    ->label('راه ارتباطی')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('پیام')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // هیچ اکشنی اضافه نمی‌کنیم چون فقط مشاهده می‌خوایم
            ])
            ->bulkActions([
                // هیچ bulk action اضافه نمی‌کنیم
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // غیرفعال کردن امکان افزودن
    }
}