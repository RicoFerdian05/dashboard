	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
		<?php 
		$dashboard = $this->db->get('dashboard')->row_array(1);
		?>
		<div class="card text-left">
			<div class="card-header">
				<?= $dashboard['header'] ?>
			</div>
			<div class="card-body">
				<h5 class="card-title"><?= $dashboard['title'] ?></h5>
				<p class="card-text"><?= $dashboard['content'] ?></p>
                <a href="<?= base_url('DataMaster/dashboard'); ?>" class="btn btn-primary">Edit</a>
			</div>
			<div class="card-footer text-muted">
				-<?= $dashboard['footer'] ?>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->