<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "responsi");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM kantorpos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
        // Redirect ke halaman utama setelah delete
        header("Location: index2.php"); 
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>
