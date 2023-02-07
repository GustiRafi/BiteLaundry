<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      @media print{
        #back{
          display: none;
        }
      }
      .card {
        margin: 20px 0;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      }
      .card-title {
        margin-bottom: 1rem;
      }
      .card-text {
        font-size: 1.25rem;
        margin-bottom: 1rem;
      }
      .table {
        margin-bottom: 0;
      }
      .table td, .table th {
        padding: 0.75rem;
        vertical-align: middle;
      }
      .text-center {
        text-align: center;
      }
      .text-right {
        text-align: right;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Laporan</h4>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Invoice</th>
                <th>Nama Pelangan</th>
                <th>Telepon</th>
                <th>Outlet</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->kode_invoice}}</td>
                <td>{{$item->member->nama}}</td>
                <td>{{$item->member->telp}}</td>
                <td>{{$item->outlet->nama}}</td>
                <td>{{$item->status}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  window.print();
</script>
