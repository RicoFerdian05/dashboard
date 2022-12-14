<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Top D3SI</h1>
	<div class="row">
		<div class="col-lg-6">
			<?= $this->session->flashdata('message'); ?>
			
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			Top Gainer & Top Looser
		</div>
		<div class="card-body">
			<div class="col-md-5">
				<!-- <div class="form-group">
					<label for="angkatan">Pilih angkatan</label>
					<select id="angkatan" class="form-control">
						<option disabled selected value="">Pilih Angkatan</option>
						<?php foreach ($angkatan as $item): ?>
							<option value="<?= $item['angkatan'] ?>"><?= $item['angkatan'] ?></option>
						<?php endforeach ?>
					</select>
				</div> -->
				<!-- Default dropright button -->
				<div class="btn-group dropright">
					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pilih Angkatan
					</button>
					<div class="dropdown-menu">
						<?php foreach ($angkatan as $item): ?>
							<a class="dropdown-item" href="<?= base_url('Kaprodi/top/'.$item['angkatan']) ?>">Angkatan <?= $item['angkatan'] ?></a>
						<?php endforeach ?>
					</div>
				</div>
				<!-- Default dropright button -->
				<?php if ($this->uri->segment(3) != ''): ?>
					<div class="btn-group dropright">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sort By
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url('Kaprodi/top/'.$this->uri->segment(3).'/ip') ?>">IP Semester</a>
							<a class="dropdown-item" href="<?= base_url('Kaprodi/top/'.$this->uri->segment(3).'/prestasi') ?>">Jumlah Prestasi</a>
						</div>
					</div>
				<?php endif ?>
			</div>
			<div class="col-md-7"></div>
			<div id="">
				<?php if ($total_semester): ?>
					<div class="form-group">
						<?php $x = 1; ?>
						<?php $smt = ''; ?>
						<?php if ($total_semester > 6){
							$total_semester = 6;
						} ?>
						<?php while ($x <= $total_semester) { ?>
							<?php switch ($x) {
								case 1: $smt = "Semester I";  break;
								case 2: $smt = "Semester II";  break;
								case 3: $smt = "Semester III";  break;
								case 4: $smt = "Semester IV";  break;
								case 5: $smt = "Semester V";  break;
								case 6: $smt = "Semester VI";  break;
								default: $smt = "All Semester"; break;
							} ?>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="semester" id="semester<?= $x ?>" value="<?= "$cur_angkatan/$x" ?>">
								<label class="form-check-label" for="semester<?= $x ?>"><?= $smt ?></label>
							</div>
						<?php $x++; } ?>
					</div>
					<div id="ctn">
						<div class="row mb-3 hide_aja" id="IPTinggi">
							<h5>5 Mahasiswa dengan <?php if($this->uri->segment(4) == 'prestasi'){echo "Jumlah Prestasi Terbanyak";}
							     					     else {echo "IP Tertinggi";} ?></h5>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">NIM</th>
										<th scope="col">Nama Mahasiswa</th>
										<th scope="col">IP Terbaru</th>
										<th scope="col">IP Semester Sebelumnya</th>
										<th scope="col">Selisih</th>
										<th scope="col">Jumlah Prestasi</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
						<div class="row hide_aja" id="IPRendah">
							<h5>5 Mahasiswa dengan <?php if($this->uri->segment(4) == 'prestasi'){echo "Jumlah Prestasi Tersedikit";}
							                             else {echo "IP Terendah";} ?></h5>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">NIM</th>
										<th scope="col">Nama Mahasiswa</th>
										<th scope="col">IP Terbaru</th>
										<th scope="col">IP Semester Sebelumnya</th>
										<th scope="col">Selisih</th>
										<th scope="col">Jumlah Prestasi</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script type="text/javascript">
	// ambil elements yg di buutuhkan
	<?php $x= 1; 
	while ($x <= $total_semester){ ?>
		var keyword<?= $x ?> = document.getElementById('semester<?= $x ?>');
	<?php $x++; } ?>
	var container = document.getElementById('ctn');
	// var btn = document.getElementById('button-addon2');

	// tambahkan event ketika keyword ditulis
	<?php $n= 1;
	while ($n <= $total_semester){ ?>
		keyword<?= $n ?>.addEventListener('change', function () {


		    //buat objek ajax
		    var xhr = new XMLHttpRequest();

		    // cek kesiapan ajax
		    xhr.onreadystatechange = function () {
		        if (xhr.readyState == 4 && xhr.status == 200) {
		            container.innerHTML = xhr.responseText;
		        }
		    }

		    xhr.open('GET', '<?= base_url('Kaprodi/topSemester/') ?>' + keyword<?= $n ?>.value + '/<?= $this->uri->segment(4) ?>/<?= $this->uri->segment(5) ?>' , true);
		    xhr.send();


		})
	<?php $n++; } ?>
</script>