<?php 
include './config/koneksi.php';
session_start();
include './templates/header.php'; ?>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Anggota</h1>
            <a href="insert_anggota.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
           Tambah Anggota</a>
  </div>

  <div class="row">

  <div class="col-md-12">
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nim</th>
                      <th>Nama Anggota</th>
                      <th>Jurusan</th>
                      <th>Fakultas</th>
                      <th>Total Buku Yg Pernah Dipinjam</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php 
                    $query = "SELECT * FROM anggota";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    while($anggota = mysqli_fetch_array($result)) :
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $anggota['nim'] ?></td>
                      <td><?= $anggota['nama_anggota'] ?></td>
                      <td><?= $anggota['jurusan'] ?></td>
                      <td><?= $anggota['fakultas'] ?></td>
                      <td><?= $anggota['jumlah_buku'] ?> Buku</td>
                      <td> <a href="anggota_edit.php?id_anggota=<?= $anggota['id_anggota'] ?>" class="btn btn-warning">
                      Edit </a> <a href="anggota_hapus.php?id_anggota=<?= $anggota['id_anggota'] ?>" class="btn btn-danger">
                      Hapus </a> 
                       </td>
                    </tr>

                    <?php endwhile; ?>
                
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>

  </div>

<?php 

if(isset($_SESSION['message'])) {
  unset( $_SESSION['message']);
?>
  <script>
Swal.fire({
  title: 'Berhasil',
  text: 'Berhasil Memasukan Data',
  icon: 'success',
  confirmButtonText: 'Ok'
})
</script>

<?php } else if (isset($_SESSION['message_edit'])){
  unset( $_SESSION['message_edit']);
  ?>

  <script>
Swal.fire({
  title: 'Berhasil',
  text: 'Berhasil Mengupdate Data',
  icon: 'success',
  confirmButtonText: 'Ok'
})
</script>
<?php } else if (isset($_SESSION['message_hapus'])){   
  unset( $_SESSION['message_hapus']);
  ?>

<script>
Swal.fire({
title: 'Berhasil',
text: 'Berhasil Menghapus Data',
icon: 'success',
confirmButtonText: 'Ok'
})
</script>
<?php } else if (isset($_SESSION['message_hapus_failed'])){   
  unset( $_SESSION['message_hapus_failed']);
  ?>

<script>
Swal.fire({
title: 'Gagal',
text: 'Gagal Menghapus Data',
icon: 'error',
confirmButtonText: 'Ok'
})
</script>
<?php } ?>


<?php include './templates/footer.php'; ?>