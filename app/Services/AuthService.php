<?php

namespace App\Services;

use App\Models\User;
use App\Utils\ApiStatusCode;

class AuthService extends Service
{

    public function __construct()
    {
        $this->model = $this->makeModel();
    }

    protected function makeModel(): User
    {
        return new User();
    }

    public function getTokenByCredential($email, $password)
    {
        $credentials['email'] = $email;
        $credentials['password'] = $password;

        $this->code = ApiStatusCode::FAILED;

        //Create token
        try {

            if (!$token = auth()->attempt($credentials)) {
                throw new \Exception(__('Login credentials are invalid.'));
            }

            $user = auth()->user();
            $permission = (new PermissionService())->getPermissionByUserId($user->id);

            $refreshToken = auth()->fromUser($user);
            $this->result = $this->prepareAuthReponseData($token, $refreshToken, $user);
            $this->result = $this->result + $permission;

            $this->message = __('Login successfully');
            $this->code = ApiStatusCode::SUCCESS;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    private function prepareAuthReponseData($token, $refreshToken, $auth_user) : array
    {
        $data['access_token'] = $token;
        $data['refresh_token'] = $refreshToken;
        $data['expire_in'] = auth()->factory()->getTTL() * 60;
        $data['user'] = $auth_user;

        return $data;
    }

    public function getAuthInfo($auth_user){

        $this->message = __('Email or password is incorrect.');
        $this->code = ApiStatusCode::FAILED;
        if(!empty($auth_user)){
            $this->message = __('Successfully logged in');
            $this->code = ApiStatusCode::SUCCESS;
            $permissions = (new PermissionService())->getPermissionByUserId($auth_user->id);

            if(!empty($permissions)) {
                $data = $permissions;
            }
            $data['access_token'] = request()->bearerToken();
            $data['expire_in'] = auth()->factory()->getTTL() * 60;
            $data['user'] = $auth_user;
            $this->result = $data;
        }
    }

}
