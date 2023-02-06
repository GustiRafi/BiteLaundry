<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;

class laporanController extends Controller
{
    public function index()
    {
        return view('laporan',[
            'outlets' => outlet::all()
        ]);
    }

    public function getlaporan(Request $req)
    {
        
    }
}
