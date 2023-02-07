<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bite Laundry</title>
    <link rel="icon" href="/assets/images/logo.jpg" type="image/x-icon"> <!-- Favicon-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/landing/css/bootstrap.min.css">

    <link rel="stylesheet" href="/landing/css/bootstrap-icons.css">

    <link rel="stylesheet" href="/landing/css/owl.carousel.min.css">

    <link rel="stylesheet" href="/landing/css/owl.theme.default.min.css">

    <link href="/landing/css/templatemo-pod-talk.css" rel="stylesheet">

    <!--

TemplateMo 584 Pod Talk

https://templatemo.com/tm-584-pod-talk

-->
</head>

<body>

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand me-lg-5 me-0" href="index.html">
                    <img src="/assets/images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                </a>
                <h5 class="text-white">Bite Laundry</h5>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#cek">Cek Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#About">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Outlet">Outlet</a>
                        </li>
                    </ul>

                    {{-- <div class="ms-4">
                        <a href="#section_3" class="btn custom-btn custom-border-btn smoothscroll">Get started</a>
                    </div> --}}
                </div>
            </div>
        </nav>


        <section class="hero-section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 my-5">
                        <div class="text-center mb-5 pb-5">
                            <h1 class="text-white">Solusi Malas Nyuci</h1>

                            <h5 class="text-white">Teruslah Malas nyuci</h5>

                            {{-- <a href="#section_2" class="btn custom-btn smoothscroll mt-3">Start listening</a> --}}
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="latest-podcast-section section-padding pb-0" id="cek">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap my-5">
                            <h4 class="section-title text-center">Cek Status Laundry Kamu Di Sini</h4>
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <form action="" method="get" class="custom-form search-form flex-fill me-3" role="search" id="cari">
                            <div class="input-group input-group-lg">
                                <input name="kode" type="search" class="form-control" id="kode" placeholder="Masukan Kode Invoice"
                                    aria-label="Search">
        
                                <button type="submit" class="form-control" id="submit">
                                    <i class="bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-12 col-lg-12 mt-4">
                        <div class="row">
                            <div class="col-12 col-lg-6" id="statuslaundry">
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3" id="title"></div>
                                <table class="table table-responsive table-striped table-hover">
                                    <thead id="thead"></thead>
                                    <tbody id="log">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="topics-section section-padding pb-0" id="About">
            <div class="container">
                <h5>Tentang Kami</h5>
                <div class="card border-0 my-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="/assets/images/logo.png" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Bite Laundry</h5>
                          <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem maiores, nesciunt qui aut voluptate hic ab dignissimos possimus perferendis! Velit ut laborum repudiandae accusamus sapiente reiciendis, eum unde quod veritatis.</p>
                          <p class="card-text"><small class="text-muted">Solusi malas nyuci!!</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </section>


        <section class="trending-podcast-section section-padding" id="Outlet">
            <div class="container">
                <h5>Outlet Kami</h5>
                <table class="table mt-3 table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telp</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $item)                            
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->telp}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </section>
    </main>


    <footer class="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                    <div class="subscribe-form-wrap">
                        <h6>Bite Laundry</h6>

                        <h4>Solusi Malas Nyuci</h4>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4 mb-md-0 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Contact</h6>

                    <p class="mb-2"><strong class="d-inline me-2">Phone:</strong> 010-020-0340</p>

                    <p>
                        <strong class="d-inline me-2">Email:</strong>
                        <a href="#">BiteLaundry@malas.com</a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <h6 class="site-footer-title mb-3">Download Mobile</h6>

                    <div class="site-footer-thumb mb-4 pb-2">
                        <div class="d-flex flex-wrap">
                            <a href="#">
                                <img src="/landing/images/app-store.png" class="me-3 mb-2 mb-lg-0 img-fluid" alt="">
                            </a>

                            <a href="#">
                                <img src="/landing/images/play-store.png" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <h6 class="site-footer-title mb-3">Social</h6>

                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container pt-5">
            <div class="row align-items-center">

                <div class="col-lg-2 col-md-3 col-12">
                    <a class="navbar-brand" href="index.html">
                        <img src="/assets/images/logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                    </a>
                </div>

                <div class="col-lg-7 col-md-9 col-12">
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Homepage</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Browse episodes</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Help Center</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-12">
                    <p class="copyright-text mb-0">Copyright © 2036 Bite Laundry</p>
                </div>
            </div>
        </div>
    </footer>


    <!-- JAVASCRIPT FILES -->
    <script src="/landing/js/jquery-3.6.1.js"></script>
    <script src="/landing/js/bootstrap.bundle.min.js"></script>
    <script src="/landing/js/owl.carousel.min.js"></script>
    <script src="/landing/js/custom.js"></script>
    <script>
        $(document).ready(function(){
            $('#cari').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                  type: 'get',
                  url: '/cek-status',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: {
                        'kode': $("#kode").val(),
                  },
                  success: function (data) {
                    $('#statuslaundry').html(data.info);
                    $('#thead').html(data.thead);
                    $('#log').html(data.tbody);
                    $('#title').html(data.title);
                  }
              });
            });
        });
    </script>

</body>

</html>