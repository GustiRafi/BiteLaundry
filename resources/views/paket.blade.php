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
                            data-target="#tambahpaket">Tambah Paket </button>
                            {{-- modal untuk mrnambah paket --}}
                        <div class="modal fade" id="tambahpaket" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModalLabel">Tambah Paket </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="addpaket">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="nama" name="nama"
                                                    id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Harga" name="harga"
                                                    id="harga" required>
                                            </div>
                                            <div class="mb-3">
                                                <select name="id_outlet" class="form-control show-tick" id="id_outlet">
                                                    <option>Outlet</option>
                                                    @foreach ($outlets as $item)
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select name="jenis" class="form-control show-tick" id="jenis">
                                                    <option>Jenis</option>
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut">Selimut</option>
                                                    <option value="bed cover">Bed Cover</option>
                                                    <option value="kaos">Kaos</option>
                                                </select>
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
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <th>Outlet</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pakets as $pkt)    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$pkt->nama}}</td>
                                            <td>{{$pkt->jenis}}</td>
                                            <td>Rp.{{ number_format($pkt->harga,0,',','.') }}</td>
                                            <td>
                                                @foreach ($outlets as $row)    
                                                @if ($pkt->id_outlet === $row->id )
                                                    {{$row->nama}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                            data-target="#editpaket{{$pkt->id}}"><i class="zmdi zmdi-edit"></i><</button>
                            {{-- modal untuk mrnambah paket --}}
                        <div class="modal fade" id="editpaket{{$pkt->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModalLabel">edit Paket </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="addpaket">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="nama" name="nama"
                                                    id="editnama{{$pkt->id}}" value="{{$pkt->nama}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Harga" name="harga"
                                                    id="editharga{{$pkt->id}}" value="{{$pkt->harga}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <select name="id_outlet" class="form-control show-tick" id="editid_outlet{{$pkt->id}}">
                                                    <option>Outlet</option>
                                                    @foreach ($outlets as $item)
                                                    @if ($pkt->id_outlet === $item->id)    
                                                    <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                                    @else
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select name="jenis" class="form-control show-tick" id="editjenis{{$pkt->id}}">
                                                    <option>Jenis</option>
                                                    @if ($pkt->jenis == 'kiloan')
                                                    <option value="kiloan" selected>Kiloan</option>
                                                    <option value="selimut">Selimut</option>
                                                    <option value="bed cover">Bed Cover</option>
                                                    <option value="kaos">Kaos</option>
                                                    @endif
                                                    @if ($pkt->jenis == 'selimut')
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut" selected>Selimut</option>
                                                    <option value="bed cover">Bed Cover</option>
                                                    <option value="kaos">Kaos</option>
                                                    @endif
                                                    @if ($pkt->jenis == 'bed cover')
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut">Selimut</option>
                                                    <option value="bed cover" selected>Bed Cover</option>
                                                    <option value="kaos">Kaos</option>
                                                    @endif
                                                    @if ($pkt->jenis == 'kaos')
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut">Selimut</option>
                                                    <option value="bed cover">Bed Cover</option>
                                                    <option value="kaos" selected>Kaos</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-default btn-round waves-effect" onclick="return editpaket({{$pkt->id}})">SAVE CHANGES</button>
                                        <button type="button" class="btn btn-danger waves-effect"
                                            data-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <form method="post" id="deletepkt" class="deletepkt" data-route="/paket/{{$pkt->id}}">
                                                    @method('destroy')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i><</button>
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