<?php 

namespace App\Views\Home;

use App\Views\General\Script;
use App\Views\General\Style;

class Contact{
    static function render(){
        Style::add('home.contact');
        Style::add('@js.iziToast.dist.css.iziToast');

        Script::add('iziToast.dist.js.iziToast');
        Script::add('home.contact');

        return <<<HTML
        <div id="contact-me">
            <div class="contact_container">
                <div class="map">
                    <div class="items">
                        <h2>راه های ارتباطی</h2>
                        <div class="item">
                            <i class="icon-phone"></i>
                            <p>شماره تماس : <a href="tel:+989015827703">09015827703</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                        <div class="item">
                            <i class="icon-envelope"></i>
                            <p> ایمیل : <a href="mailto:abasbagheria@gmail.com">abasbagheria@gmail.com</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                        <div class="item">
                            <i class="icon-whatsapp"></i>
                            <p> واتساپ : <a href="https://wa.me/989015827703">wa.me/989015827703</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                        <div class="item">
                            <i class="icon-telegram" ></i>
                            <p> تلگرام : <a href="https://t.me/989015827703">@abasb75</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                        <div class="item">
                            <i class="icon-stack-overflow"></i>
                            <p> لینک : <a href="https://stackoverflow.com/users/10835176/abbas-bagheri">stackoverflow</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                        <div class="item">
                            <i class="icon-github"></i>
                            <p> گیت هاب : <a href="https://github.com/abasb75">@abasb75</a></p>
                            <i class="icon-copy" onclick="copytoclip(this)"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
HTML;
    }

}

