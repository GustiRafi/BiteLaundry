@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Generate Laporan</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Bite Laundry</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
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
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="body">
                            <h3>Filter Data</h3>
                            <form action="" id="lapor">
                                <div class="mb-3">
                                    <label for="outlet">Pilih Outlet</label>
                                    <select name="outlet" class="form-control show-tick" id="pilihoutlet">
                                    <option value="">Pilih outlet</option>
                                    @foreach ($outlets as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status"  class="form-control show-tick" id="status">
                                    <option value="" selected>Silahkan Pilih</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Rentang Tanggal</label>
                                    <div class="mb-3">
                                        <label for="tanggal_awal">Tanggal Awal</label>
                                        <input type="date" name="tanggal_awal" class="form-control" placeholder="tanggal awal" id="tanggal_awal">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" class="form-control" placeholder="tanggal akhir" id="tanggal_akhir">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                            <div class="mb-3">
                                <p>*Jika ingin mengeksport semua data abaikan form diatas, dan langsung klik cari data.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 border-primary">
                    <div class="card">
                        <div class="body">
                            <h3 py-3>Hasil Filter</h3>
                            <div class="my-4" id="export"></div>
                            <div class="table-responsive">
                                <table class="table bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr id="thead">
                                        
                                        </tr>
                                    </thead>
                                    <tbody id="laporanresult">
                                        
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
           $("#lapor").on('submit',function(e){
            e.preventDefault();
            $.ajax({
                    type: 'post',
                    url: '/get-laporan',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:$("#lapor").serializeArray(),
                    success: function (data) {
                    $('#export').html(data.export);
                    $('#thead').html(data.thead);
                    $('#laporanresult').html(data.result);
                    }
                });
           }); 
                //    $("#exporter").on('submit',function(e){
                //     e.preventDefault();
                //     $.ajax({
                //             type: 'post',
                //             url: '/export-laporan',
                //             data:$("#exporter").serializeArray(),
                //             success: function (data) {
                //             // $('#export').html(data.export);
                //             // $('#thead').html(data.thead);
                //             // $('#laporanresult').html(data.result);
                //             }
                //         });
                //    });

            // function export(outlet,status,date_from,date_to)
            // {
            //     $.ajax({
            //             type: 'post',
            //             url: '/export-laporan',
            //             data:{
            //                 'outlet':outlet,
            //                 'status':status,
            //                 'tanggal_awal':date_from,
            //                 'tanggal_akhir': date_to
            //             },
            //             success: function (data) {
            //             // $('#export').html(data.export);
            //             // $('#thead').html(data.thead);
            //             // $('#laporanresult').html(data.result);
            //             }
            //         });
            // }
        });

    </script>
@endsection
