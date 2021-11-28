<?php

include 'koneksi.php';

//input data siswa
if (isset($_POST['daftar'])) 
{
  $Nis              = $_POST['Nis'];
  $NamaSiswa        = $_POST['NamaSiswa'];
  $TanggalLahir     = $_POST['TanggalLahir'];
  $JenisKelamin     = $_POST['JenisKelamin'];
  $Alamat           = $_POST['Alamat'];
  $NomorTelpon      = $_POST['NomorTelpon'];
  $Kelas            = $_POST['Kelas'];
  $Angkatan         = $_POST['Angkatan'];
  $Ekstrakurikuler  = $_POST['Ekstrakurikuler'];
  $Alasan           = $_POST['Alasan'];
  

  $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tbsiswa WHERE Nis='$Nis'"));
  $cek1 = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tbdaftar WHERE Nis='$Nis'"));
  if ($cek > 0){
    header("location: ../daftaranggota.php?pesan=gagaldaftar");
  }
  elseif ($cek1 > 0){
    header("location: ../daftaranggota.php?pesan=gagaldaftar");
  }else {
    $query = "INSERT INTO tbdaftar (Nis, NamaSiswa, TanggalLahir, JenisKelamin, Alamat, NomorTelpon, Kelas, Angkatan, Ekstrakurikuler, Alasan) VALUES('$Nis', '$NamaSiswa', '$TanggalLahir', '$JenisKelamin', '$Alamat', '$NomorTelpon', '$Kelas', '$Angkatan', '$Ekstrakurikuler', '$Alasan')";
    mysqli_query($db, $query);
    header("location: ../daftaranggota.php?pesan=suksesdaftar");
  }
}

//tolak data pendaftar admin
if (isset($_POST['btnTolak'])) 
{
  $id = $_GET['id'];
  $getData = mysqli_query($db, "SELECT * FROM tbdaftar WHERE id='$id'");
  $data = mysqli_fetch_assoc($getData);
  mysqli_query($db, "DELETE FROM tbdaftar WHERE id='$id'");
  header("location: ../home/homeadmin.php?pesan=suksestolak");
  
}



//terima data pendaftaran admin
if (isset($_POST['btnTerima'])) 
{
  $id               = $_GET['id'];
  $Nis              = $_POST['Nis'];
  $NamaSiswa        = $_POST['NamaSiswa'];
  $Password         = $_POST['Password'];
  $Level            = $_POST['Level'];
  $TanggalLahir     = $_POST['TanggalLahir'];
  $JenisKelamin     = $_POST['JenisKelamin'];
  $Alamat           = $_POST['Alamat'];
  $NomorTelpon      = $_POST['NomorTelpon'];
  $Kelas            = $_POST['Kelas'];
  $Angkatan         = $_POST['Angkatan'];
  $Ekstrakurikuler  = $_POST['Ekstrakurikuler'];
  $Alasan           = $_POST['Alasan'];
  

  $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tbsiswa WHERE Nis='$Nis'"));
  if ($cek > 0){
    header("location: ../home/homeadmin.php?pesan=gagalterima");
  }
  else {
    $query = "INSERT INTO tbsiswa (Nis, NamaSiswa, Password, Level, TanggalLahir, JenisKelamin, Alamat, NomorTelpon, Kelas, Angkatan, Ekstrakurikuler, Alasan) VALUES('$Nis', '$NamaSiswa', '$Password', '$Level', '$TanggalLahir', '$JenisKelamin', '$Alamat', '$NomorTelpon', '$Kelas', '$Angkatan', '$Ekstrakurikuler', '$Alasan')";
    mysqli_query($db, $query);

    $id = $_GET['id'];
    $getData = mysqli_query($db, "SELECT * FROM tbdaftar WHERE id='$id'");
    $data = mysqli_fetch_assoc($getData);
    mysqli_query($db, "DELETE FROM tbdaftar WHERE id='$id'");
  
    header("location: ../home/homeadmin.php?pesan=suksesterima");
  }
}


//tolak data pendaftar Pembina
if (isset($_POST['btnTolakPembina'])) 
{
  $id = $_GET['id'];
  $getData = mysqli_query($db, "SELECT * FROM tbdaftar WHERE id='$id'");
  $data = mysqli_fetch_assoc($getData);
  mysqli_query($db, "DELETE FROM tbdaftar WHERE id='$id'");
  header("location: ../pembina/homepembina.php?pesan=suksestolak");
  
}



//terima data pendaftaran Pembina
if (isset($_POST['btnTerimaPembina'])) 
{
  $id               = $_GET['id'];
  $Nis              = $_POST['Nis'];
  $NamaSiswa        = $_POST['NamaSiswa'];
  $Password         = $_POST['Password'];
  $Level            = $_POST['Level'];
  $TanggalLahir     = $_POST['TanggalLahir'];
  $JenisKelamin     = $_POST['JenisKelamin'];
  $Alamat           = $_POST['Alamat'];
  $NomorTelpon      = $_POST['NomorTelpon'];
  $Kelas            = $_POST['Kelas'];
  $Angkatan         = $_POST['Angkatan'];
  $Ekstrakurikuler  = $_POST['Ekstrakurikuler'];
  $Alasan           = $_POST['Alasan'];
  

  $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tbsiswa WHERE Nis='$Nis'"));
  if ($cek > 0){
    header("location: ../pembina/homepembina.php?pesan=gagalterima");
  }
  else {
    $query = "INSERT INTO tbsiswa (Nis, NamaSiswa, Password, Level, TanggalLahir, JenisKelamin, Alamat, NomorTelpon, Kelas, Angkatan, Ekstrakurikuler, Alasan) VALUES('$Nis', '$NamaSiswa', '$Password', '$Level', '$TanggalLahir', '$JenisKelamin', '$Alamat', '$NomorTelpon', '$Kelas', '$Angkatan', '$Ekstrakurikuler', '$Alasan')";
    mysqli_query($db, $query);

    $id = $_GET['id'];
    $getData = mysqli_query($db, "SELECT * FROM tbdaftar WHERE id='$id'");
    $data = mysqli_fetch_assoc($getData);
    mysqli_query($db, "DELETE FROM tbdaftar WHERE id='$id'");
  
    header("location: ../pembina/homepembina.php?pesan=suksesterima");
  }
}

?>