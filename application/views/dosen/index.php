        <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php 
                        
                        ?>
                <?php //var_dump((int)$kelas[0]['id']);var_dump($nilai_ipk[0][1]);var_dump($nilai_ipk) ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$title;//var_dump($pekerjaan_wali); ?></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row">
                        <!-- Example single danger button -->
                        <div class="btn-group mb-3 ml-3">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if (isset($cur_kelas)): ?>
                                    <?= $cur_kelas['kelas']; ?>
                                <?php else: ?>
                                    Kelas
                                <?php endif ?>
                            </button>
                            <div class="dropdown-menu ml-3">
                                <?php foreach ($kelas as $item): ?>
                                    <a class="dropdown-item" href="<?= base_url("Dosen/index/$item[id]") ?>"><?= $item['kelas'] ?></a>
                                <?php endforeach ?>
                                <?php if (isset($cur_kelas)): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url("Dosen/") ?>">All Class</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card-group">
                              <div class="card border-left-primary">
                                <div class="card-body px-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                                Total<br>Mahasiswa</div>
                                        </div>
                                        <div class="col">
                                            <div class="h2 mb-0 font-weight-bold text-gray-800 text-right"><?= $value_mahasiswa['jml_mhs'] ?></div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="card border-left-success">
                                <div class="card-body px-4">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="h6 font-weight-bold text-success text-uppercase mb-1">
                                                Rata-rata<br>IPK</div>
                                        </div>
                                        <div class="col">
                                            <div class="h2 mb-0 font-weight-bold text-gray-800 text-right"><?= number_format($value_mahasiswa2['avg_ipk'],2); ?></div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row Info Mahasiswa -->
                    <div class="row">
                      <div class="col-xl-6 col-md-12">
                        <div class="card shadow mb-4" style="height: 32rem;">
                          <!-- Card Header - Dropdown -->
                          <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">INFO MAHASISWA</h6>
                            <!-- Dropdown menu -->
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
                            <form action="<?= base_url('Dosen/index') ?>" method="get">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Cari Nama..." aria-label="Cari Keyword" aria-describedby="button-addon2" name="keyword-info">
                                  <div class="input-group-append">
                                    <input type="submit" name="submit-info" class="form-control btn btn-info" aria-label="Submit" aria-describedby="basic-addon1">
                                    <!-- <button class="btn btn-info" type="submit" id="button-addon2" name="submit-info">Cari</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                            </form>
                            
                            <div class="tableFixHead">
                              <table class="table tab-striped table-hover tableFix">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>NO</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>TAK</th>
                                    <th>SKS</th>
                                    <th>IPK</th>
                                    <th>STATUS PA</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                  <?php 
                                  $x = 1;
                                  foreach ($info_mahasiswa as $info) : ?>
                                  <tr>
                                    <td><?= $x++; ?></td>
                                    <td><?= $info['name']; ?></td>
                                    <td><?= $info['tak']; ?></td>
                                    <td><?= $info['sum_sks']; ?></td>
                                    <td><?= $info['ipk']; ?></td>
                                    <td>data invalid</td>
                                  </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                            <span style="font-size: 14px;">
                              Total Number of Columns <?= $count_info; ?> Mahasiswa
                            </span>
                          </div>
                        </div>
                      </div>
                      <!-- Area Chart Rata-Rata IPK Semester -->
                      <div class="col-xl-6 col-md-12">
                            <div class="card shadow mb-4" style="height: 32rem;">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">RATA-RATA IPK PER SEMESTER</h6>
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
                                        <canvas id="ipkChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row Daerah Asal Mahasiswa -->
                    <div class="row">
                      <div class="col-xl-6 col-md-12">
                        <div class="card shadow mb-4" style="height: 32rem;">
                          <!-- Card Header - Dropdown -->
                          <div class="card-header d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">DAERAH ASAL MAHASISWA</h6>
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
                            <div id="map" style="height: 90%; width: 100%"></div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-xl-6 col-md-12">
                        <div class="card shadow mb-4" style="height: 32rem;">
                        <!-- Card Header - Dropdown -->
                          <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary float-left">PRESENSI MAHASISWA</h6>
                            <!-- Dropdown Matkul -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                MATKUL
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
                          <form action="<?= base_url('Dosen/index') ?>" method="get">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Cari Nama..." aria-label="Cari Keyword" aria-describedby="button-addon2" name="keyword-presensi">
                                  <div class="input-group-append">
                                    <input type="submit" name="submit-presensi" class="form-control btn btn-info" aria-label="Submit" aria-describedby="basic-addon1">
                                  </div>
                                </div>
                              </div>
                            </div>
                            </form>
                            <div class="tableFixHead">
                              <table class="table tab-striped table-hover tableFix">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>NO</th>
                                    <th>NAMA LENGKAP</th>
                                    <!-- <th>JUMLAH KEHADIRAN</th> -->
                                    <th>PERSENTASE</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                  <?php
                                  $x = 1;
                                  foreach ($presensi_mahasiswa as $p) : ?>
                                  <tr>
                                    <td><?= $x++; ?></td>
                                    <td><?= $p['name']; ?></td>
                                    <td><?= $p['avg_presensi']." %";?></td>
                                  </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                            <span style="font-size: 14px;">
                              Total Number of Columns <?= $count_presensi; ?> Mahasiswa
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Pie Chart -->
                        <div class="col-xl-12 col-lg-12">
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
                                        <?php endforeach ?>
                                    </div>
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
            <script src="<?=base_url();?>assets/leafletajax/leaflet.ajax.js"></script>

            <script text="text/javascript">
              // fungsi mendapatkan kode warna
              function getColorCode() {
                  var makeColorCode = '0123456789ABCDEF';
                  var code = '#';
                  for (var count = 0; count < 6; count++) {
                    code =code+ makeColorCode[Math.floor(Math.random() * 16)];
                  }
                  return code;
              }

              // CHOROPLETH MAP
              // var map =   L.map("map").setView([-3.824181, 117.8191513],4); // MAP INDO
              var map =   L.map("map").setView([-3.824181, 117.8191513],4); // MAP CONTOH
              // API Open Street Map
              var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
              }).addTo(map);
              //// API Mapbox
              // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmVyZGlhbnJpY28iLCJhIjoiY2wwYWdxNW1wMGFyZzNqcXNuOGIyeXJkYiJ9.xm2zSFH4a2b7ECe8l9gI1A', {
              //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
              //     maxZoom: 18,
              //     id: 'mapbox/streets-v11',
              //     tileSize: 512,
              //     zoomOffset: -1
              // }).addTo(map);
              var dataAsal = <?php echo json_encode($asal_mhs);?>;
              var api = 'https://gist.githubusercontent.com/muhammadyana/ac3bed71e8a4d1d4aa5459cc9e4be323/raw/18ccf61ca9d6d7a4a84378de6119fa81f4077848/indonesia-map-geojson.json';
              var dataDaerah = [];
              var geojson = [];
              // getData();
              // console.log(api);
              const asal_mahasiswa = <?= json_encode($asal_mhs)?>;
              // console.log(asal_mahasiswa);

              const style_map = [];
              for (let x = 0; x < asal_mahasiswa.length; x++) {
                style_map.push(
                  {
                    "color": getColorCode(),
                    "weight": 1.5,
                    "opacity": 0.9
                  }
                )
              };
              // console.log(style_map);
              function popUp(f,l){
                var out = [];
                if (f.properties){
                    for (let x = 0; x < asal_mahasiswa.length; x++) {
                      if (f.properties['KODE'] == asal_mahasiswa[x]['kode']) {
                        jumlah = asal_mahasiswa[x]['kode'];
                        var popUp='<table>'+
                                    '<tr>'+
                                      '<td colspan="4"><h6>'+f.properties['NAME_1']+'</h6></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                      '<td>Kode</td>'+
                                      '<td> : '+f.properties['KODE']+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                      '<td>Mahasiswa</td>'+
                                      '<td> : '+asal_mahasiswa[x]['jml_prov']+' Orang</td>'+
                                    '</tr>'+
                                    '</table>'
                        ;
                        l.bindPopup(popUp);
                        break;
                      }
                    }
                } 
              };
              for (let x = 0; x < asal_mahasiswa.length; x++) {
                var jsonTest = new L.GeoJSON.AJAX([<?= json_encode(base_url())?>+'assets/geojson/'+asal_mahasiswa[x]['kode']+'.geojson'],{onEachFeature:popUp, style:style_map[x]}).addTo(map);
              };
              
              // AKHIR CHOROPLETH MAP
              
                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
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

          
          // AWAL Chart IPK
          <?php
                if (isset($cur_kelas)) {?>
                const labels = [
                    'Semester 1',
                    'Semester 2',
                    'Semester 3',
                    'Semester 4',
                    'Semester 5',
                    'Semester 6',
                  ];
                  // console.log("undefined");
                    console.log(<?= json_encode($ip_ipk_mahasiswa_semester)?>);
                    var ctx = document.getElementById("ipkChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                      labels: labels,
                      datasets: [{
                        label: <?php echo json_encode($cur_kelas['kelas']);?>,
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
                            echo number_format($key['avg_ipk'],2) .", ";
                        }
                        ?>],
                      }],
                    },
                    options: {
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
                        display: true
                      },
                      tooltips: {
                        enabled: true,
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
                            return datasetLabel + ' = ' + tooltipItem.yLabel;
                          }
                        }
                      }
                    }
                  });
          <?php
                }else{?>
                  const jml_kelas = <?= json_encode($jml_kelas);?>;
                  // Menyiapkan array untuk warna line
                  const colorCode = [];
                  for(let x=0; x < jml_kelas; x++){
                    colorCode[x] = getColorCode();
                  }
                  // menginisialisasi nilai ipk ke const dataku
                  const dataku = <?= json_encode($nilai_ipk)?>;
                  console.log(dataku);
                  // meyiapkan array dataset
                  const dataset = [];
                  // membuat custom dataset dan dimasukkan kedalam array dataset
                  for (let x = 0; x < jml_kelas; x++) {
                    if (dataku[x].length != 0){
                      const data = [];
                      for (let y = 0; y < 6; y++) {
                        data.push(parseFloat(dataku[x][y]['ipk']).toFixed(2));
                      }
                      dataset.push(
                        {
                          label: dataku[x][0]['kelas'],
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
                  // console.log(dataset);
                  const data = {
                    labels: labels,
                    datasets: dataset
                  };

                  const config = {
                    type: 'line',
                    data: data,
                    options: {
                      scales: {
                        tooltips: {
                        enabled: true,
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
                            return datasetLabel + ' = ' + tooltipItem.yLabel;
                          }
                        }
                      },
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

          <?php }?>
          // AKHIR CHART IPK
          
          // AWAL PEKERJAAN
                  console.log(<?= json_encode($pekerjaan_wali) ?>);
                var ctx = document.getElementById("pekerjaanChart");
                var myPieChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: [<?php 
                        foreach ($pekerjaan_wali as $row) {
                            echo "'".$row['jenis_pekerjaan']."', ";
                        }
                     ?>],
                    datasets: [{
                      data: [<?php 
                        foreach ($pekerjaan_wali as $row) {
                            echo ($row['count_pekerjaan']).', ';
                        }
                        ?>],
                      backgroundColor: [
                      <?php
                            for($i = 0; $i < count($pekerjaan_wali);$i++){
                                echo "'#".$color_pekerjaan[$i]."', ";
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
                          return 'Jumlah : ' + tooltipItem.yLabel + " Orang";
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
            // AKHIR PEKERJAAN 

                

            </script>
            