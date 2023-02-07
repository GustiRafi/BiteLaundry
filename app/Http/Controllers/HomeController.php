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
            'user' => user::all(),
            'outlet' => outlet::all(),
            'paket' => paket::all(),
            'member' => member::all(),
            'transaksi' => transaksi::all(),
            'log' => log::orderBy('id','desc')->get(),
        ]);
    }
}
