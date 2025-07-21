<?php 

namespace App\Views\Blog;

use App\Views\General\Script;
use App\Views\General\Style;

class Share {
    static function render($post){
        Style::require('blog.share');
        Script::require('blog.share');
        $id = $post['id'];
        $title = $post['title'];
        $link = isset($post['skill']) ? "https://abasbagheri.ir/w/$id" : "https://abasbagheri.ir/p/$id"; 
        return <<<HTML
        <div id="share-post" style="display:none;" >
            <div id="share-post-bg" onclick="closeShareModal()"></div>
            <div id="share-content">
                <i class="icon-close" id="close-share-post" onclick="closeShareModal()"></i>
                <h3>اشتراک گذاری مطلب</h3>
                <span onclick="copyLink()">
                    <i class="icon-copy" id="share-copy-btn" short-link="$link"></i>
                    <i class="icon-link"></i>
                    <i id="shore-copy-text">$link</i>
                </span>
                <h6>یا ارسال لینک از طریق</h6>
                <ul>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=$link" target="_blank">
                        <li class="icon-facebook-square"></li>
                    </a>
                    <a href="https://x.com/share?text=$title&url=$link" target="_blank">
                        <li class="icon-x"></li>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&title=$title&url=$link" target="_blank">
                        <li class="icon-linkedin"></li>
                    </a>
                    <a href="https://telegram.me/share/url?url=$link" target="_blank">
                        <li class="icon-telegram" ></li>
                    </a>
                    <a href="https://wa.me/text?url=$link" target="_blank">
                        <li class="icon-whatsapp" ></li>
                    </a>
                    <a href="mailto:?subject=$title&body=$link" target="_blank">
                        <li class="icon-envelope" style="font-size:1.6rem;"></li>
                    </a>
                </ul>
            </div>
        </div>
HTML;
    }
}