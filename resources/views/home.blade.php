@extends('layouts.dashboard')

@section('content')
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i> BIte Laundry</a></li>
                    <li class="breadcrumb-item active">Dashboard </li>
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
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon zmdi zmdi-accounts-alt">
                    <div class="body bg-primary">
                        <h6>Pengguna</h6>
                        <h2>{{count($user)}} <small class="info">user</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon zmdi zmdi-card-membership">
                    <div class="body bg-info">
                        <h6>Member</h6>
                        <h2>{{count($member)}} <small class="info">memberr</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon zmdi zmdi-city">
                    <div class="body bg-success">
                        <h6>Outlet</h6>
                        <h2>{{count($outlet)}} <small class="info">Outlet</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon zmdi zmdi-shopping-basket">
                    <div class="body bg-warning">
                        <h6>Paket Laundry</h6>
                        <h2>{{count($paket)}} <small class="info">paket laundry</small></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon zmdi zmdi-balance-wallet">
                    <div class="body bg-success">
                        <h6>Transaksi</h6>
                        <h2>{{count($transaksi)}} <small class="info">Transaksi</small></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-4 col-12 my-5">
                <div class="border border-primary mb-4"></div>
                <h5 class="text-primary"><b>Selamat Datang, {{Auth::user()->name}}</b></h5>
                @cannot('owner')    
                <div class="pt-5">
                    <p>Klik tombol dibawah ini untuk menambahkan transaksi baru.</p>
                    <a href="/transaksi"><button class="btn btn-primary">Tambah Transaksi</button></a>
                </div>
                @endcannot
                @can('owner')
                <div class="pt-5">
                    <p>Apapun Yang Terjasi Tetaplah Bernafas</p>
                </div>
                @endcan
            </div>
            <div class="col-lg-8 col-12 my-5">
                <div class="border border-primary mb-4"></div>
                <h5 class="text-primary"><b>Log Aktivitas Laundry</b></h5>
                <div class="pt-5">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Log</td>
                                <td>Tanggal</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->log}}</td>
                                    <td>{{$item->created_at->isoFormat('dddd, D MMMM Y')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
