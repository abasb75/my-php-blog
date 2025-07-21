<?php 

namespace App\Views\Blog;

use App\CMS\Asset;
use App\Views\General\Icon;
use App\Views\General\Script;
use App\Views\General\Style;

class Heading{
    static function render($post){
        Style::require('header-title');
        Style::require('blog.heading');
        Script::require('particles.particles');
        Script::require('particles.app');
        Script::require('heading');

        $iconGlass = Icon::render('hourglass');

        $iconShare = Icon::render('share');
        $iconBookMark = Icon::render('bookmark-o');

        $id = $post['id'];
        $title = $post['title'];
        $readingTime = $post['reading_time'];

        $image = $post['image'];
        $share = Share::render($post);
        
        return <<<HTML
        <div id="header-title">
            <div id="header-title-image" class="cover bg-image">
                <img 
                src="$image" 
                alt="$title" 
                width="1920px" height="230px"
                />
            </div>
            <div class="cover" id="particles-js"></div>
            <div class="cover content-cover">
                <h1>$title</h1>
            </div>
        </div>
        <div class="header-title-padding-layout">
            <div class="cover content-detail">
                <div class="detail">
                    <div class="detail-content">
                        <div class="reading-time">
                            $iconGlass
                            <span>زمان مطالعه : $readingTime دقیقه</span>
                        </div>
                        <div class="post-options">
                            <ul>
                                <li onclick="sharePost()">$iconShare</li>
                                <li>$iconBookMark</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        $share
HTML;
    }
}