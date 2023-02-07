@extends('layouts.dashboard')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Bite Laundry</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-12">
                    <div class="card mcard_3">
                        <div class="body" id="info">
                            <a href="/profile"><img src="{{ asset('storage/'. Auth::user()->image ) }}" class="rounded-circle shadow w-50 h-50" alt="profile-image"></a>
                            <h4 class="m-t-10">{{Auth::user()->name}}</h4>
                            <h4 class="m-t-10">{{Auth::user()->role}}</h4>                            
                        </div>
                    </div>
                    <div class="card" id="detailinfo">
                        <div class="body">
                            <small class="text-muted">Email address: </small>
                            <p>{{Auth::user()->email}}</p>
                            <hr>
                            <small class="text-muted">Username: </small>
                            <p>{{Auth::user()->username}}</p>
                            <hr>
                            <small class="text-muted">Outlet: </small>
                            @foreach ($outlet as $item)
                                @if (Auth::user()->id_outlet === $item->id)
                                <p>{{$item->nama}}</p>
                                @else
                                @endif
                            @endforeach
                            <hr>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-8 col-12">
                                    <div class="card" id="formedit">
                                        <p>Edit Username</p>
                                        <form action="" id="editprofile" data-route="/edit-username/{{ Auth::user()->id }}">
                                            <div class="mb-3">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="{{Auth::user()->name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{Auth::user()->username}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-default btn-round waves-effect">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-8 col-12">
                                    <div class="card">
                                        <p>Edit Password</p>
                                        <form action="" id="editpass" data-route="/edit-password/{{ Auth::user()->id }}">
                                            <div class="mb-3">
                                                <input type="password" name="curentpass" id="curentpass" class="form-control" placeholder="Current Password" required>
                                            </div>
                                            <div class="mb-3">
                                                <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password" required>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-default btn-round waves-effect">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
            // edit profile
            $('#editprofile').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                type: 'post',
                url: $(this).data('route'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#editprofile").serializeArray(),
                success: function (data) {
                    $('#info').load(document.URL + ' #info');
                    $('#detailinfo').load(document.URL + ' #detailinfo');
                    $('#formedit').load(document.URL + ' #formedit');
                    swal(
                        'SUCCESS!!',
                        'Berhasil menambahkan memperbarui data user',
                        'success'
                    )
                }
            });
            });

            // edit password
            $('#editpass').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                type: 'post',
                url: $(this).data('route'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#editpass").serializeArray(),
                success: function (data) {
                    $('#info').load(document.URL + ' #info');
                    $('#editpass')[0].reset();
                    $('#detailinfo').load(document.URL + ' #detailinfo');
                    $('#formedit').load(document.URL + ' #formedit');
                    swal(
                        data.title,
                        data.msg,
                        data.sts
                    )
                }
            });
            });
        });
    </script>
@endsection
