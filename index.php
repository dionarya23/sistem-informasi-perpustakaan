<?php 
include './config/koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
  header('location:login.php');
}

$sql1 = "select count(*) as total_anggota from anggota";
$sql2 =  "select count(*) as total_buku from buku";
$sql3 = "select count(*) as buku_tersedia from buku where status='Tersedia'";
$sql4 = "select count(*) as buku_tidak_tersedia from buku where status='Tidak Tersedia'";

$result = mysqli_query($koneksi, $sql1);
$anggota = mysqli_fetch_row($result);

$result2 = mysqli_query($koneksi, $sql2);
$buku = mysqli_fetch_row($result2);

$result3 = mysqli_query($koneksi, $sql3);
$buku_tersedia = mysqli_fetch_row($result3);

$result4 = mysqli_query($koneksi, $sql4);
$buku_tidak_tersedia = mysqli_fetch_row($result4);


include './templates/header.php'; ?>
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>


   <!-- Content Row -->
   <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Buku</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?= $buku[0] ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-book fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Anggota</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
          <?= $anggota[0] ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Buku Tersedia</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
              <?= $buku_tersedia[0] ?>
              </div>
            </div>
            <div class="col">
            
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-book-open fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Buku Dipinjam</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
          <?= $buku_tidak_tersedia[0] ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-book-reader fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
<div class="col-md-12">
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Buku Yang Sering Dipinjam</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ISBN</th>
                      <th>Judul Buku</th>
                      <th>Pengarang</th>
                      <th>Penerbit</th>
                      <th>Tahun Terbit</th>
                      <th>Total Dipinjam</th>
                    </tr>
                  </thead>

                  <tbody>

                  <?php

                  $query6 = "SELECT * FROM buku order by total_dipinjam DESC LIMIT 10";
                  $result_buku = mysqli_query($koneksi, $query6);
                  while($buku = mysqli_fetch_array($result_buku)) :
                  ?>
                    <tr>
                      <td><?= $buku['isbn'] ?></td>
                      <td><?= $buku['judul_buku'] ?></td>
                      <td><?= $buku['pengarang'] ?></td>
                      <td><?= $buku['penerbit'] ?></td>
                      <td><?= $buku['tahun_terbit'] ?></td>
                      <td><?= $buku['total_dipinjam'] ?></td>
                    </tr>
                  <?php endwhile; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>


          <!-- DataTales Example -->
          <div class="col-md-12">
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Anggota Yang sering meminjam buku</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Anggota</th>
                      <th>NIM</th>
                      <th>Fakultas</th>
                      <th>Jurusan</th>
                      <th>Total Meminjam Buku</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                  $query_anggota = "SELECT * FROM anggota order by jumlah_buku DESC LIMIT 10";
                  $result_anggota = mysqli_query($koneksi, $query_anggota);
                  while($anggota = mysqli_fetch_array($result_anggota)) :
                  ?>
                    <tr>
                      <td><?= $anggota['nama_anggota'] ?></td>
                      <td><?= $anggota['nim'] ?></td>
                      <td><?= $anggota['fakultas'] ?></td>
                      <td><?= $anggota['jurusan'] ?></td>
                      <td><?= $anggota['jumlah_buku'] ?></td>
                    </tr>
                  <?php endwhile; ?>
               
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>

          </div>



<?php include './templates/footer.php' ?>
