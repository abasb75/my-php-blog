<?php

namespace App\Views\Header;
use App\Views\General\Icon;

class NavMenu{

    static function loop($pages){
        $res = "";
        foreach($pages as $i=>$page){
            $href = $page['href'];
            $title = $page['title'];
            $label = $page['label'];
            $icon = Icon::render($page['icon']);
            $res .= <<<HTML
            <li>
                <a href="$href" title="$title">
                    $icon
                    <span>$label</span>
                </a>
            </li>
HTML;
        }
        return $res;
    }

    static function render($pages){
        $pagesLoop = self::loop($pages);
        return <<<HTML
        <nav id="nav-menu">
            <div class="bg-holder">
            </div>
            <div class="nav-content" id="nav-menu-list">
                <div class="top-space"></div>
                <ul>
                    $pagesLoop
                </ul>
            </div>
        </nav>
HTML;
    }
}

