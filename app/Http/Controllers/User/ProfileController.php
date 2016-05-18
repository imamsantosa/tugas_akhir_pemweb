<?php
/**
 * Created by PhpStorm.
 * User: imamsantosa
 * Date: 5/18/16
 * Time: 17:25
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request, $username)
    {
        if(auth()->user()->username == $username)
            return $this->self();
        else
            return $this->profile($username);
    }

    private function self()
    {
        return View('user/profile_self');
    }

    private function profile($username)
    {

    }
}