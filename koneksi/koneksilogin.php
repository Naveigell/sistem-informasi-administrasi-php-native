<?php 
session_start();

include 'koneksi.php';

if (isset($_POST['LoginUser'])) 
{

	$User = $_POST['User'];
	$Pass= $_POST['Pass'];
	
	
// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($db,"select * from tb_user where User='$User' and Pass=MD5('$Pass')");
// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		
		$data = mysqli_fetch_assoc($login);
		$Id                 = $data['Id'];
		$Nama               = $data['Nama'];
		$User               = $data['User'];
		$Pass          		= $data['Pass'];
		
	// cek jika user login sebagai PM
		if($data['Level']=="PM"){


		// buat session login dan username
			$_SESSION['User'] = $User;
			$_SESSION['Pass'] = $Pass;
			$_SESSION['Nama'] = $Nama;
			$_SESSION['Id']   = $Id;
			$_SESSION['Level'] = "PM";
		// alihkan ke halaman dashboard PM
			header("location:../PM/homePM.php");
			
	// cek jika user login sebagai Admin
		}else if($data['Level']=="Admin"){
		// buat session login dan username
			$_SESSION['User'] = $User;
			$_SESSION['Level'] = "Admin";
		// alihkan ke halaman dashboard Admin
			header("location:../Admin/homeAdmin.php");
			
	// cek jika user login sebagai Team
		}else if($data['Level']=="Team"){
		// buat session login dan username
			$_SESSION['User'] = $User;
			$_SESSION['Level'] = "Team";
		// alihkan ke halaman dashboard Team
			header("location:../Team/homeTeam.php");
			
		}else{
			
		// alihkan ke halaman login kembali
			header("location:index.php?pesan=gagal");
		}	
	}else{
		header("location:index.php?pesan=gagal");
	}
}

?>
