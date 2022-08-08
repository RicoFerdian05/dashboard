        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php 
            // var_dump($ip_ipk_mahasiswa_semester);var_dump($tahun_kuliah);var_dump($tahun_ajaran);
            // var_dump($angkatan);
            // var_dump($tahun_ajaran[0]['tahun_ajaran']);
            // var_dump(($cur_tahun_ajaran));
            // var_dump(isset($ip_ipk_mahasiswa_semester));
            // var_dump($ip_ipk_mahasiswa_semester);
            // var_dump($nilai_ipk);
            // var_dump($arr_angkatan);
            // var_dump($angkatan);
            // var_dump($angkatan[0]['angkatan']);
            // if ($arr_angkatan == null) {
            //     echo "terisi";
            // }
            // var_dump($data_beasiswa);
            // var_dump($count_beasiswa);
            // var_dump($data_prestasi);
            // var_dump($count_prestasi);
            // var_dump($count_kehadiran);
            // var_dump($data_kehadiran);
            // var_dump($count_TAK);
            // var_dump($data_TAK);
            ?>

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?=$title;?></h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>


            <!-- Content Row -->
            <div class="row col-xl-12">
                <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTahunAjaran"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if (!empty($cur_tahun_ajaran)): ?>
                        Tahun Ajaran <?= $cur_tahun_ajaran; ?>
                        <?php else: ?>
                        Periode Akademik
                        <?php endif ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownTahunAjaran">
                        <a class="dropdown-item" href="<?= base_url('Kaprodi/') ?>">All school years</a>
                        <?php foreach ($tahun_ajaran as $row): ?>
                        <?php $tahun = str_replace('/', '_', $row['tahun_ajaran']) ?>
                        <?php if ($this->uri->segment(3) == $tahun): ?>
                        <a class="dropdown-item active"
                            href="<?= base_url('Kaprodi/index/').$tahun ?>"><?= $row['tahun_ajaran'] ?></a>
                        <?php else: ?>
                        <a class="dropdown-item"
                            href="<?= base_url('Kaprodi/index/').$tahun ?>"><?= $row['tahun_ajaran'] ?></a>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <?php if ($this->uri->segment(3) != ''): ?>
            <div class="row col-xl-12 mb-4">
                <?php foreach ($angkatan as $a): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input cek_angkatan" type="checkbox" name="angkatan"
                        id="angkatan_<?= $a['angkatan']; ?>" value="<?= $a['angkatan']; ?>"
                        <?= cek_angkatan($a['angkatan'], $arr_angkatan); ?>>
                    <label class="form-check-label" for="angkatan_<?= $a['angkatan']; ?>">Angkatan
                        <?= $a['angkatan']; ?></label>
                </div>
                <?php endforeach ?>
            </div>
            <?php endif ?>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-7 col-md-12">
                    <div class="card shadow mb-4" style="height: 28rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">RATA-RATA IP SEMESTER</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="ipkChart" height="120%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-5 col-md-12">
                    <div class="card shadow mb-4" style="height: 28rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">STATUS MAHASISWA</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="statusChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <?php $a = 0; ?>
                                <?php foreach ($status as $row): ?>
                                <?php $warna = ""; 
                                            $nilai = "1234567890abcdef";
                                                for($i = 0;$i <6;$i++){
                                                    $warna .= $nilai[rand(0,strlen($nilai) - 1)];
                                                }
                                                $color_status[$a] = $warna;
                                                $a++;
                                                 ?>
                                <span class="mr-2">
                                    <i class="fas fa-circle"
                                        style="color: <?= '#'.$warna ?>;"></i><?= $row['status'].' '.number_format(($row['count_status']*100/$count_status['count_status'])).' %'; ?>
                                </span>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Pie Chart -->
                <div class="col-xl-5 col-md-12">
                    <div class="card shadow mb-4" style="height: 30rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">JUMLAH PENERIMA BEASISWA</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="beasiswaChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <?php $a = 0; ?>
                                <?php foreach ($jumlah_beasiswa as $row): ?>
                                <?php $warna = ""; 
                                            $nilai = "1234567890abcdef";
                                                for($i = 0;$i <6;$i++){
                                                    $warna .= $nilai[rand(0,strlen($nilai) - 1)];
                                                }
                                                $color_beasiswa[$a] = $warna;
                                                $a++;
                                                 ?>
                                <span class="mr-2">
                                    <i class="fas fa-circle"
                                        style="color: <?= '#'.$warna ?>;"></i><?= ' '.$row['jumlah_penerima'].' mahasiswa'; ?>
                                </span>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABLE BEASISWA -->
                <div class="col-xl-7 col-md-12">
                    <div class="card shadow mb-4" style="height: 30rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">BEASISWA</h6>
                            <!-- Dropdown Sort By -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    SORT BY
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tableFixHead">
                                <table class="table table-hover tabelFix">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">NAMA LENGKAP</th>
                                            <th scope="col">TIPE</th>
                                            <th scope="col">JENIS</th>
                                            <th scope="col">TAHUN</th>
                                            <th scope="col">NAMA BEASISWA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $x = 1;
                                        foreach ($data_beasiswa as $key) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $x++; ?></th>
                                            <td><?= $key['nama'];?></td>
                                            <td><?= $key['tipe_beasiswa']; ?></td>
                                            <td><?= $key['jenis_beasiswa']; ?></td>
                                            <td><?= $key['tahun']; ?></td>
                                            <td><?= $key['nama_beasiswa'];   ?></td>
                                        </tr>
                                        <?php 
                                        };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <span style="font-size: 14px;">
                                 <br>Total Number of Columns <?= $count_beasiswa; ?>       
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- TABLE PRESTASI -->
                <div class="col-xl-7 col-md-12">
                    <div class="card shadow mb-4" style="height: 30rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">PRESTASI</h6>
                            <!-- Dropdown Sort By -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    SORT BY
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tableFixHead">
                                <table class="table tab-striped table-hover tableFix">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">NAMA LENGKAP</th>
                                            <th scope="col">PERINGKAT</th>
                                            <th scope="col">KATEGORI</th>
                                            <th scope="col">PENYELENGGARA</th>
                                            <th scope="col">NAMA KOMPETISI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $x = 1;
                                        foreach ($data_prestasi as $key) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $x++; ?></th>
                                            <td><?= $key['nama']; ?></td>
                                            <td><?= $key['peringkat']; ?></td>
                                            <td><?= $key['kategori']; ?></td>
                                            <td><?= $key['penyelenggara']; ?></td>
                                            <td><?= $key['nama_kompetisi']; ?></td>
                                        </tr>
                                        <?php };?>
                                    </tbody>
                                </table>
                            </div>
                            <span style="font-size: 14px;"> 
                                <br>Total number of columns <?= $count_prestasi; ?> Mahasiswa
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TABLE KEHADIRAN -->
                <div class="col-xl-5 col-md-12">
                    <div class="card shadow mb-4" style="height: 30rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">KEHADIRAN</h6>
                            <!-- Dropdown Sort By -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    SORT BY
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tableFixHead">
                                <table class="table table-hover tableFix">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">NAMA LENGKAP</th>
                                            <th scope="col">%KEHADIRAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $x = 1;
                                        foreach ($data_kehadiran as $key) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $x++; ?></th>
                                            <td><?= $key['name']; ?></td>
                                            <td><?= $key['avg_presensi']. ' %'; ?></td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <span style="font-size: 14px;">
                               <br> Total number of columns <?= $count_kehadiran; ?> Mahasiswa
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- TABLE TAK -->
                <div class="col-xl-6 col-md-12">
                    <div class="card shadow mb-4" style="height: 28rem;">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">TAK MAHASISWA</h6>
                            <!-- Dropdown Sort By -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    SORT BY
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tableFixHead">
                                <table class="table table-hover tableFix">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">NAMA LENGKAP</th>
                                            <th scope="col">JUMLAH TAK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $x = 1;
                                        foreach ($data_TAK as $key) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $x++; ?></th>
                                            <td><?= $key['name']; ?></td>
                                            <td><?= $key['tak']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <span>
                                <br>Total number of columns <?= $count_TAK; ?> Mahasiswa
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <!-- Page level plugins -->
        <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
        <!-- Plugins jquery -->
        <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
        <!-- Plugins leaflet -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js" integrity="sha512-8cU710tp3iH9RniUh6fq5zJsGnjLzOWLWdZqBMLtqaoZUA6AWIE34lwMB3ipUNiTBP5jEZKY95SfbNnQ8cCKvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin=""></script>

        <script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito',
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

// fungsi mendapatkan kode warna
function getColorCode() {
    var makeColorCode = '0123456789ABCDEF';
    var code = '#';
    for (var count = 0; count < 6; count++) {
      code =code+ makeColorCode[Math.floor(Math.random() * 16)];
    }
    return code;
}

// Area Chart Example

var cur_tahun =  <?= json_encode($cur_tahun_ajaran)?>;

console.log(typeof(cur_tahun));
if (cur_tahun == "") {
    const jml_tahun = <?= json_encode(count($nilai_ipk)) ?>;
    console.log("Ini tahunnya kosong");

    const colorCode = [];
    for (let x = 0; x < jml_tahun ; x++) {
        colorCode[x] = getColorCode();
    };

    const data_ip_tahun = <?= json_encode($nilai_ipk) ?>;
    console.log(data_ip_tahun);
    const dataset = [];

    for (let x = 0; x < jml_tahun; x++) {
        // console.log(typeof(data_ip_tahun[0][0]['semester']));
        
        const data = [];
        for (let y = 0; y < 6; y++) {
            data.push(parseFloat(data_ip_tahun[x][y]['avg_ip']).toFixed(2));
        }
        dataset.push(
            {
                label: data_ip_tahun[x][0]['tahun_ajaran'],
                backgroundColor: '#968ED000',
                borderColor: colorCode[x],
                data: data,
                tension: 0.4,
            }
        )
    };
    console.log(dataset);

    const labels = [
                    'Semester 1',
                    'Semester 2',
                    'Semester 3',
                    'Semester 4',
                    'Semester 5',
                    'Semester 6',
    ];

    const data = {
        labels: labels,
        datasets: dataset
    };

    const config = {
      type: 'line',
      data: data,
      options: {
        scales: {
          yAxes: [{
            ticks: {
              min: 0,
              max: 4
            }
          }],
        }
      }
    };

    var ctx = document.getElementById("ipkChart");
    var myLineChart = new Chart(ctx, config );
    
} else {
    var cur_angkatan = <?= json_encode($arr_angkatan)?>;
    var angkatan = <?= json_encode($angkatan) ?>;
    console.log(angkatan);
    console.log(cur_angkatan.length == 0);
    console.log("ini tahunnya ga kosong");
    if(cur_angkatan.length == 0) {
        console.log("ini angkatan yang kosong");

        const colorCode = [];
        for (let x = 0; x < angkatan.length; x++) {
            colorCode[x] = getColorCode();
        };

        const data_ip_angkatan = <?= json_encode($nilai_ipk) ?>;
        // console.log(data_ip_angkatan[1].length);
        const dataset = [];

        for (let x = 0; x < angkatan.length; x++) {
            // console.log(typeof(data_ip_tahun[0][0]['semester']));
            if(data_ip_angkatan[x].length != 0) {
                const data = [];
                for (let y = 0; y < 6; y++) {
                    data.push(parseFloat(data_ip_angkatan[x][y]['avg_ip']).toFixed(2));
                }
                dataset.push(
                    {
                        label: "Angkatan "+data_ip_angkatan[x][0]['angkatan'],
                        backgroundColor: '#968ED000',
                        borderColor: colorCode[x],
                        data: data,
                        tension: 0.4,
                    }
                )
                
            }
        };
        console.log(dataset);

        const labels = [
                        'Semester 1',
                        'Semester 2',
                        'Semester 3',
                        'Semester 4',
                        'Semester 5',
                        'Semester 6',
        ];

        const data = {
            labels: labels,
            datasets: dataset
        };

        const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
            yAxes: [{
                ticks: {
                min: 0,
                max: 4
                }
            }],
            }
        }
        };

        var ctx = document.getElementById("ipkChart");
        var myLineChart = new Chart(ctx, config );

    } else {
        console.log("ini angkatan yang tidak kosong");

        const labels = [
                    'Semester 1',
                    'Semester 2',
                    'Semester 3',
                    'Semester 4',
                    'Semester 5',
                    'Semester 6',
        ];

        var ctx = document.getElementById("ipkChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Rata-rata IPK",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [<?php
                            foreach ($ip_ipk_mahasiswa_semester as $key) {
                                echo number_format($key['avg_ipk'],2).", ";
                            }
                            ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 4,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + tooltipItem.yLabel;
                        }
                    }
                }
            }
        });
        
    }
};


// AWAL JUMLAH PENERIMA BEASISWA
const jumlah_pekerjaan = <?= json_encode($pekerjaan_wali);?>;
// console.log(jumlah_pekerjaan);
const jumlah_beasiswa = <?= json_encode($jumlah_beasiswa);?>;
console.log(jumlah_beasiswa);


var ctx = document.getElementById("beasiswaChart");
var myPieChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: [<?php 
                        foreach ($jumlah_beasiswa as $row) {
                            echo "'".$row['tahun']."', ";
                        }
                     ?>],
                    datasets: [{
                      data: [<?php 
                        foreach ($jumlah_beasiswa as $row) {
                            echo ($row['jumlah_penerima']).', ';
                        }
                        ?>],
                      backgroundColor: [
                      <?php
                            for($i = 0; $i < count($jumlah_beasiswa);$i++){
                                echo "'#".$color_beasiswa[$i]."', ";
                            }?>],
                      hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                  },
                  options: {
                    maintainAspectRatio: false,
                    tooltips: {
                      enabled: true,
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      bodyFontSize: 14,
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      intersect: false,
                      mode: 'index',
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return 'Jumlah : ' + tooltipItem.yLabel + " Mahasiwa";
                        }
                      }
                    },
                    legend: {
                      display: false
                    },
                    cutoutPercentage: 80,
                    scales: {
                        yAxes: [{
                          ticks: {
                            min: 0
                          }
                        }],
                    }
                  },
                });
// AKHIR JUMLAH PENIRIMA BEASISWA


var ctx = document.getElementById("statusChart");
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php 
                        foreach ($status as $row) {
                            echo "'".$row['status']."', ";
                        }
                     ?>],
        datasets: [{
            data: [<?php 
                        foreach ($status as $row) {
                            echo ($row['count_status']).', ';
                        }
                        ?>],
            backgroundColor: [<?php
                            for($i = 0;$i < count($status);$i++){
                                echo "'#".$color_status[$i]."', ";
                            }?>],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});

        </script>

        <!-- Page level custom scripts -->
        <!-- <script src="<?= base_url('assets/') ?>js/chart/presensi.js"></script>
            <script src="<?= base_url('assets/') ?>js/chart/ipk.js"></script>
            <script src="<?= base_url('assets/') ?>js/chart/tak.js"></script>
            <script src="<?= base_url('assets/') ?>js/chart/pekerjaan.js"></script>
             <script src="<?= base_url('assets/') ?>js/chart/asal.js"></script>
             -->
        <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
        <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>