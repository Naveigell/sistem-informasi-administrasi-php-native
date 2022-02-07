<style>
    @media screen and (max-width: 800px) {
        #sidebar {
            display: none;
        }
    }
</style>
<nav id="sidebar" class="img navbar-collapse" style="background-image: url(images/bg_1.jpg);">
    <div class="p-4">
        <a class="navbar-brand" href="#"><img src="../assets/img/logo.png" width="50%"></a> <br><br>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <?php if ($_SESSION['Level'] === 'PM'): ?>
                    <a href="../PM/homePM.php"><span class="fa fa-home mr-3"></span> Home</a>
                <?php elseif ($_SESSION['Level'] === 'Admin'): ?>
                    <a href="../Admin/homeAdmin.php"><span class="fa fa-home mr-3"></span> Home</a>
                <?php else: ?>
                    <a href="../Team/homeTeam.php"><span class="fa fa-home mr-3"></span> Home</a>
                <?php endif; ?>
            </li>
            <?php if (!in_array($_SESSION['Level'], ['Team', 'Admin'])) : ?>
                <li>
                    <a href="../pages/KelolaDataUser.php"><span class="fa fa-table mr-3"></span> Data User</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="../pages/KelolaDataMos.php"><span class="fa fa-table mr-3"></span> Data Mos</a>
            </li>
            <?php if (!in_array($_SESSION['Level'], ['Team'])) : ?>
                <li>
                    <a href="../pages/KelolaDataPR.php"><span class="fa fa-table mr-3"></span> Data PR</a>
                </li>
                <li>
                    <a href="../pages/KelolaDataSA.php"><span class="fa fa-table mr-3"></span> Data SA</a>
                </li>
                <li>
                    <a href="../pages/KelolaDataSir.php"><span class="fa fa-table mr-3"></span> Data Sir</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="../pages/KelolaDataSiteIntegrasi.php"><span class="fa fa-table mr-3"></span> Data Site Integrasi</a>
            </li>
            <li>
                <a href="../pages/KelolaDataSiteVerify.php"><span class="fa fa-table mr-3"></span> Data Site Verify</a>
            </li>
        </ul>

        <div class="footer">
            <p>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> APDA All rights reserved</a>
            </p>
        </div>

    </div>
</nav>