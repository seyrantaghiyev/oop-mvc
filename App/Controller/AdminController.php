<?php


namespace App\Controller;
use App\Models\Admin;
use Core\DB;
use Core\MiddleWare;

class AdminController
{
 public function getAdmin()
 {
     $admin = (new Admin())->first();
     return view('admin/login', compact('admin'));
 }

 public function checkAdmin()
 {
     $login = htmlentities(postData('login'));
     $password = htmlentities(postData('password'));
 }

}