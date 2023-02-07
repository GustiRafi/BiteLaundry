<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\outlet;
use App\Models\transaksi;
use PDF;

class laporanController extends Controller
{
    public function index()
    {
        return view('laporan',[
            'outlets' => outlet::orderBy('id','desc')->get()
        ]);
    }

    public function getlaporan(Request $req)
    {
        $outlets = $req->outlet;
        $status = $req->status;

        $date_from = $req->tanggal_awal;
        $date_to = $req->tanggal_akhir;
        $result="";
        $i =1;

        $transaksi = transaksi::all();

        if ($outlets) {
            $transaksi = transaksi::where('id_outlet',$outlets)->get();

        }

        if ($status) {
            $transaksi = transaksi::where('status', '=', $status)->get();
        }

        if ($date_from) {
            $transaksi = transaksi::where('tanggal', '>=', $date_from)->where('tanggal', '<=', $date_to)->get();
        }

        $export = '<form id="exporter" method="post" action="/export-laporan">
        <input type="hidden" name="outlet" id="outlet" value="'.$outlets.'">
        <input type="hidden" name="status" id="status" value="'.$status.'">
        <input type="hidden" name="tanggal_awal" id="tanggal_awal" value="'.$date_from.'">
        <input type="hidden" name="tanggal_akhir" id="tanggal_akhir" value="'.$date_to.'">
        <button type="submit" class="btn btn-primary" id="btnexp">Export PDF</button>
        </form>';

        $thead = '<th>No</th>
        <th>Kode Invoice</th>
        <th>Nama Pelangan</th>
        <th>Telepon</th>
        <th>Outlet</th>
        <th>Status</th>';

        if($transaksi)
        {
            foreach($transaksi as $item)
            {
                $result .= '<tr><td>'.$i.'</td>
                <td>'.$item->kode_invoice.'</td>
                <td>'.$item->member->nama.'</td>
                <td>'.$item->member->telp.'</td>
                <td>'.$item->outlet->nama.'</td>
                <td>'.$item->status.'</td></tr>';
                $i++;
            }
        }else{
            $result .='<p>Tidak Ada data</p>';
        }

        return response()->json(['result'=>$result,'thead' => $thead,'export' => $export]);
    }

    public function export(Request $req)
    {
        $outlets = $req->outlet;
        $status = $req->status;

        $date_from = $req->tanggal_awal;
        $date_to = $req->tanggal_akhir;

        $transaksi = transaksi::all();

        if ($outlets) {
            $transaksi = transaksi::where('id_outlet',$outlets)->get();

        }

        if ($status) {
            $transaksi = transaksi::where('status', '=', $status)->get();
        }

        if ($date_from) {
            $transaksi = transaksi::where('tanggal', '>=', $date_from)->where('tanggal', '<=', $date_to)->get();
        }
        $pdf = PDF::loadView('exportlaporan', [
            'transaksi' => $transaksi,
        ]);
        return $pdf->download('laporan.pdf');
    }
}
