<?php

namespace App\Models;

use Core\Application;
use Core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';
    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Email',
            'body' => 'Body'
        ];
    }
    public function send()
    {
        $email = $this->email;
        Application::$app->mail->sendMail($email, "Contact us", "Thanks for contacting");
        return true;
    }
}