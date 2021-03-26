<?php

namespace App\Controllers;

use App\Models\ChangeEmailModel;
use App\Models\ChangePasswordModel;
use App\Models\ContactForm;
use App\Models\ResetModel;
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
    public function changeEmail(Request $request, Response $response)
    {
        $change = new ChangeEmailModel;
        if ($request->isPost()) {
            $change->loadData($request->getBody());
            if ($change->validate() && $change->change()) {
                Application::$app->session->setFlash('success', 'Email changed successfully');
                return $response->redirect('/profile');
            }
        }
        return $this->render('changeEmail', ['model' => $change]);
    }
    public function changePassword(Request $request, Response $response)
    {
        $change = new ChangePasswordModel;
        if ($request->isPost()) {
            $change->loadData($request->getBody());
            if ($change->validate() && $change->change()) {
                Application::$app->session->setFlash('success', 'Password changed successfully');
                return $response->redirect('/profile');
            }
        }
        return $this->render('changePassword', ['model' => $change]);
    }
    public function reset(Request $request, Response $response)
    {
        $reset = new ResetModel;
        if ($request->isPost()) {
            $reset->loadData($request->getBody());
            if ($reset->validate() && $reset->reset()) {
                Application::$app->session->setFlash('success', 'New password sent to your email');
                return $response->redirect('/');
            }
        }
        return $this->render('reset', ['model' => $reset]);
    }
}