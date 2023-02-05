@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Buat Transaksi</h2>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="" id="buatpesanan">
                                <div class="row clearfix">
                                    <div class="col-12 col-lg-6 mb-3">
                                        {{-- <select name="id_outlet" class="form-control show-tick" id="pilihoutlet">
                                            <option value="">Pilih outlet</option>
                                            @foreach ($outlets as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        {{-- <select name="id_member" class="form-control show-tick" id="id_member">
                                            <option value="">Pilih Member</option>
                                            @foreach ($members as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control datetimepicker" name="tanggal" id="tanggal" placeholder="Tanggal Pembuatan">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control datetimepicker" name="batas_waktu" id="bataspembayaran" placeholder="Batas Waktu Pembayaran">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" id="paket">
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
                                <div class="mb-3 float-end">
                                    <button type="submit" class="btn btn-info btn-sm">Save</button>
                                </div>
                            </form>
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
            $("#pilihoutlet").on('change',function(){
                $.ajax({
                    type: 'get',
                    url: '/get-paket',
                    data: {
                        'paket': $(this).children("option:selected").val(),
                    },
                    success: function (data) {
                        $('#paket').html(data);
                    }
                });
            });

            $('#buatpesanan').on('submit',function(e){
                e.preventDefault();
                localStorag.setItem('')
                $.ajax({
                    type: 'get',
                    url: '/buat-transaksi',
                    data: {
                        'id_outlet': $('#pilihoutlet').children("option:selected").val(),
                        'id_member': $('#id_member').children("option:selected").val(),
                        'tanggal': $('#tanggal').val(),
                        'batas_waktu': $("#bataspembayaran").val(),
                        'biaya_tambahan': $("#biaya_tambahan").val(),
                        'diskon':$("#diskon").val(),
                        'pajak': $("#pajak").val(),
                    },
                    success: function (data) {
                        $('#paket').html(data);
                    }
                });
            });
        });
    </script>
@endsection
