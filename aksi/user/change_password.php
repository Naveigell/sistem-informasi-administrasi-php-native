<?php
session_start();
include './../../koneksi/koneksi.php';

if (isset($_POST['GantiPassword'])) {
    $PasswordLama       = $_POST['PasswordLama'];
    $PasswordBaru       = $_POST['PasswordBaru'];
    $RetypePasswordBaru = $_POST['RetypePasswordBaru'];

    if (strlen($PasswordLama) <= 3 || strlen($PasswordLama) <= 3 || strlen($PasswordLama) <= 3) {
        echo "<script>alert('Password karakter tidak boleh kurang dari 4');</script>";

        redirectBack();
    }

    if ($PasswordBaru !== $RetypePasswordBaru) {
        echo "<script>alert('Password baru dan ulangi password baru tidak sama!');</script>";

        redirectBack();
    }

    $exists = mysqli_num_rows(mysqli_query($db, "SELECT * FROM tb_user WHERE Id='{$_SESSION['Id']}' AND Pass=MD5('{$PasswordLama}')"));

    if (!$exists) {
        echo "<script>alert('Password lama salah!');</script>";

        redirectBack();
    } else {
        $success = mysqli_query($db, "UPDATE tb_user SET Pass = MD5('{$PasswordBaru}') WHERE Id='{$_SESSION['Id']}'");

        if ($success) {
            echo "<script>alert('Password berhasil diubah');</script>";
        } else {
            echo "<script>alert('Password gagal diubah');</script>";
        }
    }

    redirectBack();
}

function redirectBack() {
    if(isset($_SERVER['HTTP_REFERER'])) {
        echo "<script>window.location = `{$_SERVER['HTTP_REFERER']}`</script>";
    } else {
        echo "<script>history.go(-1)</script>";
    }
}