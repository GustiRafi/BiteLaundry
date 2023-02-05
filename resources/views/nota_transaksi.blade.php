<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      @media print{
        #back{
          display: none;
        }
      }
      .card {
        margin: 20px 0;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      }
      .card-title {
        margin-bottom: 1rem;
      }
      .card-text {
        font-size: 1.25rem;
        margin-bottom: 1rem;
      }
      .table {
        margin-bottom: 0;
      }
      .table td, .table th {
        padding: 0.75rem;
        vertical-align: middle;
      }
      .text-center {
        text-align: center;
      }
      .text-right {
        text-align: right;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <a href="/transaksi" id="back"><button class="btn btn-primary m-4">Back</button></a>
      <div class="text-center mb-3">
        <img src="/assets/images/logo.jpg" alt="Logo" style="width:150px;">
        <h3 class="text-primary"><b>Bite Laundry</b></h3>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Invoice Transaksi</h4>
          <p class="card-text text-center pb-3">Nota ini jangan sampai hilang,ini akan di gunakan sebagai bukti untuk mengambil laundry</p>
          <table class="table my-4">
            <tbody>
              <tr>
                <th>Tanggal Entry Pesanan</th>
                <td>: {{$transaksi->created_at->isoFormat('dddd, D MMMM Y')}}</td>
              </tr>
              <tr>
                <th>Kode Invoice</th>
                <td>: {{$transaksi->kode_invoice}}</td>
              </tr>
              <tr>
                <th>Batas Waktu Pengambilan</th>
                <td>: {{ date('d/m/Y', strtotime($transaksi->batas_waktu)) }}</td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Jenis Laundry</th>
                <th>Jumlah</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($detail as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->paket->nama}}</td>
                <td>{{$item->paket->jenis}}</td>
                <td>{{$item->qty}}</td>
                <td>Rp.{{ number_format($item->paket->harga,0,',','.') }}</td>
                @php
                    $subtotal = $item->qty*$item->paket->harga;
                    $total=0;
                @endphp
              </tr>
              @endforeach
              <tr>
                <td colspan="4"" class="text-right">Subtotal</td>
                <td>Rp.{{ number_format($subtotal,0,',','.') }}</td>
              </tr>
              <tr>
                <td colspan="4" class="text-right">Pajak</td>
                <td>Rp.{{ number_format($transaksi->pajak,0,',','.') }}</td>
              </tr>
              <tr>
                <td colspan="4" class="text-right">Diskon</td>
                <td>Rp 5.000</td>
              </tr>
              <tr>
                <td colspan="4" class="text-right">Biaya Tambahan</td>
                <td>Rp.{{ number_format($transaksi->biaya_tambahan,0,',','.') }}</td>
              </tr>
              <tr>
                <td colspan="4" class="text-right">Total</td>
                <td>Rp.{{ number_format($transaksi->total_harga,0,',','.') }}</td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  window.print();
</script>
