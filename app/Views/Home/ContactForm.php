<?php

namespace App\Views\Home;

use App\Views\General\Script;
use App\Views\General\Style;

class ContactForm{

    static function render(){
        Script::add('home.contact-form');
        Style::add('home.contact-form');
        return <<<HTML
        <div id="contact-form">
            <div class="content">
                <h2>ارسال پیام</h2>
                <div class="form">
                    <div class="dual-input">
                        <div class="input">
                            <label for="name-input">نام:</label>
                            <input type="text" name="name" id="name-input" placeholder="نام و نام خانوادگی" />
                        </div>
                        <div class="input">
                            <label for="contact-way-input">راه ارتباطی:</label>
                            <input type="text" name="contact-way" id="contact-way-input" placeholder="شماره یا ایمیل ..."/>
                        </div>
                    </div>
                    <div class="textarea input">
                        <label for="message-input" >متن</label>
                        <textarea id="message-input"></textarea>
                    </div>
                </div>
                <div class="button">
                    <button id="contact-form-submit">ارسال پیام</button>
                </div>
            </div>
        </div>
HTML;
    }
}