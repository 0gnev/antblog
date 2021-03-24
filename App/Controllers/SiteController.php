<?php

namespace App\Controllers;

use App\Models\ContactForm;
use Core\Application;
use Core\Controller;
use Core\Request;
use Core\Response;

class SiteController extends Controller
{
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm;
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', ['model' => $contact]);
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