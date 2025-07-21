<?php 

namespace App\Views\Blog;

class Amp{

    static function forAmp($content){
        $content = preg_replace("#\<textarea [^\>]+\>#","<pre><code>",$content);
        $content = preg_replace("#\<\/textarea\>#","</code></pre>",$content);
        $content = str_replace("<?php","",$content);
        $content = str_replace("?>","",$content);

        return $content;
    }

    static function render($post){
        $title = $post['title'];
        $id = $post['id'];
        $slug = $post['slug'];
        $content = self::forAmp($post['body']);
        $discription = $post['description'];
        $link = "https://abasbagheri.ir/blog/$id/$slug";

        return <<<HTML
        <!doctype html>
        <html amp lang="fa">
        <head>
            <meta charset="utf-8">
            <script async src="https://cdn.ampproject.org/v0.js"></script>
            <title>$title</title>
            <link rel="canonical" href="$link">
            <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
            <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
            <style amp-custom>
                *{direction:rtl;text-align:right;}
                h1,h2,h3,h4,h5,h6{color:#111;margin:12px auto;max-width:700px;padding:8px}
                p{max-width:700px; margin:12px auto;color:#333;padding:0 8px;}
                .iframe,blockquote{max-width:700px; margin:12px auto;color:#333;padding:0 8px;}
                pre{max-width:700px; margin:24px auto;color:#333;padding:20px 8px;direction:ltr;text-align:left;background:#f1f1f1;overflow:auto;border-radius:5px;}
                .post_image,figure{width:100%;max-width:700px;margin:12px auto;}
                .post_image img,figure img{width:100%;max-width:700px;margin:12px auto;}
            </style>
        </head>
        <body>
            <h1 id="hello">$title</h1>
            <p>$discription</p>
            $content
        </body>
        </html>
HTML;
    }
}