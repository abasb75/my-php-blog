<?php 

namespace App\Views\Home;

use App\Views\General\Heading;

class ResumePage{
    static function render(){
        $heading = Heading::render('رزومه عباس باقری','در این صفحه اطلاعات کاری اینجانب قرار خواهد گرفت');
        $aboutMe = AboutMe::render();
        $myJobs = MyJobs::render();
        $mySkills = MySkills::render();
        $contact = Contact::render();
        return "
            $heading
            $aboutMe
            $myJobs
            $mySkills
            $contact
        ";
    }
}