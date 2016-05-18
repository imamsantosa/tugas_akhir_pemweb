<?php
/**
 * Created by PhpStorm.
 * User: imamsantosa
 * Date: 5/18/16
 * Time: 18:15
 */

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;

class SettingProfileController
{
    public function index()
    {
        return View('user/change_profile');
    }

    public function save(Request $request)
    {
        $email = $request->input('email');
        $full_name = $request->input('full_name');
        $birthdate = $request->input('birthdate');
        $status_message = $request->input('status_message');

        auth()->user()->update([
            'email' => $email,
            'full_name' => $full_name,
            'birthdate' => $birthdate,
            'status_message' => $status_message
        ]);
        
        return redirect()->route('user-profile-edit')
            ->with(['status' => 'success', 'title' => 'Success!!', 'message' => 'Your Profile Updated!!']);
    }
}