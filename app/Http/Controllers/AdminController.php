<?php

namespace App\Http\Controllers;

use App\Jobs\InviteMailJob;
use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $listUsers = UserList::with('invitation')->get();

        return view('admin', [
            'data' => $listUsers
        ]);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $user = UserList::where('email', $request->input('email'))->first();
        if($user) {
            return redirect('admin');
        }

        $user = new UserList();
        $user->email = $request->input('email');
        $user->unq_code = Str::uuid();
        $user->save();

        $data = [
            'email' => $request->input('email'),
            'code'  => $user->unq_code
        ];
        dispatch(new InviteMailJob($data));

        return redirect('admin');
    }
}
