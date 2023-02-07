<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\member;
use App\Models\outlet;
use App\Models\paket;
use App\Models\detail_transaksi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class transaksiController extends Controller
{
    public function riwayatindex()
    {
        return view('transaksi',[
            'transaksis' => transaksi::orderBy('id','desc')->get(),
            'detail_transaksi' => detail_transaksi::all(),
            'members' => member::all(),
            'outlets' => outlet::all(),
        ]);
    }

    public function store(Request $req)
    {
        $validate = $req->validate([
            'id_outlet' => ['required'],
            'id_member' => ['required']
        ]);

        date_default_timezone_set('Asia/Jakarta');

        $invoice = 'BITE-'.Str::random(6);
        $validate['kode_invoice']= $invoice ;
        $validate['tanggal'] = date('Y-m-d\TH:i:sP');
        // $validate['batas_waktu'] = 0;
        // $validate['tanggal_bayar'] = 0;
        // $validate['biaya_tambahan'] = 0;
        // $validate['diskon'] = 0;
        // $validate['pajak'] = 0;
        $validate['status'] = 'baru';
        $validate['dibayar'] = 'belum';
        $validate['id_user'] = Auth::user()->id;

        transaksi::create($validate);

        return redirect('/transaksi/'.$invoice);
    }

    public function show($kode)
    {
        $transaksi = transaksi::where('kode_invoice',$kode)->first();
        return view('pilihpaket_transaksi',[
            'transaksi' => $transaksi,
            'paket' => paket::where('id_outlet',$transaksi->id_outlet)->get(),
            'details' => detail_transaksi::where('id_transaksi',$transaksi->id)->get(),
        ]);
    }

    public function selectpaket(Request $req)
    {
        $paket = paket::where('id',$req->id)->first();
        $output = '<div class="card border-dark px-2">
        <h5>'.$paket->nama.'</h5>
        <p>Rp.'.number_format($paket->harga,0,',','.') .'</p>
            <input type="number" name="qty" id="qty" class="form-control mb-3" min="1" value="1" required>
            <textarea name="keterangan" id="keterangan" placeholder="catatan" cols="5" rows="5" class="form-control mb-3"></textarea>
            <button onclick="return addpaket('.$req->id_transaksi.','.$paket->id.')" class="btn btn-success">Tambah</button>
        </form>
    </div>';

        return response($output);
    }

    public function tambahpaket(Request $req, $id_transaksi,$id_paket)
    {
        $validate = $req->validate([
            'qty' => ['required'],
            'keterangan' => ['max:255'],
        ]);

        $validate['id_transaksi'] = $id_transaksi;
        $validate['id_paket'] = $id_paket;

        detail_transaksi::create($validate);

        return response('Berhasil menambah paket');
        
    }

    public function hapuspaket($id)
    {
        detail_transaksi::where('id',$id)->delete();
        return response('berhasil');
    }

    public function tambahbiaya(Request $req,$id)
    {

        $transaksi = transaksi::find($id);
        $details = detail_transaksi::where('id_transaksi',$id)->get();
        $validate = $req->validate([
            'batas_waktu' => ['required'],
            'pajak' => ['max:255'],
            'biaya_tambahan' => ['max:255'],
            'diskon' => ['max:255'],
        ]);

        $subtotal=0;
        foreach($details as $row)
        {
            $harga = $row->paket->harga*$row->qty;
            $subtotal += ($harga);
        }

        $total = $req->pajak + $req->biaya_tambahan + $subtotal;
        $discount = $total * $req->diskon / 100;
        $fixtotal = $total - $discount;

        $validate['total_harga'] = $fixtotal;

        transaksi::where('id',$id)->update($validate);

        return redirect('/invoice-transaksi/'.$transaksi->kode_invoice);
        
    }

    public function pembayaran(Request $req,$id)
    {
        $data['dibayar'] = $req->dibayar;
        $data['tanggal_bayar'] = now();
        transaksi::where('id',$id)->update($data);

        return response('success');
    }

    public function status(Request $req,$id)
    {
        $data['status'] = $req->status;
        $transaksi = transaksi::find($id);

        if($req->status == 'diambil')
        {
            transaksi::where('id',$id)->first()->delete();
            return redirect()->back()->with('success','Laundry ' . $transaksi->kode_invoice . ' baru saja diambil');
        }else{
            transaksi::where('id',$id)->first()->update($data);
            return redirect()->back()->with('success','Laundry ' . $transaksi->kode_invoice . ' sedang dalam proses selanjutnya');
        }

    }
}
