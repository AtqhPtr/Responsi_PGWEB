<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "responsi");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi variabel kosong
$nama = $telepon = $jenis_barang = $deskripsi = $alamat = $latitude = $longitude = $tanggal_pengiriman = $metode_layanan = "";

// Periksa apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan id
    $sql = "SELECT * FROM kantorpos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data dari database
        $row = $result->fetch_assoc();
        $nama = $row["nama"];
        $telepon = $row["telepon"];
        $jenis_barang = $row["jenis_barang"];
        $deskripsi = $row["deskripsi"];
        $alamat = $row["alamat"];
        $latitude = $row["latitude"];
        $longitude  = $row["longitude"];
        $tanggal_pengiriman = $row["tanggal_pengiriman"];
        $metode_layanan  = $row["metode_layanan"];
    } else {
        echo "Data tidak ditemukan.";
    }
}

// Proses update data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tanggal_pengiriman = $_POST['tanggal_pengiriman'];
    $metode_layanan  = $_POST['metode_layanan'];

    // Query untuk update data
    $sql = "UPDATE kantorpos SET tanggal_pengiriman = '$tanggal_pengiriman', metode_layanan = '$metode_layanan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
        // Redirect ke halaman utama setelah update
        header("Location: index2.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Form untuk update data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-black">
            <h3 class="text-center">Update Data Order</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="update.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon:</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="jenis_barang" class="form-label">Jenis Barang:</label>
                    <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?php echo $jenis_barang; ?>" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" readonly><?php echo $deskripsi; ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Pos Tujuan</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" readonly>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="latitude" class="form-label">Latitude:</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="longitude" class="form-label">Longitude:</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude; ?>" readonly>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman/Pengambilan:</label>
                    <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" value="<?php echo $tanggal_pengiriman; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="metode_layanan" class="form-label">Metode Layanan:</label>
                    <select class="form-select" id="metode_layanan" name="metode_layanan" required>
                        <option value="pickup" <?php echo ($metode_layanan == 'pickup') ? 'selected' : ''; ?>>Pick-Up</option>
                        <option value="delivery" <?php echo ($metode_layanan == 'delivery') ? 'selected' : ''; ?>>Delivery</option>
                    </select>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-warning w-100">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
