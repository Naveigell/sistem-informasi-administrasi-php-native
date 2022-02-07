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
                <div class="row mt-3">
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
            </div>
            <div class="card mt-4">
                <div class="card-header">Task Progress Summary</div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <form action="">
                                <label for="filter">Filter</label>
                                <input type="date" class="form-control" id="filter" name="date" value="<?= array_key_exists('date', $_GET) ? $_GET['date'] : ''; ?>">
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
            <div class="card mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            Data Tracker
                        </div>
                        <?php if ($counter['tracker']->num_rows > 0) : ?>
                            <a href="../helpers/excel.php<?= count($_GET) > 0 ? '?' . http_build_query($_GET) : ''; ?>" class="btn btn-sm btn-success">
                                <i class="fa fa-print"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Site Id</th>
                            <th scope="col">Site Name</th>
                            <th scope="col">Toco Name</th>
                            <th scope="col">SOW</th>
                            <th scope="col">Tanggal MOS</th>
                            <th scope="col">PIC MOS</th>
                            <th scope="col">Tanggal Site Verify</th>
                            <th scope="col">Tanggal Site Integrasi</th>
                            <th scope="col">Tanggal PR Approved</th>
                            <th scope="col">Tanggal SA Approved</th>
                            <th scope="col">Tanggal SIR Approved</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($counter['tracker']->num_rows > 0) : ?>
                            <?php $i = 1; while ($row = mysqli_fetch_object($counter['tracker'])): ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $row->SiteId; ?></td>
                                    <td><?= $row->SiteName; ?></td>
                                    <td><?= $row->TocoName; ?></td>
                                    <td><?= $row->Sow; ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->MosDate)); ?></td>
                                    <td><?= $row->PicOnSite; ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->SiteVerifyDate)); ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->SiteIntegrasiDate)); ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->PRApproved)); ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->SAApproved)); ?></td>
                                    <td><?= date('m - d - Y', strtotime($row->SIRApproved)); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
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
            'MOS',
            'Site Verify',
            'Site Integrasi',
            'PR',
            'SA',
            'SIR',
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Total',
                backgroundColor: 'rgb(49,166,239)',
                data: [<?= $counter['mos']; ?>, <?= $counter['site_verify']; ?>, <?= $counter['site_integrasi']; ?>, <?= $counter['pr']; ?>, <?= $counter['sa']; ?>, <?= $counter['sir']; ?>],
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
            $('input[type="date"]').on('change', function () {
                $('form').submit();
            })
        })
    </script>
  </body>        
  </html>