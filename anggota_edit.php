<?php 
include './config/koneksi.php';
session_start();
$id_anggota = $_GET['id_anggota'];

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_anggota'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];

    $query = "UPDATE anggota SET nim='$nim', nama_anggota='$nama', fakultas='$fakultas', jurusan='$jurusan' where id_anggota=$id_anggota";

    $result = mysqli_query($koneksi, $query);


    if ($result) {
        $_SESSION['message_edit'] = "success";
        header('location:anggota.php');
    }else {
        $query2 = "SELECT * FROM anggota where id_anggota=$id_anggota";
$result2 = mysqli_query($koneksi, $query2);
$anggota_editable = mysqli_fetch_array($result2);
        $_SESSION['message'] = 'success';
    }

}else {
$query2 = "SELECT * FROM anggota where id_anggota=$id_anggota";
$result2 = mysqli_query($koneksi, $query2);
$anggota_editable = mysqli_fetch_array($result2);
}

include './templates/header.php'; ?>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between">
            <a href="anggota.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Update Anggota</h1>
              </div>
              <form method="POST" action="" class="user">
                <div class="form-group">
                  <input type="text" name="nim" value="<?= $anggota_editable['nim']; ?>" class="form-control form-control-user"
                   placeholder="Masukan Nim">
                </div>

                <div class="form-group">
                  <input type="text" name="nama_anggota" value="<?= $anggota_editable['nama_anggota']; ?>" class="form-control form-control-user"
                   placeholder="Masukan Nama Anggota">
                </div>

                <div class="form-group">
                  <input type="text" name="fakultas" value="<?= $anggota_editable['fakultas']; ?>" class="form-control form-control-user"
                   placeholder="Masukan Fakultas">
                </div>

                <div class="form-group">
                  <input type="text" name="jurusan" value="<?= $anggota_editable['jurusan']; ?>" class="form-control form-control-user"
                   placeholder="Masukan Jurusan">
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