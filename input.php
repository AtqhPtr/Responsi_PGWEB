<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Form Input</title>
</head>
<body>
<?php
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "responsi");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Proses input data jika form di-submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $jenis_barang = $_POST['jenis_barang'];
        $deskripsi = $_POST['deskripsi'];
        $alamat = $_POST['alamat'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $tanggal_pengiriman = $_POST['tanggal_pengiriman'];
        $metode_layanan = $_POST['metode_layanan'];

        $sql = "INSERT INTO kantorpos (nama, telepon, jenis_barang, deskripsi, alamat, latitude, longitude, tanggal_pengiriman, metode_layanan) 
        VALUES ('$nama', '$telepon', '$jenis_barang', '$deskripsi', '$alamat', $latitude, $longitude, '$tanggal_pengiriman', '$metode_layanan')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Data berhasil ditambahkan</div>";
            header("Location: index2.php");
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }

    $conn->close();
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-black">
            <h2 class="text-center">Form Input Data Order</h2>
        </div>
        <div class="card-body">
            <form action="/responsi/input.php" method="post" id="form">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon:</label>
                    <input type="tel" class="form-control" id="telepon" name="telepon" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_barang" class="form-label">Jenis Barang:</label>
                    <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Pos Tujuan</label>
                    <select id="alamat" class="form-control" name="alamat" required>
                        <option value="" disabled selected>Pilih Pos Tujuan</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="latitude" class="form-label">Latitude:</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required pattern="^-?\d+(\.\d+)?$" title="Masukkan format angka latitude yang valid.">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="longitude" class="form-label">Longitude:</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" required pattern="^-?\d+(\.\d+)?$" title="Masukkan format angka longitude yang valid.">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman:</label>
                    <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" required>
                </div>
                <div class="mb-3">
                    <label for="metode_layanan" class="form-label">Metode Layanan:</label>
                    <select class="form-select" id="metode_layanan" name="metode_layanan" required>
                        <option value="" disabled selected>Pilih Metode Layanan</option>
                        <option value="pickup">Pick-Up</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.getElementById('form').addEventListener('submit', function (e) {
        // Validasi tambahan di JavaScript
        const fields = document.querySelectorAll('input[required], select[required], textarea[required]');
        let valid = true;

        fields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!valid) {
            e.preventDefault();
            alert("Semua kolom wajib diisi!");
        }
    }); 

    // URL file GeoJSON Anda
    const geoJsonUrl = 'data/KantorPos.geojson';

    // Fungsi untuk memuat GeoJSON
    fetch(geoJsonUrl)
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('alamat');

            // Loop melalui fitur GeoJSON untuk mengambil data properti
            data.features.forEach(feature => {
                const { REMARK } = feature.properties; // Sesuaikan nama properti
                const option = document.createElement('option');
                option.value = REMARK; // Nilai yang akan digunakan dalam form
                option.textContent = `${REMARK}`; // Teks yang ditampilkan
                selectElement.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading GeoJSON:', error);
        });




    


</script>
</body>
</html>
