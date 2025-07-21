<?php 

namespace App\Views\Home;

use App\Views\General\Heading;

class ContactPage{

    static function render(){
        $heading = Heading::render('ارتباط با عباس باقری','پیام شما پاسخ داده خواهد شد.');
        $contactForm = ContactForm::render();
        $contact = Contact::render();
        return "
            $heading
            $contactForm
            $contact
        ";
    }
    
}