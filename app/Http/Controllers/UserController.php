<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hasPortfolio']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.user-settings');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id() . ''],
            'country' => ['exists:App\Models\Country,name'],
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'country' => $request->input('country')
        ]);

        return $user;
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);


        if (!(Hash::check($request->get('current_password'), auth()->user()->password))) {
            return response()->json([
                'errors' => [
                    'current_password' => ['Password is incorrect'],
                ]
            ], 422);
        } elseif (Hash::check($request->get('new_password'), auth()->user()->password)) {
            return response()->json([
                'errors' => [
                    'new_password' => ['The new password is match with old password'],
                ]
            ], 422);
        } else {
            User::find(auth()->user()->id)
                ->update(['password' => Hash::make($request->new_password)]);
        }
    }

    public function notifiable(Request $request)
    {
        $user = auth()->user()->update([
            'is_notifiable' => $request->boolean('is_notifiable'),
        ]);

        return $user;
    }
}
