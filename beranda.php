<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SiPro</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
		<link rel="stylesheet" href="plugin/leaflet-search-master/leaflet-search-master/dist/leaflet-search.min.css">
        <link rel="stylesheet" href="plugin/Leaflet.defaultextent-master/Leaflet.defaultextent-master/dist/leaflet.defaultextent.css">
        <style>
			html, body {
				width: 100%;
				height: 100%;
                margin: 0;
			}
            #map {
                width: 70%;
                height: calc(100vh - 56px);
                margin: 0 auto; 
            }
            .header-image {
                width: 100%;
                height: 400px;
                object-fit: cover;
            }

            .header-text {
                position: absolute;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 50px;
                color: white;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Adds shadow for better visibility */
                font-weight: bold;
            }
            h2 {
                text-align: center;  /* Mengatur teks agar berada di tengah */
                margin: 0 auto;      /* Mengatur margin agar elemen berada di tengah */
            }
            .table-striped tbody tr:nth-of-type(odd) {
            background-color: #ffe5b4;
            }
            .table-striped tbody tr:nth-of-type(even) {
                background-color: #ffdd99;
            }
            .table-striped thead {
                background-color: #ff9f1a;
                color: white;
            }
            .table-striped td, .table-striped th {
                border: 1px solid #ffa500;
            }
            
		</style>
	</head>
	<body>
    <nav class="navbar navbar-warning bg-opacity-50 fixed-top shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistem Informasi Pos Recycling Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="offcanvas offcanvas-end text-bg-white bg-opacity-50" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">SiPRO</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
            </form>
            <li class="nav-item">                                                                                                                                                                                                                                                             
                <a class="nav-link active" aria-current="page" href="beranda.php">Beranda</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Layanan 
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="input.php">Order</a></li>
                <li><a class="dropdown-item" href="index2.php">Riwayat</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="tentang.html">Tentang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://jakartasatu.jakarta.go.id/" target="_blank">Sumber Data</a>
            </li>
            </li>
            </ul>
        </div>
        </div>
    </div>
    </nav>

        <!-- Header Image with Text -->
        <div class="header-container">
            <img src="img/jkt3.jpeg" alt="Header Image" class="header-image">
            <div class="header-text">KOTA JAKARTA BARAT</div>
        </div>

        <br>
        <br>
        
        <h2>Peta Lokasi Kantor Pos Kota Jakarta Barat</h2>

        <br>

        <!-- Map -->
		<div id="map"></div>


        <div style="margin-top: 80px;"></div>

        <!-- Card -->
        <h2>Informasi Kantor Pos</h2>

        <br>
        <br>
        <br>

        <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col" style="max-width: 300px; margin: 0 auto;">
            <div class="card" style="background-color: rgba(255, 165, 0, 0.8); border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
            <img src="img/pos3.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kantor Pos Cengkareng</h5>
                <p class="card-text"> Jl. Bangun Nusa Raya No.14 2, RT.9/RW.2, Cengkareng Tim., Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11730, Indonesia <br> <strong>Opens</strong> Sunday - Saturday</p>
                <a href="https://shorturl.at/IuMbO" class="btn btn-dark" target="_blank">Selengkapnya--</a>
            </div>
            </div>
        </div>
        <div class="col" style="max-width: 300px; margin: 0 auto;">
            <div class="card" style="background-color: rgba(255, 165, 0, 0.8); border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
            <img src="img/pos2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kantor Pos Kemanggisan</h5>
                <p class="card-text">Jl. Anggrek Rosliana No.27 4, RT.5/RW.5, Kemanggisan, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11480 <br><strong>Opens</strong> Monday - Saturday</p>
                <a href="https://g.co/kgs/LD2rq25" class="btn btn-dark" target="_blank">Selengkapnya--</a>
            </div>
            </div>
        </div>
        <div class="col" style="max-width: 300px; margin: 0 auto;">
            <div class="card" style="background-color: rgba(255, 165, 0, 0.8); border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
            <img src="img/pos7.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kantor Pos Grogol</h5>
                <p class="card-text"> JL. Dr. Susilo Raya, No. 1, RT.1/RW.3, Grogol, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11450 <br><strong>Opens</strong> Sunday - Saturday</p>
                <a href="https://g.co/kgs/SMa9fMG" class="btn btn-dark" target="_blank">Selengkapnya--</a>
            </div>
            </div>
        </div>
        <div class="col" style="max-width: 300px; margin: 0 auto;">
            <div class="card" style="background-color: rgba(255, 165, 0, 0.8); border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
            <img src="img/pos6.JPG" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kantor Pos Jakarta Barat Tegal Alur</h5>
                <p class="card-text">Jl. Kamal Raya No.32, RT.3/RW.6, Cengkareng Bar., Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11730 <br><strong>Opens</strong> Sunday - Saturday</p>
                <a href="https://g.co/kgs/Jh2vYnC" class="btn btn-dark" target="_blank">Selengkapnya--</a>
            </div>
            </div>
        </div>
        </div>

        <br>


        <!-- Modal Feature -->
        <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="featureModalTitle">feature Pembuat</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="featureModalBody">
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
		<script src="plugin/leaflet-search-master/leaflet-search-master/dist/leaflet-search.min.js"></script>
        <script src="plugin/Leaflet.defaultextent-master/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>


        <!-- MAP -->
        <script>
			// Inisialisasi peta
			var map = L.map("map").setView([-6.1615363,106.7570455], 12);

			// Tile Layer Base Map
			var basemap = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
			});

			// Menambahkan basemap ke dalam peta
			basemap.addTo(map);

            // GeoJSON Titik Layanan
            var kantor_pos = L.icon({
                            iconUrl: "img/titik.png", // icon marker
                            iconSize: [45, 45], // ukuran icon
                            iconAnchor: [24, 48], // posisi icon terhadap titik (point)
                            popupAnchor: [0, -48], // posisi popup terhadap icon
                            tooltipAnchor: [-16, -30], // posisi tooltip terhadap icon
                        });

                        <?php
                        $conn = new mysqli("localhost", "root", "", "responsi");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM kantorpos";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "L.marker([{$row['latitude']}, {$row['longitude']}], {icon: kantor_pos}).addTo(map)
                                        .bindPopup('<strong>{$row['nama']}</strong><br>Telepon: {$row['telepon']}<br>Jenis barang: {$row['jenis_barang']}<br>Metode Layanan: {$row['metode_layanan']}');\n";
                            }
                        } else {
                            echo "console.log('No data available');\n";
                        }
                        $conn->close();
                        ?>

            // GeoJSON Titik Kantor Pos
            var kantor_pos = L.geoJSON(null, {
                // Style
                pointToLayer: function (feature, latlng) {
                    return L.marker(latlng, {
                        icon: L.icon({
                            iconUrl: "img/post.png", // icon marker
                            iconSize: [30, 30], // ukuran icon
                            iconAnchor: [24, 48], // posisi icon terhadap titik (point)
                            popupAnchor: [0, -48], // posisi popup terhadap icon
                            tooltipAnchor: [-16, -30], // posisi tooltip terhadap icon
                        }),
                    });},

                // onEachFeature
                onEachFeature: function (feature, layer) {
                        // variable popup content
                        var popup_content = "Nama: " + feature.properties.REMARK + "<br>" +
                            "Koordinat: " + feature.geometry.coordinates[1] + ", " + feature.geometry.coordinates[0];

                        layer.on({
                            click: function (e) {
                                //kantor pos.bindPopup(popup_content);

                                //menampilkan feature modal
                                $("#featureModalTitle").html("Informasi Kantor Pos");
                                $("#featureModalBody").html(popup_content);
                                $("#featureModal").modal("show");
                            },
                            mouseover: function (e) {
                                kantor_pos.bindTooltip(feature.properties.REMARK, {
                                    direction: "right",
                                    sticky: true,
                                });
                            },
                        });
                    },
                });

            $.getJSON("data/KantorPos.geojson", function (data) {
                kantor_pos.addData(data); // Menambahkan data ke dalam GeoJSON Point Kator Pos
                map.addLayer(kantor_pos); // Menambahkan GeoJSON Point Kantor Pos ke dalam peta
            });


            // GeoJSON Polyline Jalan
            map.createPane('panejalan');
            map.getPane("panejalan").style.zIndex = 401;

            var jalan = L.geoJSON(null, {
                pane: 'panejalan',
                // Style
                style: function (feature) {
                    return {
                        color: "red",
                        opacity: 1,
                        weight: 3,
                    };
                },
                // onEachFeature
                onEachFeature: function (feature, layer) {
                        // variable popup content
                        var popup_content = "Fungsi: " + feature.properties.REMARK;

                        layer.on({
                            click: function (e) {
                                //jalan.bindPopup(popup_content);

                                //menampilkan feature modal
                                $("#featureModalTitle").html("Informasi Jalan");
                                $("#featureModalBody").html(popup_content);
                                $("#featureModal").modal("show");
                            },
                            mouseover: function (e) {
                                jalan.bindTooltip(feature.properties.REMARK, {
                                    direction: "auto",
                                    sticky: true,
                                });
                            },
                        });
                    },

            });

            $.getJSON("data/jalan.geojson", function (data) {
                jalan.addData(data); // Menambahkan data ke dalam GeoJSON Polyline Jalan
                map.addLayer(jalan); // Menambahkan GeoJSON Polyline Jalan ke dalam peta
            });


            // GeoJSON Polygon Administrasi
            map.createPane('paneadmin');
            map.getPane("paneadmin").style.zIndex = 301;

            var administrasi_desa = L.geoJSON(null, {
                pane: 'paneadmin',

                // onEachFeature
                onEachFeature: function (feature, layer) {
                        // variable popup content
                        var popup_content = "Kecamatan: " + feature.properties.WADMKC + "<br>" +
                        "Kelurahan: " + feature.properties.WADMKK + "<br>" +
                        "Provinsi: " + feature.properties.WADMPR;

                        layer.on({
                            click: function (e) {
                                //administrasi_desa.bindPopup(popup_content);

                                //menampilkan feature modal
                                $("#featureModalTitle").html("Informasi Wilayah");
                                $("#featureModalBody").html(popup_content);
                                $("#featureModal").modal("show");
                            },
                            mouseover: function (e) {
                                administrasi_desa.bindTooltip(feature.properties.WADMKC, {
                                    direction: "auto",
                                    sticky: true,
                                });
                            },
                        });
                    },

            });

            $.getJSON("data/AdministrasiDesa.geojson", function (data) {
                administrasi_desa.addData(data); // Menambahkan data ke dalam GeoJSON Polygon Jumlah Penduduk
                map.addLayer(administrasi_desa); // Menambahkan GeoJSON Polygon Jumlah Penduduk ke dalam peta
            });


            // Control Layer
            var baseMaps = {
                "Basemap": basemap,
            };

            var overlayMaps = {
                "Kantor Pos": kantor_pos,
                "Jalan": jalan,
                "Administrasi": administrasi_desa,
            };

            var controllayer = L.control.layers(baseMaps, overlayMaps);
            controllayer.addTo(map);

            // Tambahkan skala ke peta
            L.control.scale({
                metric: true,   // Skala dalam meter/kilometer
                imperial: false // Nonaktifkan skala imperial (mil/feet)
            }).addTo(map);

            // Legend Control
            var legend = L.control({ position: "bottomright" });

            legend.onAdd = function (map) {
                var div = L.DomUtil.create("div", "info legend");
                div.style.background = "white";
                div.style.padding = "10px";
                div.style.border = "1px solid #ccc";
                div.style.borderRadius = "5px";

                div.innerHTML =
                    "<h5>Legenda</h5>" +
                    "<div><i style='background: url(img/post.png); display: inline-block; width: 20px; height: 20px; background-size: contain;'></i> Kantor Pos</div>" +
                    "<div><i style='background: url(img/titik.png); display: inline-block; width: 20px; height: 20px; background-size: contain;'></i> Titik Lokasi Cust</div>" +
                    "<div><i style='background: red; width: 20px; height: 3px; display: inline-block;'></i> Jalan</div>" +
                    "<div><i style='background: rgba(0, 0, 255, 0.3); width: 20px; height: 20px; display: inline-block;'></i> Administrasi</div>";

                return div;
            };

            legend.addTo(map);

            //default extent
            L.control.defaultExtent()
                .addTo(map);

            // Menambahkan kontrol pencarian
            var searchControl = new L.Control.Search({
                layer: kantor_pos, // Menargetkan layer 
                propertyName: 'REMARK', // Mencari berdasarkan properti 
                marker: false, // Tidak menampilkan marker saat pencarian
                moveToLocation: function(latlng, title, map) {
                    map.setView(latlng, 15); // Memusatkan peta pada titik yang dicari dengan zoom level 15
                }
            });

            // Event listener untuk ketika pencarian ditemukan
            searchControl.on('search:locationfound', function(e) {
                // Ketika lokasi ditemukan, mengubah warna layer menjadi kuning
                e.layer.setStyle({
                    fillColor: 'yellow', // Mengubah warna marker menjadi kuning
                    color: 'black' // Menambahkan border hitam
                });
                if (e.layer._popup)
                    e.layer.openPopup(); // Menampilkan popup jika ada
            }).on('search:collapsed', function(e) {
                // Jika pencarian dibatalkan, mengembalikan gaya layer ke keadaan semula
                kantor_pos.eachLayer(function(layer) {
                    kantor_pos.resetStyle(layer); // Reset style layer
                });
            });

            // Menambahkan kontrol pencarian ke peta
            map.addControl(searchControl);

		</script>

         <!-- Footer -->
         <footer class="footer bg-dark text-white text-center py-3">
            <p>&copy; 2024 Sistem Informasi Pos Recycling Online. All rights reserved.</p>
        </footer>
	</body>
</html>