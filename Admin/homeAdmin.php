<?php
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['Nama']==""){
    header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['Id']==""){
    header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['User']==""){
    header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['Pass']==""){
    header("location:../index.php?pesan=belumlogin");
}
$timeout = 30; // Set timeout menit
$timeout = $timeout * 60; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Sesi Anda Telah Abis Silahkan Login Kembali !'); 
       location.href='../index.php';</script>";
    }
}
$_SESSION['start_time'] = time();

$counter = require_once '../aksi/data_counter.php';
?>

<html>
<head>
    <title>Home PM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/popper.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">


    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>
</head>
<body style="background-color: #f8f9fa">

<?php include_once './../layouts/header.php'; ?>

<div class="col-md-13 d-flex align-items-stretch">

    <?php include_once './../layouts/sidebar.php'; ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="header">
            <div class="row">
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['pr']; ?> &nbsp; PR</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataPR.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['sa']; ?> &nbsp; SA</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataSA.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['sir']; ?> &nbsp; SIR</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataSir.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['mos']; ?> &nbsp; MOS</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataMos.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['site_verify']; ?> &nbsp; Site Verify</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataSiteVerify.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="">
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="font-size: 25px;">
                                <div><i class="fa fa-tasks"></i></div>
                                <div><?= $counter['site_integrasi']; ?> &nbsp; Site Integrasi</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../pages/KelolaDataSiteIntegrasi.php" style="color: #acacac;">Lihat Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Task Progress Summary</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-3">
                        <form action="">
                            <label for="filter">Filter</label>
                            <input type="month" class="form-control" id="filter" name="month" value="<?= array_key_exists('month', $_GET) ? $_GET['month'] : ''; ?>">
                        </form>
                    </div>
                </div>

                <canvas id="myChart"></canvas>
                <br>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th class="col-1" scope="col">No</th>
                        <th class="col-10" scope="col">Detail</th>
                        <th class="col-1" scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; $i = 1; foreach (array_keys($counter) as $key) : ?>
                        <?php if (in_array($key, ['tracker'])) continue; ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $i++; ?></th>
                            <td class="pl-4"><?= ucwords(str_replace('_', ' ', $key)); ?></td>
                            <td class="text-center"><?= $counter[$key]; ?></td>
                        </tr>
                        <?php $total += $counter[$key]; ?>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="2" class="pl-4">Grand Total</th>
                        <th class="text-center"><?= $total; ?></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        'PR',
        'SA',
        'SIR',
        'MOS',
        'Site Verify',
        'Site Integrasi',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Total',
            backgroundColor: 'rgb(49,166,239)',
            data: [<?= $counter['pr']; ?>, <?= $counter['sa']; ?>, <?= $counter['sir']; ?>, <?= $counter['mos']; ?>, <?= $counter['site_verify']; ?>, <?= $counter['site_integrasi']; ?>],
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    ticks: {
                        stepSize: 1,
                        beginAtZero: true,
                    },
                },
            },
        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    $(document).ready(function () {
        $('input[type="month"]').on('change', function () {
            $('form').submit();
        })
    })
</script>
</body>
</html>