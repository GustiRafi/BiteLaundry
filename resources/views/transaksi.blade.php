@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Transaksi</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Bite Laundry</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Transaksi</a></li>
                        <li class="breadcrumb-item active">Riwayat</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                            data-target="#tambahpaket">Buat Transaksi</button>
                            {{-- modal untuk mrnambah paket --}}
                        <div class="modal fade" id="tambahpaket" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModalLabel">Buat Transaksi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/add-transaksi" method="post">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <select name="id_outlet" class="form-control show-tick" id="pilihoutlet">
                                                        <option value="">Pilih outlet</option>
                                                        @foreach ($outlets as $item)
                                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <select name="id_member" class="form-control show-tick" id="id_member">
                                                        <option value="">Pilih Member</option>
                                                        @foreach ($members as $item)
                                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                    class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                                                <button type="button" class="btn btn-danger waves-effect"
                                                    data-dismiss="modal">CLOSE</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="table-responsive" id="datatrans">
                                @can('admin')    
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>KOde Invoice</th>
                                            <th>Total Harga</th>
                                            <th>Status Laundry</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $row)    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->member->nama}}</td>
                                            <td>{{$row->kode_invoice}}</td>
                                            <td>Rp.{{ number_format($row->total_harga,0,',','.') }}</td>
                                            <td>
                                                @if ($row->status == 'baru')
                                                    <span class="badge bg-primary">{{$row->status}}</span>
                                                @endif
                                                @if ($row->status == 'proses')
                                                    <span class="badge bg-warning">{{$row->status}}</span>
                                                @endif
                                                @if ($row->status == 'selesai')
                                                    <span class="badge bg-success">{{$row->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->dibayar == 'belum')
                                                    <span class="badge bg-danger">{{$row->dibayar}}</span>
                                                @else
                                                <span class="badge bg-success">{{$row->dibayar}}</span>
                                                @endif
                                            </td>
                                            <td>
                                            <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                                            data-target="#transaksi{{$row->id}}"><i class="zmdi zmdi-edit"></i></button>
                                            {{-- modal untuk mrnambah paket --}}
                                            <div class="modal fade" id="transaksi{{$row->id}}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="title" id="defaultModalLabel">Detail Transaksi</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nama{{$row->id}}">Nama Member</label>
                                                                    <input type="text" class="form-control" placeholder="nama" name="nama"
                                                                        id="nama{{$row->id}}" value="{{$row->member->nama}}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="totalharga{{$row->id}}">Total Pembayaran</label>
                                                                    <input type="text" class="form-control" placeholder="Harga" name="totalharga"
                                                                        id="totalharga{{$row->id}}" value="Rp.{{ number_format($row->total_harga,0,',','.') }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h4>status laundry</h4>
                                                                    <form action="/status/{{$row->id}}" method="post">
                                                                        @csrf
                                                                        <select name="status" class="form-control show-tick" id="status">
                                                                            @if ($row->status === 'baru')
                                                                                <option value="baru" selected>Baru</option>
                                                                                <option value="proses">Proses</option>
                                                                                <option value="selesai">Selesai</option>
                                                                                <option value="diambil">Diambil</option>
                                                                            @endif
                                                                            @if ($row->status === 'proses')
                                                                                <option value="baru" disabled>Baru</option>
                                                                                <option value="proses" selected>Proses</option>
                                                                                <option value="selesai">Selesai</option>
                                                                                <option value="diambil">Diambil</option>
                                                                            @endif
                                                                            @if ($row->status === 'selesai')
                                                                                <option value="baru" disabled>Baru</option>
                                                                                <option value="proses" disabled>Proses</option>
                                                                                <option value="selesai" selected>Selesai</option>
                                                                                <option value="diambil">Diambil</option>
                                                                            @endif
                                                                            @if ($row->status === 'diambil')
                                                                                <option value="baru" disabled>Baru</option>
                                                                                <option value="proses" disabled >Proses</option>
                                                                                <option value="selesai" disabled>Selesai</option>
                                                                                <option value="diambil" selected>Diambil</option>
                                                                            @endif
                                                                        </select>
                                                                        <button type="submit" class="btn btn-primary float-right">Save</button>
                                                                    </form>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h4>Status Pembayaran</h4>
                                                                    @if ($row->dibayar === 'belum')
                                                                        <button class="btn btn-warning" onclick="return bayar({{$row->id}})">Bayar sekarang</button>
                                                                    @else
                                                                        <button class="btn btn-success" disabled>Sudah Dibayar</button>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h4>Detail</h4>
                                                                    <table class="table table-striped table-responsive">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Nama Paket</th>
                                                                                <th>Jumlah</th>
                                                                                <th>Sub Total</th>
                                                                                <th>keterangan</th>
                                                                            </tr>
                                                                        </thead>
                                                                    @foreach ($detail_transaksi as $item)
                                                                    
                                                                        @if ($item->id_transaksi == $row->id)
                                                                            <tr>
                                                                                <td>{{$item->paket->nama}}</td>
                                                                                <td>{{$item->qty}}</td>
                                                                                @php
                                                                                    $subtotal = $item->paket->harga * $item->qty;
                                                                                @endphp
                                                                                <td>Rp.{{ number_format($subtotal,0,',','.') }}</td>
                                                                                @if ($item->keterangan == null)
                                                                                    <td>Tidak ada</td>
                                                                                @else
                                                                                    <td>{{$item->keterangan}}</td>
                                                                                @endif
                                                                            </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{-- <button type="button" --}}
                                                                {{-- class="btn btn-default btn-round waves-effect">SAVE CHANGES</button> --}}
                                                            <button type="button" class="btn btn-danger waves-effect"
                                                                data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endcan
                                @can('kasir')
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>KOde Invoice</th>
                                            <th>Total Harga</th>
                                            <th>Status Laundry</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $row) 
                                        @if (Auth::user()->id_outlet == $row->id_outlet)      
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->member->nama}}</td>
                                                <td>{{$row->kode_invoice}}</td>
                                                <td>Rp.{{ number_format($row->total_harga,0,',','.') }}</td>
                                                <td>
                                                    @if ($row->status == 'baru')
                                                        <span class="badge bg-primary">{{$row->status}}</span>
                                                    @endif
                                                    @if ($row->status == 'proses')
                                                        <span class="badge bg-warning">{{$row->status}}</span>
                                                    @endif
                                                    @if ($row->status == 'selesai')
                                                        <span class="badge bg-success">{{$row->status}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->dibayar == 'belum')
                                                        <span class="badge bg-danger">{{$row->dibayar}}</span>
                                                    @else
                                                    <span class="badge bg-success">{{$row->dibayar}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                                                data-target="#transaksi{{$row->id}}"><i class="zmdi zmdi-edit"></i></button>
                                                {{-- modal untuk mrnambah paket --}}
                                                <div class="modal fade" id="transaksi{{$row->id}}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="title" id="defaultModalLabel">Detail Transaksi</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="nama{{$row->id}}">Nama Member</label>
                                                                        <input type="text" class="form-control" placeholder="nama" name="nama"
                                                                            id="nama{{$row->id}}" value="{{$row->member->nama}}" disabled>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="totalharga{{$row->id}}">Total Pembayaran</label>
                                                                        <input type="text" class="form-control" placeholder="Harga" name="totalharga"
                                                                            id="totalharga{{$row->id}}" value="Rp.{{ number_format($row->total_harga,0,',','.') }}" disabled>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h4>status laundry</h4>
                                                                        <form action="/status/{{$row->id}}" method="post">
                                                                            @csrf
                                                                            <select name="status" class="form-control show-tick" id="status">
                                                                                @if ($row->status === 'baru')
                                                                                    <option value="baru" selected>Baru</option>
                                                                                    <option value="proses">Proses</option>
                                                                                    <option value="selesai">Selesai</option>
                                                                                    <option value="diambil">Diambil</option>
                                                                                @endif
                                                                                @if ($row->status === 'proses')
                                                                                    <option value="baru" disabled>Baru</option>
                                                                                    <option value="proses" selected>Proses</option>
                                                                                    <option value="selesai">Selesai</option>
                                                                                    <option value="diambil">Diambil</option>
                                                                                @endif
                                                                                @if ($row->status === 'selesai')
                                                                                    <option value="baru" disabled>Baru</option>
                                                                                    <option value="proses" disabled>Proses</option>
                                                                                    <option value="selesai" selected>Selesai</option>
                                                                                    <option value="diambil">Diambil</option>
                                                                                @endif
                                                                                @if ($row->status === 'diambil')
                                                                                    <option value="baru" disabled>Baru</option>
                                                                                    <option value="proses" disabled >Proses</option>
                                                                                    <option value="selesai" disabled>Selesai</option>
                                                                                    <option value="diambil" selected>Diambil</option>
                                                                                @endif
                                                                            </select>
                                                                            <button type="submit" class="btn btn-primary float-right">Save</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h4>Status Pembayaran</h4>
                                                                        @if ($row->dibayar === 'belum')
                                                                            <button class="btn btn-warning" onclick="return bayar({{$row->id}})">Bayar sekarang</button>
                                                                        @else
                                                                            <button class="btn btn-success" disabled>Sudah Dibayar</button>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h4>Detail</h4>
                                                                        <table class="table table-striped table-responsive">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Nama Paket</th>
                                                                                    <th>Jumlah</th>
                                                                                    <th>Sub Total</th>
                                                                                    <th>keterangan</th>
                                                                                </tr>
                                                                            </thead>
                                                                        @foreach ($detail_transaksi as $item)
                                                                        
                                                                            @if ($item->id_transaksi == $row->id)
                                                                                <tr>
                                                                                    <td>{{$item->paket->nama}}</td>
                                                                                    <td>{{$item->qty}}</td>
                                                                                    @php
                                                                                        $subtotal = $item->paket->harga * $item->qty;
                                                                                    @endphp
                                                                                    <td>Rp.{{ number_format($subtotal,0,',','.') }}</td>
                                                                                    @if ($item->keterangan == null)
                                                                                        <td>Tidak ada</td>
                                                                                    @else
                                                                                        <td>{{$item->keterangan}}</td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endif
                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- <button type="button" --}}
                                                                    {{-- class="btn btn-default btn-round waves-effect">SAVE CHANGES</button> --}}
                                                                <button type="button" class="btn btn-danger waves-effect"
                                                                    data-dismiss="modal">CLOSE</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                        @endif   
                                        @endforeach
                                    </tbody>
                                </table>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
@section('js')
    <script>
    function bayar(id)
    {
        swal({
              title: "Pastikan sudah benar benar di bayar",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: '/pembayaran/'+id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        'dibayar': 'dibayar'
                    },
                    success: function (data) {
                    $('#datatrans').load(document.URL + ' #datatrans');
                    swal(
                        'SUCCESS!!',
                        'Pembayaran Berhasil',
                        'success'
                    )
                    }
                });
              }
          });
    }
    </script>
@endsection