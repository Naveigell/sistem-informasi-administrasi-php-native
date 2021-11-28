<?php
include 'koneksi.php';

//input User
if (isset($_POST['tambahuser'])) 
{
  $Id           = $_GET['Id'];
  $Nama         = $_POST['Nama'];
  $User         = $_POST['User'];
  $Pass         = $_POST['Pass'];
  $Email        = $_POST['Email'];
  $NoHp         = $_POST['NoHp'];
  $Level        = $_POST['Level'];
  
  $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_user WHERE Id='$Id'"));
  if ($cek > 0){
    header("location: ../PM/KelolaDataUser.php?pesan=gagaltambah");
  }
  else {
    $query = "INSERT INTO tb_user (Nama, User, Pass, Email, NoHp, Level) VALUES('$Nama', '$User', '$Pass', '$Email','$NoHp', '$Level')";
    mysqli_query($db, $query);
    header("location: ../PM/KelolaDataUser.php?pesan=suksestambah");
  }  
  
}


//edit user
if (isset($_POST['btnEdit'])) 
{
  $Id           = $_GET['Id'];
  $Nama         = $_POST['Nama'];
  $User         = $_POST['User'];
  $Pass         = $_POST['Pass'];
  $Email        = $_POST['Email'];
  $NoHp         = $_POST['NoHp'];
  $Level        = $_POST['Level'];
  
  $getData = mysqli_query($db, "SELECT * FROM tb_user WHERE Id='$Id'");
  $data = mysqli_fetch_assoc($getData);
  
  mysqli_query($db, "UPDATE tb_user SET Nama='$Nama', User='$User', Pass='$Pass',Email='$Email',NoHp='$NoHp',Level='$Level' WHERE Id='$Id'");

  header("location: ../PM/KelolaDataUser.php?pesan=suksesedit");
}


//hapus user
if (isset($_POST['btnHapus'])) 
{
  $Id = $_GET['Id'];
  $getData = mysqli_query($db, "SELECT * FROM tb_user WHERE Id='$Id'");
  $data = mysqli_fetch_assoc($getData);

  mysqli_query($db, "DELETE FROM tb_user WHERE Id='$Id'");
  
  header("location: ../PM/KelolaDataUser.php?pesan=sukseshapus");
} 


?>