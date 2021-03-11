<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\User;
use Core\Application;
use Core\Response;
use App\Models\LoginForm;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginForm = new LoginForm;
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->responce->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', ['model' =>$loginForm]);
    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->responce->redirect('/');
                exit;
            }
            return $this->render('register', ['model' => $user]);
        }
        $this->setLayout('auth');
        return $this->render('register', ['model' => $user]);
    }
    public function logout(Request $request)
    {
        Application::$app->logout();
        Application::$app->responce->redirect('/');
    }
    public function profile()
    {
        return $this->render('profile');
    }
}