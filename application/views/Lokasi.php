<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sig | Nurjanna</title>
	<link rel="icon" href="<?php echo base_url('asset/img/') ?>minimart.png" type="image/png">
	<link rel="stylesheet" href="<?php echo base_url() ?>asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>asset/css/leaflet.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>asset/css/qgis.css" />

</head>

<body>

	<!-- HEADER -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">INDOMARET | 4B NURJANNA</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= site_url('Sig') ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= site_url('Lokasi') ?>">Data Lokasi Indomaret</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= site_url('Poligon') ?>">Data Poligon</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content -->
	<div class="container-fluid my-4 ">

		<div class="card  mx-auto mb-4 border-primary shadow " style="width: 70%; ">
			<h3 class="card-title text-center my-4">LOKASI INDOMARET KECAMATAN PELAIHARI</h3>
			<div id="map" style="height: 550px;"></div>
		</div>
		<div class=" border-primary card mx-auto shadow" style="width: 90%;">
			<div class="card-body table-responsive">
				<div class="card-header border-primary  mb-3 ">
					<h2 class=" text-center my-4">Data Tempat Indomaret</h2>
				</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Lokasi</button>
				</div>
				<table class="table table-striped border-primary text-center">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Tempat</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($lokasi as $lok) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $lok->nama ?></td>
								<td><?= $lok->latitude ?></td>
								<td><?= $lok->longitude ?></td>
								<td>
									<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $lok->id ?>">
										Edit
									</button>
									<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $lok->id ?>">
										Hapus
									</button>
								</td>
							</tr>
							<!-- Modal Konfirmasi Hapus -->
							<div class="modal fade" id="deleteModal<?= $lok->id ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content  border-primary">
										<div class="modal-header">
											<h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											Apakah Anda yakin ingin menghapus data ini?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
											<a href="<?= site_url('Lokasi/delete/' . $lok->id) ?>" class="btn btn-danger">Hapus</a>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal Edit -->
							<div class="modal fade" id="editModal<?= $lok->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $lok->id ?>" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content  border-primary">
										<div class="modal-header border-primary">
											<h5 class="modal-title" id="editModalLabel<?= $lok->id ?>">Edit Lokasi</h5>
											<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
											<form method="post" action="<?= site_url('Lokasi/update/' . $lok->id) ?>">
												<div class="mb-3">
													<label for="nama<?= $lok->id ?>" class="form-label">Nama</label>
													<input type="text" class="form-control  border-primary" id="nama<?= $lok->id ?>" name="nama" value="<?= $lok->nama ?>" required>
												</div>
												<div class="mb-3">
													<label for="latitude<?= $lok->id ?>" class="form-label">Latitude</label>
													<input type="text" class="form-control  border-primary" id="latitude<?= $lok->id ?>" name="latitude" value="<?= $lok->latitude ?>" required>
												</div>
												<div class="mb-3">
													<label for="longitude<?= $lok->id ?>" class="form-label">Longitude</label>
													<input type="text" class="form-control  border-primary" id="longitude<?= $lok->id ?>" name="longitude" value="<?= $lok->longitude ?>" required>
												</div>
												<div class="d-grid d-md-flex justify-content-md-end">
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div> <!-- End of Modal Edit -->
						<?php endforeach; ?>
					</tbody>
				</table>

				<!-- Add Modal -->
				<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content  border-primary">
							<div class="modal-header border-primary">
								<h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi</h5>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
								<form method="post" action="<?= site_url('Lokasi/create') ?>">
									<div class="mb-3  border-primary">
										<label for="nama" class="form-label">Nama</label>
										<input type="text" class="form-control  border-primary" id="nama" name="nama" required>
									</div>
									<div class="mb-3">
										<label for="latitude" class="form-label">Latitude</label>
										<input type="text" class="form-control  border-primary" id="latitude" name="latitude" required>
									</div>
									<div class="mb-3">
										<label for="longitude" class="form-label">Longitude</label>
										<input type="text" class="form-control  border-primary" id="longitude" name="longitude" required>
									</div>
									<div class="d-grid d-md-flex justify-content-md-end">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> <!-- End of Add Modal -->
			</div>
		</div>
	</div>
	
	<script src="<?= base_url('asset/js/leaflet.js') ?>"></script>
	<script>
		var map = L.map('map').setView([-3.796945339742461, 114.77564234404004], 12,5); // Koordinat Pelaihari, Kalimantan Selatan

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		var lokasiData = <?php echo json_encode($lokasi); ?>;
		console.log(lokasiData);

		var customIcon = L.icon({
			iconUrl: '<?= base_url("asset/img/minimart.png") ?>',
			iconSize: [25, 35],
		});

		lokasiData.forEach(function(lokasi) {
			L.marker([lokasi.latitude, lokasi.longitude], {
				icon: customIcon
			}).addTo(map).bindPopup('<b>' + lokasi.nama + '</b><br>Latitude: ' + lokasi.latitude + '<br>Longitude: ' + lokasi.longitude);
		});
	</script>
	<script src="<?= base_url('asset/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('asset/js/jquery.min.js') ?>"></script>
</body>

</html>