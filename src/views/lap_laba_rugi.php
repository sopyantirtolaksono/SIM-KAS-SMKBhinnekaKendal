
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Laba Rugi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Lap. Laba Rugi</li>
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

        <form action="src/components/ajax/lap_laba_rugi.php" method="post" id="formLapLabaRugi">
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
                  <!-- <a href="src/components/export_pages/excel_lap_laba_rugi.php" class="btn btn-success mb-3" target="_blank" id="btnDownloadExcel">Download Excel</a> -->
                  <a href="src/components/export_pages/print_lap_laba_rugi.php?val=" class="btn btn-default mb-3" target="_blank" id="btnPrint">Print</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Laba Rugi</h3>
          </div>
          <!-- /.card-header -->

          <div id="loadData">
            <div class="card-body table-responsive p-0">
              <table id="example1" class="table table-bordered table-striped">

                <!-- bagian pendapatan -->
                <thead>
                  <tr>
                    <th colspan="8">Pendapatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>No matching records found</td>
                      <td>Rp. 0</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Pendapatan</strong></td>
                      <td><strong>Rp. 0</strong></td>
                  </tr>
                </tbody>

                <!-- bagian biaya operasional -->
                <thead>
                  <tr>
                    <th colspan="8">Biaya Operasional</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                      <td>No matching records found</td>
                      <td>Rp. 0</td>
                      <td></td>
                  </tr>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Biaya Operasional</strong></td>
                      <td><strong>Rp. 0</strong></td>
                  </tr>
                  <tr>
                      <td colspan="2" class="text-center"><strong>Laba Kotor Usaha</strong></td>
                      <td><strong>Rp. 0</strong></td>
                  </tr>
                </tbody>

                <!-- bagian pendapatan lainnya -->
                <thead>
                  <tr>
                    <th colspan="8">Pendapatan Lainnya</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                      <td>No matching records found</td>
                      <td>Rp. 0</td>
                      <td></td>
                  </tr>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Pendapatan Lainnya</strong></td>
                      <td><strong>Rp. 0</strong></td>
                  </tr>
                </tbody>

                <!-- bagian biaya lainnya -->
                <thead>
                  <tr>
                    <th colspan="8">Biaya Lainnya</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                      <td>No matching records found</td>
                      <td>Rp. 0</td>
                      <td></td>
                  </tr>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Biaya Lainnya</strong></td>
                      <td><strong>Rp. 0</strong></td>
                  </tr>
                  <tr>
                      <td colspan="2" class="text-center"><strong>Laba/Rugi Bersih Usaha</strong></td>
                      <td><strong>Rp. 0</strong></td>
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
<script src="src/dist/js/ajax/lap_laba_rugi.js"></script>