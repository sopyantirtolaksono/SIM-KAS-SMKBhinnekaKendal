
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Pendapatan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Lap. Pendapatan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <form action="src/components/ajax/lap_pendapatan.php" method="post" id="formLapPendapatan">
          <div class="row">
            <div class="col-3">
              <!-- Date range -->
              <div class="form-group">
                <label>Date range</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="dateRange" name="date_range">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <div class="col-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <div class="input-group">
                  <button type="submit" class="btn btn-primary" id="btnLihat">Lihat</button>
                </div>
              </div>
            </div>
            <div class="col-8">
              <div class="form-group float-right">
                <label>&nbsp;</label>
                <div class="input-group">
                  <!-- <a href="src/components/export_pages/excel_lap_pendapatan.php?val=" class="btn btn-success mb-3" target="_blank" id="btnDownloadExcel">Download Excel</a> -->
                  <a href="src/components/export_pages/print_lap_pendapatan.php?val=" class="btn btn-default mb-3" target="_blank" id="btnPrint">Print</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Pendapatan</h3>
          </div>
          <!-- /.card-header -->

          <div id="loadData">
            <div class="card-body table-responsive p-0">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Transaksi</th>
                  <th>Tanggal</th>
                  <th>Nama Akun</th>
                  <th>Keterangan</th>
                  <th>Debet(Rp)</th>
                  <th>Kredit(Rp)</th>
                </tr>
                </thead>
                <tbody>

                  <tr>
                      <td colspan="8" class="text-center">No matching records found</td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>

<!-- JS File-->
<!-- Data Pendapatan -->
<script src="src/dist/js/ajax/lap_pendapatan.js"></script>