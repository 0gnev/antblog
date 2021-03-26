<?php

namespace App\Models;

use Core\Application;
use Core\Model;



class ChangePasswordModel extends Model
{
    public string $password = '';
    public string $passwordConfirm = '';
    public function rules(): array
    {
        return [
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'passwordConfirm' => 'Confirm Password',
            'password' => 'Password'
        ];
    }
    public function change()
    {
        $primaryKey = Application::$app->user->primaryKey();
        $primaryValue = Application::$app->user->{$primaryKey};
        $newPassword = password_hash($this->password, PASSWORD_DEFAULT);
        Application::$app->user->change($primaryValue, 'password', $newPassword);
        return true;
    }
}