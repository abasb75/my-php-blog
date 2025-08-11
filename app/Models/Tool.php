<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;
use Outerweb\ImageLibrary\Models\Image;

class Tool extends Model
{
    protected $fillable = [
        'name',
        'description',
        'link',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}