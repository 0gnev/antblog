<?php

namespace App\Models;

use Core\Application;
use Core\db\DbModel;
use Core\Model;

class ResetModel extends Model
{
    public string $email = '';
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'email' => 'Email'
        ];
    }
    public function reset()
    {
        $email = $this->email;
        $newPassword = $this->randomPassword();
        Application::$app->mail->sendMail($email, "Reset password", "Your new password is $newPassword");

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $statement = Application::$app->db->pdo->prepare("UPDATE users
        SET password = '$newPassword'
        WHERE email = '$email';");
        $statement->execute();
        return true;
    }
    public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}