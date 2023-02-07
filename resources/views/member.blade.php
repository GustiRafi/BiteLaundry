@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Membership</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Bite Laundry</a></li>
                        <li class="breadcrumb-item active">Daftar Member</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal"
                            data-target="#tambahmember">Tambah Member </button>
                        {{-- modal untuk mrnambah member --}}
                        <div class="modal fade" id="tambahmember" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModalLabel">Tambah Member </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="addmember">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="nama" name="nama"
                                                    id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <textarea name="alamat" id="alamat" placeholder="alamat"
                                                    class="form-control" cols="30" rows="10" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="tel" name="telp" placeholder="No Telp" id="telp"
                                                    class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <select name="gender" class="form-control show-tick" id="gender">
                                                    <option>Gender</option>
                                                    <option value="l">Laki Laki</option>
                                                    <option value="p">Perempuan</option>
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
                            <div class="table-responsive" id="datamember">
                                <table
                                    class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>alamat</th>
                                            <th>gender</th>
                                            <th>telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $mbr)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mbr->nama }}</td>
                                                <td>{{ $mbr->alamat }}</td>
                                                <td>{{ $mbr->gender }}</td>
                                                <td>{{ $mbr->telp }}</td>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-default waves-effect m-r-20"
                                                        data-toggle="modal"
                                                        data-target="#editmember{{ $mbr->id }}"><i class="zmdi zmdi-edit"></i></button>
                                                    {{-- modal untuk mrnambah member --}}
                                                    <div class="modal fade" id="editmember{{ $mbr->id }}"
                                                        tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="title" id="defaultModalLabel">edit Paket
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" method="post" id="addmember">
                                                                        <div class="mb-3">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="nama" name="nama"
                                                                                id="editnama{{ $mbr->id }}"
                                                                                value="{{ $mbr->nama }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <textarea name="alamat"
                                                                                id="editalamat{{ $mbr->id }}"
                                                                                placeholder="alamat"
                                                                                class="form-control" cols="30"
                                                                                value="{{ $mbr->alamat }}" rows="10"
                                                                                required>{{ $mbr->alamat }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <select name="gender"
                                                                                class="form-control show-tick"
                                                                                id="editgender{{ $mbr->id }}">
                                                                                <option>Gender</option>
                                                                               @if($mbr->gender === 'l')
                                                                                    <option value="l" selected>Laki Laki
                                                                                    </option>
                                                                                    <option value="p">perempuan</option>
                                                                                @endif
                                                                                @if($mbr->gender === 'p')
                                                                                    <option value="l">Laki Laki</option>
                                                                                    <option value="p" selected>perempuan
                                                                                    </option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="tel" class="form-control"
                                                                                placeholder="telp" name="telp"
                                                                                id="edittelp{{ $mbr->id }}"
                                                                                value="{{ $mbr->telp }}" required>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-default btn-round waves-effect"
                                                                        onclick="return  editmember({{ $mbr->id }})">SAVE
                                                                        CHANGES</button>
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect"
                                                                        data-dismiss="modal">CLOSE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form method="post" id="deletmember" class="deletmember"
                                                        data-route="/membership/{{ $mbr->id }}">
                                                        @method('destroy')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i></button>
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
    $(document).ready(function () {
        // tambah member
        $('#addmember').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/membership',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#addmember").serializeArray(),
                success: function (data) {
                    $('#addmember')[0].reset();
                    $('#datamember').load(document.URL + ' #datamember');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menambahkan member baru',
                        'success'
                    )
                }
            });
        });

        // hapus member
        $('.deletmember').on('submit', function (e) {
            e.preventDefault();
            swal({
                    title: "Yakin mau hapus member ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: $(this).data('route'),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                '_method': 'delete'
                            },
                            success: function (data) {
                                $('.deletmember')[0].reset();
                                $('#datamember').load(document.URL + ' #datamember');
                                swal(
                                    'SUCCESS!!',
                                    'Berhasil menghapus member ' + data,
                                    'success'
                                )
                            }
                        });
                    }
                });
        });
    });

    // edit member
    function editmember(id) {
        $.ajax({
            type: 'PUT',
            url: '/membership/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'nama': $('#editnama' + id).val(),
                'alamat': $('#editalamat' + id).val(),
                'telp': $('#edittelp' + id).val(),
                'gender': $('#editgender' + id).val()
            },
            success: function (data) {
                $('#datamember').load(document.URL + ' #datamember');
                swal(
                    'SUCCESS!!',
                    'Berhasil Memperbarui member ' + data,
                    'success'
                )
            }
        });
    }

</script>
@endsection
