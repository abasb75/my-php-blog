<?php 

namespace App\Views\Header;

use App\CMS\Asset;
use App\Views\General\Icon;
use App\Views\General\Script;
use App\Views\General\Style;

class Header{

    const MAIN_LOGO = 'logo-ba4.svg';
    static $sosial = [
        [
            'icon'=>'telegram',
            'title'=>'گفت و گو در تلگرام',
            'href'=>'https://telegram.me/989015827703',
        ],
        [
            'icon'=>'github',
            'title'=>'گیت‌هاب',
            'href'=>'https://github.com/abasb75',
        ],
        [
            'icon'=>'virgool',
            'title'=>'پست‌های من در ویرگول',
            'href'=>'https://virgool.io/@abasb75',
        ],
    ];
    static $pages = [
        [
            "href"=>"/",
            "title"=>"صفحه اصلی",
            "label"=>"خانه",
            "icon"=>"home",
        ],
        [
            "href"=>"/resume",
            "title"=>"رزومه عباس باقری",
            "label"=>"رزومه",
            "icon"=>"profile",
        ],
        [
            "href"=>"/contact",
            "title"=>"راه‌های ارتباطی با عباس باقری",
            "label"=>"ارتباط",
            "icon"=>"phone",
        ],
        [
            "href"=>"/blog",
            "title"=>"نوشته‌های عباس باقری",
            "label"=>"نوشته‌ها",
            "icon"=>"feather",
        ],
        [
            "href"=>"/work-samples",
            "title"=>"نمونه کارهای عباس باقری",
            "label"=>"نمونه‌کارها",
            "icon"=>"folder",
        ],
    ];

    static function sosialLoop(){
        $res = "";
        foreach(self::$sosial as $i=>$s){
            $icon = Icon::render($s['icon']);
            $iconName = $s['icon'];
            $href = $s['href'];
            $title = $s['title'];
            $res .= <<<HTML
            <li class="$iconName">
                <a href="$href" title="$title">
                    $icon
                </a>
            </li>
HTML;
        }
        return $res;
    }

    static function render(){
        Style::require('header');

        $mobileMenu = MobileMenu::render();
        $navMenu = NavMenu::render(self::$pages);
        $darkMode = DarkMode::render();

        $logo = Asset::image(self::MAIN_LOGO);

        $sosialLoop = self::sosialLoop();


        return <<<HTML
        <header id="main-header">
            <div class="content">
                $mobileMenu
                <h2>
                    <span>وب سایت شخصی عباس باقری</span>
                    <a href="/">
                        <img src="$logo" alt="وب سایت شخصی عباس باقری" />
                    </a>
                </h2>
                $navMenu
                <ul>
                    $sosialLoop
                </ul>
                $darkMode
            </div>
        </header>
HTML;
    }
}
