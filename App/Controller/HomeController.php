<?php


namespace App\Controller;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Slider;
use Core\DB;
use mysql_xdevapi\Exception;
use Core\Validation;

class HomeController
{
    public function index()
    {
        $slider = (new Slider())->first();
        $blogs = (new Blog())->setLimit(3)->all();
        return view('home', compact('slider', 'blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = (new Blog())->where('slug', $slug)->first();
        if (!$blog) {
            throw new \Exception('No data');
        }

        return view('blog-single',compact('blog'));
    }


}