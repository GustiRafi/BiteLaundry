<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\log_transaksi;

class landingController extends Controller
{
    public function cekstatus(Request $req)
    {
        $transaksi = transaksi::where('kode_invoice',$req->kode)->first();
        $tbody ="";
        $i =1;

        $info_transaksi = '<h5 class="pb-3">Detail</h5>
            <p>Nama Member : '. $transaksi->member->nama.'</p>
            <p>Tanggal Entry : '.$transaksi->created_at->isoFormat('dddd, D MMMM Y').'</p>
            <p>Status Pembayaran : '. $transaksi->dibayar .'</p>
            <p>Status Lundry Terkini : '. $transaksi->status.'</p>';
        $title="<h5>Proges Laundry Kamu</h5>";
        $thead = '
        <tr>
            <th>No</th>
            <th>Status Laundry</th>
            <th>Di perbarui</th>
        </tr>
        ';

        $log = log_transaksi::where('kode_invoice',$transaksi->kode_invoice)->get();
        foreach($log as $item)
        {
            $tbody .= '<tr>
            <td>'.$i.'</td>
            <td>'.$item->status.'</td>
            <td>'.$item->created_at->isoFormat('dddd, D MMMM Y').'</td>
        </tr>';
        $i++;
        }

       return response()->json(['info' => $info_transaksi,'thead'=>$thead,'tbody'=>$tbody,'title'=>$title]);
    }
}
