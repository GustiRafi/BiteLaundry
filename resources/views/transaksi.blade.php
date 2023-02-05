@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Jquery DataTables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Normal Tables</li>
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
                            <div class="table-responsive" id="datapkt">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                            </div>
                                            <div class="mb-3">
                                                <h4>Status Pembayaran</h4>
                                                <input type="text" name="dibayar" id="dibayar" class="form-control" value="{{$row->dibayar}}" disabled>
                                                @if ($row->dibayar === 'belum')
                                                    <a href="/pembayaran/{{$row->kode_invoice}}" class="float-right"><button class="btn btn-warning">Bayar sekarang</button></a>
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
        $(document).ready(function(){
            // tambah paket
            $('#addpaket').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                type: 'post',
                url: '/paket',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#addpaket").serializeArray(),
                success: function (data) {
                    $('#addpaket')[0].reset();
                    $('#datapkt').load(document.URL + ' #datapkt');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menambahkan paket baru',
                        'success'
                    )
                }
               });
            });

            // hapus paket
        $('.deletepkt').on('submit',function(e){
            e.preventDefault();
            swal({
              title: "Yakin mau hapus paket ini?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  type: 'post',
                  url: $(this).data('route'),
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: {
                    '_method': 'delete'
                  },
                  success: function (data) {
                    $('.deletepkt')[0].reset();
                    $('#datapkt').load(document.URL + ' #datapkt');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menghapus paket ' + data ,
                        'success'
                    )
                  }
              });
              }
          });
        });
        });

        // edit paket
        function editpaket(id)
    {
        $.ajax({
                type: 'PUT',
                url: '/paket/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'nama': $('#editnama'+id).val(),
                    'harga': $('#editharga'+id).val(),
                    'jenis': $('#editjenis'+id).val(),
                    'id_outlet' : $('#editid_outlet'+id).val()
                },
                success: function (data) {
                    $('#datapkt').load(document.URL + ' #datapkt');
                    swal(
                        'SUCCESS!!',
                        'Berhasil Memperbarui paket ' + data,
                        'success'
                    )
                }
            });
    }
    </script>
@endsection