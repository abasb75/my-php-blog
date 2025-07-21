<?php

namespace App\Views\Home;

use App\Views\General\Style;

class AboutMe{
    
    static function render(){
        Style::add('home.about-me');
        $sectionTitle = SectionTitle::render('درباره من');
        $resume = Resume::render();
        return <<<HTML
        <div id="about-me">
            <div class="content">
                $sectionTitle
                <div class="content">
                    <div class="resume">
                        $resume
                    </div>
                    <div class="detail">
                        <p>به نام خدا</p>
                        <p>عباس باقری هستم، دانش آموخته رشته مهندسی کامپیوتر، گرایش نرم افزار در مقطع کارشناسی از <a href="https://pgu.ac.ir" target="_blank">دانشگاه خلیج فارس بوشهر</a> و در حال حاضر شغلم برنامه‌نویسی وب هست.</p>
                        <p>برنامه نویسی شامل شاخه‌های زیادی میشه، از جمله وب،موبایل و ...! خود برنامه نویسی وب هم شامل ابزارهای زیادی میشه که یادگیری همه‌اش کار یک نفر نیست.
                            من با ابزارهایی مانند php، لاراول برای بکند و جاوااسکریپت و کتابخانه محبوب ریکت برای فرانت‌اند کار می‌کنم.
                            البته نه این که چیز دیگه‌ای کار نکرده باشم، اما تخصصم فعلا ایناست.
                        </p>
                        <p>این وبگاه، امکان این را می‌دهد که با اطلاعات شغلی و مهارتهای فنی من آشنا شوید. این مهارتها در طول زمان ارتقا پیدا خواهند کرد. همچنین مطالبی در مورد چیزهای مختلف از جمله مهارتهای تخصصی خودم در صفحه <a href="/blog">بلاگ</a> این وبگاه قرار خواهم داد.</p>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }
}


