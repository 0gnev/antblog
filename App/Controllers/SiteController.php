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
    public function profile()
    {
        return $this->render('profile');
    }
}