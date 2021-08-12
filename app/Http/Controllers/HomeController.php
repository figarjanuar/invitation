<?php

namespace App\Http\Controllers;

use App\Jobs\SubmitMailJob;
use App\Models\Designer;
use App\Models\InvitationLists;
use Illuminate\Http\Request;
use App\Models\UserList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index($code)
    {
        $expire = Carbon::create(2021, 8, 11)->addDay(30)->format('Y-m-d H:i:s');
        $designers = Designer::all();

        $user = UserList::where('unq_code', $code)->first();

        $invited = InvitationLists::where('user_id', $user->id)->first();
        if($invited) {
            return 'Your invitation id is '.$user->unq_code;
        }

        return view('welcome',[
            'expire'    => $expire,
            'user'      => $user,
            'designers' => $designers
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'dob'       => 'required',
            'gender'    => 'required',
            'designers' => 'required'
        ]);

        $invitation = new InvitationLists();
        $invitation->user_id = $request->input('user_id');
        $invitation->name = $request->input('name');
        $invitation->gender = $request->input('gender');
        $invitation->dob = $request->input('dob');
        $invitation->code = Str::uuid();
        $invitation->save();

        foreach($request->input('designers') as $designer) {
            DB::table('invitation_designer_lists')->insert([
                'inv_id'        => $invitation->id,
                'designer_id'   => $designer,
                'created_at'    => Carbon::now()
            ]);
        }

        $data = [
            'email' => $request->input('email'),
            'code'  => $invitation->code
        ];
        dispatch(new SubmitMailJob($data))->delay(Carbon::now()->addHour());

        return redirect(route('home', ['code' => $request->input('code')]));
    }
}
