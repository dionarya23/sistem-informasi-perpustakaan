<?php 
include './config/koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_anggota'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];

    $query = "INSERT INTO anggota (id_anggota,nim, nama_anggota, fakultas, jurusan) VALUES('', '$nim', '$nama',  '$fakultas', '$jurusan')";

    $result = mysqli_query($koneksi, $query);

    // var_dump($koneksi);
    // var_dump($query);
    // var_dump($_POST);
    // die();
    if ($result) {
        $_SESSION['message'] = "success";
        header('location:anggota.php');
    }else {
        
        $_SESSION['message'] = 'success';
    }


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
                <h1 class="h4 text-gray-900 mb-4">Tambah Anggota</h1>
              </div>
              <form method="POST" action="" class="user">
                <div class="form-group">
                  <input type="text" name="nim" class="form-control form-control-user"
                   placeholder="Masukan Nim">
                </div>

                <div class="form-group">
                  <input type="text" name="nama_anggota" class="form-control form-control-user"
                   placeholder="Masukan Nama Anggota">
                </div>

                <div class="form-group">
                  <input type="text" name="fakultas" class="form-control form-control-user"
                   placeholder="Masukan Fakultas">
                </div>

                <div class="form-group">
                  <input type="text" name="jurusan" class="form-control form-control-user"
                   placeholder="Masukan Jurusan">
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

  <?php include './templates/footer.php'; ?>