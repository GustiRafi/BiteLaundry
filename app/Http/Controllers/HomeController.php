<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\outlet;
use App\Models\member;
use App\Models\paket;
use App\Models\transaksi;
use App\Models\log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'user' => user::orderBy('id','desc')->get(),
            'outlet' => outlet::orderBy('id','desc')->get(),
            'paket' => paket::orderBy('id','desc')->get(),
            'member' => member::orderBy('id','desc')->get(),
            'transaksi' => transaksi::orderBy('id','desc')->get(),
            'log' => log::orderBy('id','desc')->get(),
        ]);
    }
}
