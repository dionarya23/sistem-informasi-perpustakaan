<?php 
include './config/koneksi.php';
session_start();
$id_buku = $_GET['id_buku'];

if (isset($_POST['submit'])) {
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $status = $_POST['status'];

    $query = "UPDATE buku SET isbn='$isbn', judul_buku='$judul_buku', pengarang='$pengarang', tahun_terbit='$tahun_terbit', penerbit='$penerbit', status='$status' where id_buku=$id_buku";

    $result = mysqli_query($koneksi, $query);


    if ($result) {
        $_SESSION['message_edit'] = "success";
        header('location:buku.php');
    }else {
        $query2 = "SELECT * FROM buku where id_buku=$id_buku";
$result2 = mysqli_query($koneksi, $query2);
$buku = mysqli_fetch_array($result2);
        $_SESSION['message'] = 'success';
    }

  }else {
    $query2 = "SELECT * FROM `buku` WHERE id_buku=".$id_buku;
    $result2 = mysqli_query($koneksi, $query2);
    $buku = mysqli_fetch_array($result2);
  }

include './templates/header.php'; ?>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between">
            <a href="buku.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
        <div class="col-lg-6 d-none d-lg-block bg-buku-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Update Buku</h1>
              </div>
              <form method="POST" action="" class="user">
              <div class="form-group">
                  <input type="text" name="isbn" value="<?= $buku['isbn'] ?>" class="form-control form-control-user"
                   placeholder="Masukan ISBN">
                </div>

                <div class="form-group">
                  <input type="text" name="judul_buku" value="<?= $buku['judul_buku'] ?>" class="form-control form-control-user"
                   placeholder="Masukan Judul Buku">
                </div>

                <div class="form-group">
                  <input type="text" name="pengarang" value="<?= $buku['pengarang'] ?>" class="form-control form-control-user"
                   placeholder="Masukan Pengarang">
                </div>

                <div class="form-group">
                  <input type="text" name="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>" class="form-control form-control-user"
                   placeholder="Masukan Tahun Terbit">
                </div>

                <div class="form-group">
                  <input type="text" name="penerbit" value="<?= $buku['penerbit'] ?>" class="form-control form-control-user"
                   placeholder="Masukan Penerbit">
                </div>

                <div class="form-group">
                  <label>Status Buku</label>
                    <select name="status" class="form-control">

                    <?php if($buku['status'] == 'Tersedia'){ ?>
                      <option value="Tersedia">Tersedia</option>
                      <option value="Tidak Tersedia">Tidak Tersedia</option>

                    <?php }else{ ?>

                      <option value="Tidak Tersedia">Tidak Tersedia</option>
                      <option value="Tersedia">Tersedia</option>

                    <?php } ?>
                    </select>
                </div>
                
                <input type="submit" name="submit" value="Update" class="btn btn-primary btn-user btn-block" />
              
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
          text: 'Gagal Mengupdate data',
          icon: 'error',
          confirmButtonText: 'Ok'
        })
 </script>

<?php endif; ?>

  <?php include './templates/footer.php'; ?>