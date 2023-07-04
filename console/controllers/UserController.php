<?php

namespace console\controllers;

use common\models\User;
use Exception;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Interacts with the user model
 *
 * @package console\controllers
 */
class UserController extends Controller
{
    /**
     * Create a new user with admin role
     *
     * @return int
     */
    public function actionIndex()
    {
        try {
            if ($this->actionUser() > 0) {
                throw new Exception('Error');
            }
        } catch (\Exception $e) {
            return print_r(ExitCode::getReason(ExitCode::DATAERR));
        }

        return print_r(ExitCode::getReason(ExitCode::OK));
    }

    private function actionUser()
    {
        $data = $this->getDataUser();

        foreach ($data as $item) {
            $user = new User();
            $user->username = $item['username'];
            $user->email = $item['email'];
            $user->status = $item['status'];
            $user->role = $item['role'];
            $user->setPassword($item['password']);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            if (!$user->save()) {
                return ExitCode::DATAERR;
            }
        }
        return ExitCode::OK;
    }

    private function getDataUser()
    {
        $data[0]['username'] = 'Admin';
        $data[0]['email'] = 'Admin@mail.com';
        $data[0]['password'] = 'admin123123';
        $data[0]['status'] = '10';
        $data[0]['role'] = 'admin';

        return $data;
    }
}