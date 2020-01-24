<?php 
include './config/koneksi.php';
session_start();
if (isset($_POST['submit'])) {
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];
    $status = $_POST['status'];

    $query = "INSERT INTO buku (id_buku, isbn, judul_buku, pengarang, tahun_terbit, penerbit, status) 
        VALUES('', '$isbn', '$judul_buku', '$pengarang', '$tahun_terbit', '$penerbit', '$status')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['message'] = "success";
        header('location:buku.php');
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
          <div class="col-lg-6 d-none d-lg-block bg-buku-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah Buku</h1>
              </div>
              <form method="POST" action="" class="user">
                <div class="form-group">
                  <input type="text" name="isbn" class="form-control form-control-user"
                   placeholder="Masukan ISBN">
                </div>

                <div class="form-group">
                  <input type="text" name="judul_buku" class="form-control form-control-user"
                   placeholder="Masukan Judul Buku">
                </div>

                <div class="form-group">
                  <input type="text" name="pengarang" class="form-control form-control-user"
                   placeholder="Masukan Pengarang">
                </div>

                <div class="form-group">
                  <input type="text" name="tahun_terbit" class="form-control form-control-user"
                   placeholder="Masukan Tahun Terbit">
                </div>

                <div class="form-group">
                  <input type="text" name="penerbit" class="form-control form-control-user"
                   placeholder="Masukan Penerbit">
                </div>

                <div class="form-group">
                  <label>Status Buku</label>
                    <select name="status" class="form-control">
                      <option value="Tersedia">Tersedia</option>
                      <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
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