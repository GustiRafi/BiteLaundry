<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;

class landingController extends Controller
{
    public function cekstatus(Request $req)
    {
        $transaksi = transaksi::where('kode_invoice',$req->kode)->first();

        $output = '<div class="row">
        <div class="col-12 col-lg-6">
            <p>Nama Member : '. $transaksi->member->nama.'</p>
            <p>Tanggal Entry : '.$transaksi->created_at->isoFormat('dddd, D MMMM Y').'</p>
            <p>Status Pembayaran : '. $transaksi->dibayar .'</p>
            <p>Status Lundry Terkini : '. $transaksi->status.'</p>
        </div>
        <div class="col-12 col-lg-6">
            <h6>Log Perjalan Laundry</h6>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>22 jan 2023</td>
                        <td>Sedang dalam Proses</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';

       return response()->json(['info' => $output]);
    }
}
