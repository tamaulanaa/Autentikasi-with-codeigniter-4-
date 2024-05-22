<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('user/dashboard');
    }

    //--------------------------------------------------------------------

}
