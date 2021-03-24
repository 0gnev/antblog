<?php

namespace App\Models;

use Core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Email'
        ];
    }
    public function send()
    {
        
    }
}