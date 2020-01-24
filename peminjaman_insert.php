<?php include './config/koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $get_buku        = "SELECT * FROM buku WHERE id_buku=$id_buku";
    $result_get_buku = mysqli_query($koneksi, $get_buku);
    $buku            = mysqli_fetch_array($result_get_buku);

    $total_dipinjam_buku = $buku['total_dipinjam'] + 1;
    $sql_buku_naon    = "UPDATE buku SET status='Tidak Tersedia', total_dipinjam=$total_dipinjam_buku WHERE id_buku=$id_buku";
    $result_buku_naon = mysqli_query($koneksi, $sql_buku_naon);

    $sql_anggota = "SELECT * FROM anggota WHERE id_anggota=$id_anggota";
    $result_anggota = mysqli_query($koneksi, $sql_anggota);
    $anggota = mysqli_fetch_array($result_anggota);

    $total_pinjam_anggota = $anggota['jumlah_buku'] + 1;
    $update_anggota_sql = "UPDATE anggota SET jumlah_buku=$total_pinjam_anggota WHERE id_anggota=$id_anggota";
    $result_anggota = mysqli_query($koneksi, $update_anggota_sql);
    
    $insert_peminjaman = "INSERT INTO peminjaman(id_peminjaman, id_buku, id_anggota, tgl_pinjam, tgl_pengembalian, denda) VALUES('', $id_buku, $id_anggota, '$tgl_pinjam', '', '')";
    $result_peminjaman = mysqli_query($koneksi, $insert_peminjaman);

    if ($result_peminjaman) {
        $_SESSION['message'] = 'success';
        header("location:peminjaman.php");
    } else {
        $_SESSION['message'] = 'success';
    }

}

include './templates/header.php'; ?>


 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between">
            <a href="peminjaman.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
           <i class="fa fa-arrow-left"></i>
           Kembali</a>
  </div>


  <div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah Peminjaman</h1>
              </div>
              <form method="POST" action="" class="user">
              
              <div class="form-group">
                  <label>Judul Buku</label>
                    <select name="id_buku" class="form-control">
                    <?php 
                        $query_buku = "SELECT * FROM buku WHERE status='Tersedia'";
                        $result_buku = mysqli_query($koneksi, $query_buku);
                        while($buku = mysqli_fetch_array($result_buku)):
                    ?>
                        <option value="<?= $buku['id_buku'] ?>"><?= $buku['judul_buku'] ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                  <label>Anggota</label>
                    <select name="id_anggota" class="form-control">
                    <?php 
                        $query_anggota = "SELECT * FROM anggota";
                        $result_anggota = mysqli_query($koneksi, $query_anggota);
                        while($anggota = mysqli_fetch_array($result_anggota)):
                    ?>
                        <option value="<?= $anggota['id_anggota'] ?>"><?= $anggota['nama_anggota'] ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                <label>Tgl Peminjaman</label>
                  <input type="text" name="tgl_pinjam" class="form-control form-control-user"
                  value="<?php echo date('Y-m-d'); ?>"
                >
                </div>
                
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-user btn-block" />
              
              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

<?php

if(isset($_SESSION['message'])) :
  unset( $_SESSION['message']);
?>
<script>
        Swal.fire({
          title: 'Error',
          text: 'Gagal Memasukan Data',
          icon: 'error',
          confirmButtonText: 'Ok'
        })
 </script>
<?php endif; ?>

<?php
include './templates/footer.php';
?>