<?php

namespace App\Views\Home;

use App\Views\View;

class Home extends View{
    static function render(){
        $welcome = Welcome::render();
        $aboutMe = AboutMe::render();
        $myJobs = MyJobs::render();
        $mySkills = MySkills::render();
        $contact = Contact::render();
        $blog = Blog::render();

        return <<<HTML
        <div id="home">
            $welcome
            $aboutMe
            $myJobs
            $mySkills
            $contact
            $blog

        </div>
HTML;
    }
}

?>


