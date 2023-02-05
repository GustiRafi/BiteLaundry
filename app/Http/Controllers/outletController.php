<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;

class outletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('outlet',[
            'outlets' => outlet::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => ['required','max:255'],
            'alamat' => ['required'],
            'telp' => ['required','min:12','max:15']
        ]);

        outlet::create($validate);

        return response('berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => ['required','max:255'],
            'alamat' => ['required'],
            'telp' => ['required','min:12','max:15']
        ]);

        $outlet = outlet::find($id);
        $nama = $outlet->nama;

        outlet::where('id',$id)->first()->update($validate);

        return response($nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = outlet::find($id);
        $name = $outlet->nama;
        outlet::Where('id',$id)->delete();

        return response($name);
    }
}