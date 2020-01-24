<?php
include './config/koneksi.php';
session_start();
// $begin = new DateTime( '2012-08-01' );
// $end = new DateTime( '2012-08-31' );

// $diff = $begin->diff($end);
// echo $diff->format('%d');

include './templates/header.php';
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengembalian Buku</h1>
  </div>

  <div class="row">
  <div class="col-md-12">
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
        <div class="card-body">

        <form method="GET" action="" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" name="id_peminjaman" placeholder="Masukan ID Peminjaman" class="form-control form-control-user" />
        </div>

            <button type="submit" class="btn btn-primary mb-2">Cari</button>
        </form>
             
        </div>

    </div>

    <?php 

        if (isset($_GET['id_peminjaman'])):
            
    ?>
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>ID Peminjaman</th>
                      <th>Judul Buku</th>
                      <th>Anggota</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Pengembalian</th>
                      <th>Denda</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php 
                    $id_peminjaman = $_GET['id_peminjaman'];
                    $query = "SELECT buku.judul_buku, buku.id_buku, anggota.nama_anggota, 
                              peminjaman.tgl_pinjam FROM peminjaman inner join buku on 
                              buku.id_buku=peminjaman.id_buku inner join anggota on 
                              anggota.id_anggota=peminjaman.id_anggota
                              WHERE peminjaman.tgl_pengembalian='' AND peminjaman.id_peminjaman=$id_peminjaman";
                      $result = mysqli_query($koneksi, $query);
                      $no = 1;
                      while($peminjaman = mysqli_fetch_array($result)):
                        $denda_per = 5000;
                        $total_denda = 0;
                        $begin = new DateTime($peminjaman['tgl_pinjam']);
                        $end = new DateTime(date('Y-m-d'));
                        $diff = $begin->diff($end);
                        $selisih = $diff->format('%d');

                        if ($selisih > 7) {
                            $total_denda = $denda_per * ($selisih-7);
                        }

                        ?>
                    <tr>
                      <td><?= $id_peminjaman ?></td>
                      <td><?= $peminjaman['judul_buku'] ?></td>
                      <td><?= $peminjaman['nama_anggota'] ?></td>
                      <td><?= $peminjaman['tgl_pinjam'] ?></td> 
                      <td><?= date('Y-m-d') ?></td>
                      <td><?= "Rp " . number_format($total_denda,2,',','.'); ?></td>
                      <td> 
                            <a href="kembalikan.php?id_peminjaman=<?= $id_peminjaman; ?>&denda=<?= $total_denda ?>&id_buku=<?= $peminjaman['id_buku'] ?>" class="btn btn-primary">Kembalikan</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
  
  <?php 
if(isset($_SESSION['message'])) {
  unset( $_SESSION['message']);
?>
  <script>
Swal.fire({
  title: 'Berhasil',
  text: 'Berhasil Mengembalikan Buku',
  icon: 'success',
  confirmButtonText: 'Ok'
})
</script>
<?php } else if(isset($_SESSION['message_gagal'])){
  unset( $_SESSION['message']);
    ?>
    <script>
Swal.fire({
  title: 'Gagal',
  text: 'Gagal Mengembalikan Buku',
  icon: 'error',
  confirmButtonText: 'Ok'
})
</script>
<?php } ?>

<?php include './templates/footer.php'; ?>