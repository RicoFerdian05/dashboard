294
<!-- Content Row -->

<div class="row">

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pekerjaan Orang Tua</h6>
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
                <canvas id="pekerjaanChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <?php $a = 0; ?>
                <?php foreach ($pekerjaan_wali as $row): ?>
                    <?php $warna = ""; 
                    $nilai = "1234567890abcdef";
                        for($i = 0;$i <6;$i++){
                            $warna .= $nilai[rand(0,strlen($nilai) - 1)];
                        }
                        $color_pekerjaan[$a] = $warna;
                        $a++;
                         ?>
                    <span class="mr-2">
                        <i class="fas fa-circle" style="color: <?= '#'.$warna ?>;"></i><?= $row['pekerjaan_wali'].' '.number_format(($row['count_pekerjaan']*100/$count_pekerjaan['count_pekerjaan'])).' %'; ?>
                    </span>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->
<div class="row">

<!-- Content Column -->
<div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pendidikan Terakhir Orang Tua</h6>
        </div>
        <div class="card-body">
            <?php 
            foreach ($pendidikan_wali as $row) { ?>
                <?php
                $persentase_pendidikan =  number_format($row['count_pendidikan']*100/$count_pendidikan['count_pendidikan'])?>
                <h4 class="small font-weight-bold"><?= $row['pendidikan'] ?><span class="float-right"><?= $persentase_pendidikan ?>%</span></h4>
                <div class="progress mb-4">
                    <?php switch ($row['pid']) {
                        case 1: $color = "danger"; break;
                        case 2: $color = "warning"; break;
                        case 3: $color = "dark"; break;
                        case 4: $color = "success"; break;
                        case 5: $color = "info"; break;
                        case 6: $color = "secondary"; break;
                        case 7: $color = "primary"; break;
                        case 8: $color = "danger"; break;
                        case 9: $color = "dark"; break;
                        default: $color = "secondary"; break;
                    } ?>
                    <div class="progress-bar bg-<?=$color ?>  " role="progressbar" style="width: <?= $persentase_pendidikan ?>%"
                        aria-valuenow="<?= $persentase_pendidikan ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <?php
            }
             ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Rata-rata Kehadiran Per Semester</h6>
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
                <canvas id="presensiChart"></canvas>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daerah Asal Mahasiswa</h6>
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
                <canvas id="asalChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <?php $a = 0; ?>
                <?php foreach ($asal_daerah as $row): ?>
                    <?php $warna = ""; 
                    $nilai = "1234567890abcdef";
                        for($i = 0;$i <6;$i++){
                            $warna .= $nilai[rand(0,strlen($nilai) - 1)];
                        }
                        $color_asal[$a] = $warna;
                        $a++;
                         ?>
                    <span class="mr-2">
                        <i class="fas fa-circle" style="color: <?= '#'.$warna ?>;"></i><?= $row['asal_daerah'].' '.number_format(($row['count_asal']*100/$count_asal['count_asal'])).' %'; ?>
                    </span>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Rata-rata TAK Per Semester</h6>
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
                <canvas id="takChart"></canvas>
            </div>
        </div>
    </div>

    // Bar Chart Example
                var ctx = document.getElementById("presensiChart");
                var myBarChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: ["Semester I", "Semester II", "Semester III", "Semester IV", "Semester V", "Semester VI"],
                    datasets: [{
                      label: "Rata-rata Kehadiran",
                      backgroundColor: "#4e73df",
                      hoverBackgroundColor: "#2e59d9",
                      borderColor: "#4e73df",
                      data: [<?php
                      foreach ($value_mahasiswa_semester as $key) {
                          echo ($key['avg_presensi']*100).", ";
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
                          unit: 'month'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                      }],
                      yAxes: [{
                        ticks: {
                          max: 100,
                          beginAtZero:true,
                          // Include a dollar sign in the ticks
                          callback: function(value, index, values) {
                            return number_format(value) + '%';
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
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' %';
                        }
                      }
                    },
                  }
                });

                // Pie Chart Example
                var ctx = document.getElementById("asalChart");
                var myPieChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                    labels: [<?php 
                        foreach ($asal_daerah as $row) {
                            echo "'".$row['asal_daerah']."', ";
                        }
                     ?>],
                    datasets: [{
                      data: [<?php 
                        foreach ($asal_daerah as $row) {
                            echo ($row['count_asal']).', ';
                        }
                        ?>],
                      backgroundColor: [<?php
                            for($i = 0;$i < count($asal_daerah);$i++){
                                echo "'#".$color_asal[$i]."', ";
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

                // Bar Chart Example
                var ctx = document.getElementById("takChart");
                var myBarChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: [
                    <?php $n = 1; ?>
                    <?php $smt = ""; ?>
                    <?php foreach ($hitung_tak as $vms){
                        switch ($vms['semester_kelas']) {
                            case 1: $smt = "Semester I"; break;
                            case 2: $smt = "Semester II"; break;
                            case 3: $smt = "Semester III"; break;
                            case 4: $smt = "Semester IV"; break;
                            case 5: $smt = "Semester V"; break;
                            case 6: $smt = "Semester VI"; break;
                            default: $smt = ''; break;
                        }
                        echo "'".$smt." ".$vms['jml_mhs']." Mahasiswa', ";
                        $n++;
                    } ?>
                    ],
                    datasets: [{
                      label: "Rata-rata TAK",
                      backgroundColor: "#12c3c9",
                      hoverBackgroundColor: "#2e59d9",
                      borderColor: "#12c3c9",
                      data: [<?php
                      foreach ($hitung_tak as $key) {
                          echo $key['avg_tak'].", ";
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
                          unit: 'month'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                      }],
                      yAxes: [{
                        ticks: {
                          beginAtZero:true,
                          // Include a dollar sign in the ticks
                          callback: function(value, index, values) {
                            return number_format(value);
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
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                        }
                      }
                    },
                  }
                });