<?php

namespace Plans\Http\Controllers;

use Plans\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * UsersController constructor.
     * @param User $users
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @return mixed
     */
    public function index()
    {

        $data = User::all();
        return view('users.index')
            ->withData($data);
    }

}
