<?php 
include './config/koneksi.php';
session_start();
include './templates/header.php'; ?>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Peminjaman Buku</h1>
            <a href="peminjaman_insert.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
           Tambah Peminjaman</a>
  </div>

  <div class="row">
  <div class="col-md-12">
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
       
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>No</th>
                      <th>Judul Buku</th>
                      <th>Anggota</th>
                      <th>Tanggal Pinjam</th>
                    </tr>
                  </thead>

                  <tbody>

                  <?php 
                      $query = "SELECT buku.judul_buku, anggota.nama_anggota, 
                                peminjaman.tgl_pinjam FROM peminjaman inner join buku on 
                                buku.id_buku=peminjaman.id_buku inner join anggota on 
                                anggota.id_anggota=peminjaman.id_anggota
                                WHERE peminjaman.tgl_pengembalian=''";
                      $result = mysqli_query($koneksi, $query);
                      $no = 1;
                      while($peminjaman = mysqli_fetch_array($result)):
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $peminjaman['judul_buku'] ?></td>
                      <td><?= $peminjaman['nama_anggota'] ?></td>
                      <td><?= $peminjaman['tgl_pinjam'] ?></td> 
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