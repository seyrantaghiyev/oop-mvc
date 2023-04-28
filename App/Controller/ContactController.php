<?php


namespace App\Controller;


use Core\DB;
use App\Models\Contact;
use Core\Validation;

class ContactController
{
    public function getContact()
    {
        return view('contact');
    }

    public function postContact()
    {
        $name = htmlentities(postData('name'));
        $email = htmlentities(postData('email'));
        $subject = htmlentities(postData('subject'));
        $message = htmlentities(postData('message'));

        $vld = new Validation();
        $vld->validateLengthContact($name,$email,$subject,$message,255);
        $vld->hasDataContact($name,$email,$subject,$message);

        (new Contact())->create(
                [
                    'name' => $name,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $message
                ]
            );
        return redirect(url('/contact'), true);
    }

    public function tableContact(){
        $contacts = (new Contact())->all();
        return view('admin/contact',compact('contacts'));
    }

    public function delete($id)
    {


        (new Contact())->where('id', (int)$id)->delete();

        return redirect(url('/admin/contact'),true);


    }

}