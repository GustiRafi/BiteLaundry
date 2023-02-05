<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index()
    {
        return view('profile',[
            'outlet' => outlet::all(),
        ]);
    }

    public function edit_username(Request $req,$id)
    {
        $validate = $req->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['email','required']
        ]);

        User::where('id',$id)->update($validate);
        return response('berhasil');
    }

    public function edit_pass(Request $req,$id)
    {
        if(!Hash::check($req->curentpass,Auth::user()->password))
        {
            return response()->json(['title'=> 'Gagal','msg' => 'Gagal memperbarui password,password lama salah','sts'=> 'error']);
        }
        if(Hash::check($req->curentpass,Auth::user()->password))
        {
            $validate['password'] = Hash::make($req->newpass);
            User::where('id',$id)->update($validate);

            return response()->json(['title'=> 'Berhasil','msg' => 'Berhasil memperbarui password','sts'=> 'success']);
        }
    }


    public function edit_image()
    {
        //
    }
}
