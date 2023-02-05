@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Transaksi</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="body">
                            <h3>Pilih Paket</h3>
                            <div class="row clearfix mb-3">
                               @foreach ($paket as $row)
                                    <div class="col-12 col-lg-4">
                                        <button class="btn btn-success" onclick="return pilihpaket({{$transaksi->id}},{{$row->id}})">
                                            <h5>{{$row->nama}}</h5>
                                            <p>Rp.{{ number_format($row->harga,0,',','.') }}</p>
                                            {{-- <input type="number" name="qty" id="qty" class="form-control" min="1"> --}}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <h2>Tambahkan detail pesanan</h2>
                            <form method="post" class="mt-3" action="/add-diskon/{{$transaksi->id}}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                           <input type="datetime-local" name="batas_waktu" class="form-control" id="batas-waktu" placeholder="Batas Waktu Pembayaran">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-12 col-lg-4 mb-3">
                                        <input type="text" name="biaya_tambahan" class="form-control" id="biaya_tambahan" placeholder="Biaya Tambahan">
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <input type="text" name="diskon" class="form-control" id="diskon" placeholder="Diskon">
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <input type="text" name="pajak" class="form-control" id="pajak" placeholder="Pajak">
                                    </div>
                                </div>
                                <div class="mb-3 float-left">
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 border-primary">
                    <div class="card">
                        <div class="body">
                            <div class=""id="selected_paket"></div>
                            <h2 py-3>Paket Terpilih</h2>
                            <div class="table-responsive" id="datatrans">
                                <table class="table bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>jumlah</th>
                                            <th>harga</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $detail->paket->nama }}</td>
                                                <td>{{$detail->qty}}</td>
                                                <td>Rp.{{ number_format($detail->paket->harga,0,',','.') }}</td>
                                                <td colspan="2">
                                                    <form method="post" id="delete" class="delete" data-route="/hapus-paket-transaksi/{{$detail->id}}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i></button>
                                                    </form>
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
            $('.delete').on('submit',function(e){
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
                  success: function (data) {
                    $('.delete')[0].reset();
                    $('#datatrans').load(document.URL + ' #datatrans');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menghapus paket ',
                        'success'
                    )
                  }
              });
              }
          });
        });
        });

        function addpaket(id_transaksi,$id_paket)
        {
            $.ajax({
                  type: 'post',
                  url: '/add-paket/'+id_transaksi+ '/' + $id_paket,
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: {
                    'qty': $('#qty').val(),
                    'keterangan': $('#keterangan').val(),
                  },
                  success: function (data) {
                    $('#datatrans').load(document.URL + ' #datatrans');
                    swal(
                        'SUCCESS!!',
                        data,
                        'success'
                    )
                  }
                });
        }

        function pilihpaket(id_transaksi,id)
        {
            $.ajax({
                    type: 'get',
                    url: '/pilih-paket',
                    data: {
                        'id_transaksi': id_transaksi,
                        'id': id,
                    },
                    success: function (data) {
                        $('#selected_paket').html(data);
                    }
                });
        }
    </script>
@endsection
