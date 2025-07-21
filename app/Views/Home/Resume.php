<?php 

namespace App\Views\Home;

use App\Views\General\Icon;
use App\Views\General\Style;

class Resume{

    static function render(){
        Style::add('home.resume');
        $iconDownload = Icon::render('download');
        return <<<HTML
        <div id="my-resume">
            <div class="info">
                <div class="avatar">
                    <div class="image-holder">
                        <img
                        src="/asset/image/avatar.png"
                        alt="رزومه عباس باقری"
                        width="120"
                        height="120"
                        />
                    </div>
                    <h3>عباس باقری</h3>
                </div>
                <div class="personal-info">
                    <div class="item">
                        <span class="key">ایمیل :</span>
                        <span class="value"><a href="mailto: abasbagheria@gmail.com">abasbagheria@gmail.com</a></span>
                    </div>

                    <div class="item">
                        <span class="key">شماره موبایل :</span>
                        <span class="value"><a href="tel:+989907968973">09907968973</a></span>
                    </div>

                    <div class="item">
                        <span class="key">سال تولد :</span>
                        <span class="value">1375</span>
                    </div>

                    <div class="item">
                        <span class="key">محل سکونت :</span>
                        <span class="value">بوشهر، شبانکاره</span>
                    </div>

                    <div class="item">
                        <span class="key">وضعیت خدمت :</span>
                        <span class="value">پایان خدمت</span>
                    </div>

                    <div class="item">
                        <span class="key">مدرک تحصیلی :</span>
                        <span class="value">مهندسی نرم‌افزار</span>
                    </div>

                </div>
                <a href="/asset/pdf/abbasbgaheri-resume.ir.pdf" area-label="دانلود رزومه عباس باقری" title="دانلود رزومه عباس باقری">
                    <button id="resume-download">
                        $iconDownload
                        <span>دانلود رزمه</span>
                    </button>
                </a>
            </div>
        </div>
HTML;
    }
}

