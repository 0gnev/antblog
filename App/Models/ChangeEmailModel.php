<?php

namespace App\Models;

use Core\Application;
use Core\Model;



class ChangeEmailModel extends Model
{
    public string $email = '';
    public string $emailConfirm = '';
    public function rules(): array
    {
        return [
            'emailConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'email']],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL]
        ];
    }
    public function labels(): array
    {
        return [
            'emailConfirm' => 'Confirm E-mail',
            'email' => 'Email'
        ];
    }
    public function change()
    {
        $primaryKey = Application::$app->user->primaryKey();
        $primaryValue = Application::$app->user->{$primaryKey};
        Application::$app->user->change($primaryValue, 'email', $this->email);
        return true;
    }
}