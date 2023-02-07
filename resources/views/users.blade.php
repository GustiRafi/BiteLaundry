@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Daftar Pengguna</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Bite Laundry</a></li>
                        <li class="breadcrumb-item active">user</li>
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
                            data-target="#tambahpengguna">Tambah pengguna</button>
                            {{-- modal untuk mrnambah outlet --}}
                        <div class="modal fade" id="tambahpengguna" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModalLabel">Tambah pengguna</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="addusr">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="nama" name="name"
                                                    id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Username" name="username"
                                                    id="username" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" name="email" placeholder="Email" id="email"
                                                    class="form-control" required>
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
                                                <select name="role" class="form-control show-tick" id="role">
                                                    <option>Role</option>
                                                    <option value="owner">Owner</option>
                                                    <option value="kasir">Kasir</option>
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
                            <div class="table-responsive" id="datausr">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>outlet</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $usr)    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$usr->name}}</td>
                                            <td>{{$usr->role}}</td>
                                            <td>
                                                @foreach ($outlets as $row)    
                                                @if ($usr->id_outlet === $row->id )
                                                    {{$row->nama}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <form method="post" id="deleteusr" class="deleteusr" data-route="/account/{{$usr->id}}">
                                                    @method('destroy')
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
            // tambah user
            $('#addusr').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                type: 'post',
                url: '/account',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#addusr").serializeArray(),
                success: function (data) {
                    $('#addusr')[0].reset();
                    $('#datausr').load(document.URL + ' #datausr');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menambahkan pengguna baru',
                        'success'
                    )
                }
               });
            });

            // hapus pengguna
        $('.deleteusr').on('submit',function(e){
            e.preventDefault();
            swal({
              title: "Yakin mau hapus user ini?",
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
                    $('.deleteusr')[0].reset();
                    $('#datausr').load(document.URL + ' #datausr');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menghapus user ' + data ,
                        'success'
                    )
                  }
              });
              }
          });
        });
        });
    </script>
@endsection