<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sig | Nurjanna</title>
	<link rel="icon" href="<?php echo base_url('asset/img/') ?>icon_pom.png" type="image/png">
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

		<div class="card mx-auto mb-4 border-primary shadow " style="width: 70%; ">
			<h3 class="card-title text-center my-4">Peta Wilayah dan Tempat Indomaret Pada Kecamatan Pelaihari</h3>
			<div id="map" style="height: 600px;"></div>
		</div>
	</div>
	

	<script src="<?= base_url('asset/js/leaflet.js') ?>"></script>
	<script>
		var map = L.map('map').setView([-3.796945339742461, 114.77564234404004], 11); // Koordinat Pelaihari, Kalimantan Selatan

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);


		// Fetch poligon data from PHP
		var poligonData = <?php echo json_encode($poligon); ?>;
		console.log(poligonData);

		// Convert poligon data to GeoJSON format
		var geojsonFeature = {
			"type": "FeatureCollection",
			"features": [{
				"type": "Feature",
				"properties": {},
				"geometry": {
					"type": "Polygon",
					"coordinates": [
						poligonData.map(function(poli) {
							return [poli.longitude, poli.latitude];
						})
					]
				}
			}]
		};

		// Adding GeoJSON layer
		L.geoJSON(geojsonFeature, {
			style: function(feature) {
				return {
					color: 'blue'
				};
			},
			onEachFeature: function(feature, layer) {
				layer.bindPopup('Kecamatan Pelaihari');
			}
		}).addTo(map);

		// Fetch lokasi data from PHP
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