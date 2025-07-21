<?php 

namespace App\Views\General;
class Icon{
    static function render($icon){
        return "<i class=\"icon-$icon\"></i>";
    }
}
