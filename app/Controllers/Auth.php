<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\LoginModel;
use App\Models\ForgotModel;
use App\Models\ResetPassword;
use Carbon\Carbon;
// use CodeIgniter\HTTP\Request;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('Auth/register');
    }

    function save()
    {
        $users = new UsersModel();
        if (!$this->validate($users->getValidationRules())) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $file = $this->request->getFile('image');
            $fileName = $file->getRandomName();
            $email = $this->request->getVar('email');
            $token_active = md5($this->request->getVar('email'));

            $users->save([
                'nama' => $this->request->getVar('nama'),
                'email' => $email,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'image' => $fileName,
                'active' => 'not actived',
                'token_active' => $token_active,
                'created_at' => Carbon::now()
            ]);
            $file->move('asset/upload/image', $fileName);

            $setEmail = \Config\Services::email();
            $setEmail->setTo($email);

            $setEmail->setSubject('Actived Account');
            $setEmail->setMessage('Actived Account.' . '<br>' . 'Token: ' . $token_active . '<br>' . 'silahkan Klik link Dibawah ini' . '<br>' . 'http://localhost:8080/register/actived/' . $token_active . '<br>');

            $setEmail->send();



            if ($setEmail->send(false)) {
                session()->setFlashdata('error', 'silahkan coba lagi');
                return redirect()->back();
            } else {
                session()->setFlashdata('success', 'silahkan cek email');
                return redirect()->to('login');
            }
        }
    }

    public function actived($token_active)
    {
        $session = session();

        $users = new UsersModel();
        $checkuserToken = $users->where('token_active', $token_active)->findAll();
        if (count($checkuserToken) > 0) {
            $data['active'] = 1;
            $activateUser = $users->update($checkuserToken[0]['id'], $data);
            if ($activateUser) {
                $session->setFlashdata('success', 'silahkan login dengan email anda');
                return redirect()->to('login');
            } else {
                $session->setFlashdata('error', 'register failed ! silahkan register ulang');
                return redirect()->to('register');
            }
        } else {
            $session->setFlashdata('error', 'Wrong Password');
            return redirect()->to('login');
        }
        var_dump($checkuserToken);
    }

    public function Login()
    {
        return view('Auth/index');
    }

    public function login_action()
    {
        $session = session();
        $model = new LoginModel();
        //mengambil data dari view
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $model->where([
            'email' => $email,
        ])->first();
        $pass = $dataUser['password'];
        //cek email terdaftar
        if ($dataUser) {
            //  check activation jika email belum diaktivasi
            if (!$dataUser['active']) {
                return redirect()->to('login')->withInput()->with('error', 'akun belum di aktivasi');
                //  check activation jika email sudah diaktivasi
            } else {
                //check password default
                if (password_verify($password, $pass)) {
                    //memproses session
                    $ses_data = [
                        'id'       => $dataUser['id'],
                        'nama'     => $dataUser['nama'],
                        'email'    => $dataUser['email'],
                        'active'   => 1,
                        'logged_in'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/dashboard');
                    //check password default jika salah
                } else {
                    session()->setFlashdata('error', 'Password Salah');
                    return redirect()->back();
                }
            }
        } else {
            session()->setFlashdata('error', 'email not found');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function forgot()
    {
        return view('Auth\forgot');
    }

    public function forgotPassword()
    {

        $Forgot = new UsersModel();
        $email = $this->request->getPost('email');
        $user = $Forgot->where('email', $email)->first();
        //validation jika email yang dimasukan tidak ada dan kosong
        if (empty($user)) {
            session()->setFlashdata('error', 'email tidak ada');
            return redirect()->back();
        } else {
            $user_info = $Forgot->asObject()->where('email', $this->request->getVar('email'))->first();

            //generate token
            $token = bin2hex(openssl_random_pseudo_bytes(65));

            //get reset password token

            $password_token = new ForgotModel();
            $isOldToken = $password_token->asObject()->where('email', $Forgot->email)->first();

            if ($isOldToken) {
                $password_token->where('email', $user_info->email)
                    ->set(['token' => $token, 'created_at' => Carbon::now()])
                    ->update();
            } else {
                $password_token->insert([
                    'email' => $user_info->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            }

            $actionLink = base_url('/forgot/reset/(:any)' . $token);
            $linkReset = base_url('/forgot/resetpassword/(:any)' . $token);

            $mailData  = array(
                'actionLink' => $actionLink,
                'user' => $user_info,
                'linkReset' => $linkReset,
                'user' => $user_info,
            );

            //setting send email

            $setEmail = \Config\Services::email();

            $setEmail->setFrom('triahmadmaulana0@gmail.com', 'Maulana');
            $setEmail->setTo($email);

            $setEmail->setSubject('Reset Password');
            $setEmail->setMessage('Reset Password.' . '<br>' . 'Token: ' . $token . '<br>' . 'silahkan Klik link Dibawah ini' . '<br>' . 'http://localhost:8080/forgot/reset/' . $token . '<br>');

            $setEmail->send();

            if ($setEmail->send(false)) {
                session()->setFlashdata('error', 'silahkan coba lagi');
                return redirect()->back();
            } else {

                session()->setFlashdata('success', 'silahkan cek email');
                return redirect()->back();
            }
        }
    }


    public function reset($token)
    {
        $passwordResetPassword = new ForgotModel();
        $check_token = $passwordResetPassword->asObject()->where('token', $token)->first();

        if (!$check_token) {
            return redirect()->to('/forgot')->with('error', 'invalid Token.Request another reset');
        } else {
            $diffmins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if ($diffmins > 150000) {
                return redirect()->to('/forgot')->with('error', 'Token Expired.Request another reset');
            } else {
                return view('Auth\reset', ['token' => $token]);
            }
        }
    }

    public function resetPassword($token)
    {

        $validation = new ResetPassword();
        $user = new UsersModel();

        if (!$this->validate($validation->getValidationRules())) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $resetPassword = new ForgotModel();
            $get_token = $resetPassword->asObject()->where('token', $token)->first();

            //get user details
            $user_info = $user->asObject()->where('email', $get_token->email)->first();

            if (!$get_token) {
                return redirect()->back()->with('error', 'invalid Token.Request another reset')->withInput();
            } else {
                $user->where('email', $user_info->email)
                    ->set(['password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)])
                    ->update();

                // 

                $setEmail = \Config\Services::email();

                $setEmail->setFrom('triahmadmaulana0@gmail.com', 'Maulana');
                $setEmail->setTo('email');

                $setEmail->setSubject('Email Test');
                $setEmail->setMessage('reset passowrd succes' . '<br>', 'Silahkan Login Kembali dengan Mengklik link Dibawah ini' . '<br>' . 'http://localhost:8080/admin' . '<br>');

                $setEmail->send();

                if ($setEmail->send(false)) {
                    session()->setFlashdata('error', 'silahkan coba lagi');
                    return redirect()->to('/forgot/reset/' . $token);
                } else {
                    $resetPassword->where('email', $user_info->email)->delete();
                    return redirect()->to('login');
                }
            }
        }
    }
}
