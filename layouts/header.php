<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#124191;">

    <b style="color: #FFFFF0;" class="navbar-brand" href="">PENGELOLAAN DATA ADMINISTRASI INTISEL BALI</b>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        </li>
    </ul>
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item active">
            <a style="color: #FFFFF0;" class="navbar-brand" href="#">Welcome Back, <?php echo $_SESSION['Nama']; ?></a> &nbsp;
            <a class="navbar-brand" href="" data-target="#Profil" data-toggle="modal"><img class="btn btn-outline-primary" src="../assets/img/user.png" width="50"></a>
        </li>
    </ul>
</nav>


<!--Modal Profil User-->
<div class="modal fade" id="Profil" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title" href="#"><img src="../assets/img/user.png" width="40"></a>
                &nbsp;&nbsp;&nbsp;<h4 class="modal-title">Profil User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="../aksi/user/change_password.php">
                <div class="modal-body">
                    <div class="form-group" hidden="true">
                        <Label class="control-label"><h5>ID</h5></Label>
                        <input type="text" name="Id" value="<?php echo $_SESSION['Id']; ?>" class="form-control" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <Label class="control-label"><h5>Nama</h5></Label>
                        <input type="text" name="Nama" value="<?php echo $_SESSION['Nama']; ?>" class="form-control" autocomplete="on" readonly>
                    </div>
                    <div class="form-group">
                        <Label class="control-label"><h5>Username</h5></Label>
                        <input type="text" name="User" value="<?php echo $_SESSION['User']; ?>" class="form-control" autocomplete="off" readonly>
                    </div>
                    <div class="form-group"  hidden="true">
                        <Label class="control-label"><h5>Password</h5></Label>
                        <input type="text" name="Pass" value="<?php echo $_SESSION['Pass']; ?>" class="form-control" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <Label class="control-label"><h5>Ganti Password</h5></Label>
                        <input type="Password" name="PasswordLama" placeholder="Masukkan Password Lama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="Password" name="PasswordBaru" placeholder="Masukkan Password Baru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="Password" name="RetypePasswordBaru" placeholder="Masukkan Lagi Password Baru " class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="GantiPassword">Ganti Password</button>
                    <a class="btn btn-danger" href="../koneksi/logout.php">Logout</a>
                </div>
            </form>
        </div>
    </div>
</div>