<?php 

namespace App\Views\Blog;

use App\Views\General\Script;
use App\Views\General\Style;

class Single{
    static function render($args){

        Style::add('blog.single');
        Style::add('blog.post.paragraph');
        Style::add('blog.post.blockquote');
        Style::add('blog.post.heading');
        Style::add('blog.post.simple-code');
        Style::add('blog.post.image');
        Style::add('blog.post.highlightjs');

        Script::add('blog.go-top');
        Script::add('blog.scroll-spinner');
        Script::add('blog.post.simple-code');
        Script::add('blog.post.image');
        Script::add('blog.post.highlight');

        $post = $args['post'];
        $content = self::reformContent($post['body']);
        $timing = $post['timing'];
        $description = $post['description'];

        $heading = Heading::render($post);

        $tags = isset($post['skill']) ? Tags::render(preg_split("#\s#",$post['skill'])) :"";
        $returnBackLabel = isset($post['skill']) ? "لیست نمونه کارها":"لیست نوشته‌ها";

        return <<<HTML
        $heading
        <div id="scroll-spinner"><div id="scroll-spinner-precent" style="width:0%;"></div></div>
        <div class="main-container">
            <div id="post-container">
                <p class="post-description">
                    $description
                </p>
                <div class="post-info">
                    <div class="info">
                        <i class="icon-clock"></i>
                        <span>$timing</span>
                    </div>
                    <div class="info">
                        <i class="icon-user"></i>
                        <span>عباس باقری</span>
                    </div>
                </div>
                <div class="post-body">
                    $content
                </div>
                $tags
                <i class="icon-arrow-thin-up" id="go-top" style="left:10px;bottom:10px;"></i>
                <div class="return-back">
                    <button id="return-back-btn" onclick="history.back()">
                        <i class="icon-arrow-right"></i>
                        <span>صفحه قبل</span>
                    </button>
                </div>
            </div>
        </div>
HTML;
    }

    static function reformContent($content){
        $content = str_replace('&amp;quot','"',$content);
        return $content;
    }
}