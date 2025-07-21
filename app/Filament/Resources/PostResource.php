<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;
use Malzariey\FilamentLexicalEditor\FilamentLexicalEditor;
use Riodwanto\FilamentAceEditor\AceEditor;
use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;




class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes(['dir' => 'rtl'])
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->maxLength(160)
                    ->columnSpanFull()
                    ->extraAttributes(['dir' => 'rtl'])
                    ->nullable(),

                // ImageLibraryPicker::make('thumbnail')
                    // ->image()
                    // ->directory('thumbnails')
                    // ->disk('public')
                    // ->visibility('public')
                    // ->nullable(),
                ImageLibraryPicker::make('thumbnail')
                    ->label('thumbnail')
                    ->filteredConversionDefinitions([])
                    ->nullable(),

                ImageLibraryPicker::make('image')
                    ->label('Image')
                    ->filteredConversionDefinitions([])
                    ->nullable(),

                // Forms\Components\RichEditor::make('body')
                //     ->required()
                //     ->toolbarButtons([
                //         'bold',
                //         'italic',
                //         'link',
                //         // 'codeBlock',
                //         'blockquote',
                //         'bulletList',
                //         'orderedList',
                //         'undo',
                //         'redo',
                //         'codeSample'
                //     ])
                //     ->columnSpanFull(),

                // TiptapEditor::make('body')
                //     ->profile('default')
                //     ->disk('string') 
                //     ->output(TiptapOutput::Html)
                //     ->columnSpanFull()
                //     ->required(),

                TinyEditor::make('body')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->profile('default')
                    ->rtl() // Set RTL or use ->direction('auto|rtl|ltr')
                    ->columnSpan('full')
                    ->extraInputAttributes([
                        'data-tinymce' => json_encode([
                            'codesample_languages' => [
                                ['text' => 'HTML/XML', 'value' => 'markup'],
                            ],
                        ]),
                    ])
                    ->required(),

                // FilamentLexicalEditor::make('body'),

                // AceEditor::make('code-editor')
                //     ->mode('php')
                //     ->theme('github')
                //     ->darkTheme('dracula'),


                Forms\Components\Select::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('name', Str::slug($state));
                            }),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return Tag::create($data)->id;
                    }),

                Forms\Components\Checkbox::make('publish_status')
                    ->label('انتشار؟')
                    ,

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('tags.name')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}