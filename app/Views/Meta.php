<?php 

namespace App\Views;

class Meta{

    static function metadatas($meta){
        $res = "";
        foreach($meta as $m){
            $name = $m['name'];
            $property = $m['property'];
            $content = $m['$content'];
            if($name){
                $res .= "<meta name=\"$name\" content=\"$content\"/>";
            }else{
                $res .= "<meta property=\"$property\" content=\"$content\"/>";
            }
            
        }
        return $res;
    }

    static function render($metadata){


        $meta = $metadata['meta'];
        $title = $metadata['title'];
        $description = $metadata['description'];
        $image = $metadata['image'];
        $link = $metadata['link'];

        $amp = isset($metadata['amp'])? "<link rel=\"amphtml\" href=\"".$metadata['amp']."\"  />":"";
        $metadatas = self::metadatas($meta);

        return <<<HTML
        <meta charset="UTF-8">
        $amp
        <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=5.0">

        <meta name="subject" content="Personal Web Developer">
        <meta name="copyright" content="Abas Bagheri">
        <meta name="language" content='FA'>
        <meta name="Classification" content="Business">
        <meta name="author" content='Abbas Bagheri, abasbagheria@gmail.com'>
        <meta name="url" content="https://abasbagheri.ir/">
        <meta name="subtitle" content="برنامه نویس و طراحی وب سایت">
        <meta name="target" content="all">
        <meta name="revised" content="Sunday, July 29th, 2022, 5:15 pm">
        <meta name='identifier-URL' content="https://abasbagheri.ir">
        <meta name="google-site-verification" content="WRx4dyxLMr0lZzfwVv_lNEimc6Q4cu5V12fKX0fubTo" />
        <meta name="designer" content="عباس باقری">
        <meta name="reply-to" content="abasbagheria@gmail.com">
        <meta name="owner" content="عباس باقری">

        <meta name="pagename" content="$title">

        <meta name="category" content="Web Developer"'>
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="rating" content="General">


        <meta name="title" content="$title">
        <meta name="description" content="$description">

        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="$link">
        <meta property="og:title" content="$title">
        <meta property="og:description" content="$description">
        <meta property="og:image" content="$image">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="$link">
        <meta property="twitter:title" content="$title">
        <meta property="twitter:description" content="$description">
        <meta property="twitter:image" content="$image">

        <meta name="robots" content="follow, index"/>

        <title>$title</title>

        $metadatas
HTML;
    }

}
