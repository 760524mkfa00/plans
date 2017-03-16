<?php

namespace Plans\Http\Controllers;

use Illuminate\Http\Request;

use Plans\Http\Requests;

use Plans\Models\User;

/**
 * Class UsersController
 * @package Plans\Http\Controllers
 */
class UsersController extends Controller
{

    /**
     * @var Users
     */
    protected $units;


    /**
     * UsersController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->middleware('auth');

        $this->users = $users;
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

//    public function data($id)
//    {
//
//        $data = User::select('hourly_rate')->where('id', $id)->get();
//
//        return \Response::json(array(
//            'success' => true,
//            'data' => $data
//        ));
//
//    }


}
