<?php


namespace Core;


class Validation
{
    public function validateLengthText( string $title,string $text,$limitLength)
    {
        if(strlen($title) > $limitLength || (strlen($text) > $limitLength)){
            return redirect('/admin/slider');
        }
    }

    public function hasData(string $title, string $text)
    {
        if(trim($title) == null || trim($text) == null){
            return redirect('/admin/slider');
        }
    }


    public function validateLengthContact(string $name,string $email,string $subject,string $message,$limitLength)
    {
        if(strlen($name) > $limitLength ||
            (strlen($email) > $limitLength) ||
            (strlen($subject) > $limitLength) ||
            (strlen($message) > $limitLength)){
            return redirect(url('/contact'), true);
        }

    }

    public function hasDataContact(string $name,string $email,string $subject,string $message)
    {
        if(trim($name) == null ||
            trim($email) == null ||
            trim($subject) == null ||
            trim($message) == null)
        {
            return redirect('/contact');
        }
    }

}