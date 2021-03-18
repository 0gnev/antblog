<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;

class SiteController extends Controller
{
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
         
        return 'Handling submitted data';
    }
    public function contact()
    {
        return $this->render('contact');
    }
    public function about()
    {
        return $this->render('about');
    }
    public function home()
    {
        return $this->render('home');
    }
    public function article1()
    {
        return $this->render('article1');
    }
    public function article2()
    {
        return $this->render('article2');
    }
    public function article3()
    {
        return $this->render('article3');
    }
}