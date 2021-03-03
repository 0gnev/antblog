<?php

namespace App\Controllers;

use Core\Application;
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
    public function home()
    {
        $params = [
            'name' => "UserName"
        ];
        return $this->render('home', $params);
    }
}