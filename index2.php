<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Riwayat</title>
    <style>
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
            <!-- Form Pencarian -->
            <form class="d-flex mt-3" role="search" action="index2.php" method="get">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
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
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="tentang.html">Tentang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://jakartasatu.jakarta.go.id/" target="_blank">Sumber Data</a>
            </li>
            </ul>
        </div>
        </div>
    </div>
</nav>

<br>
<div style="margin-top: 80px;"></div>

<div id="container">
    <div id="table-container" class="mx-auto col-lg-8 col-md-10 col-sm-12">
        <h2 class="text-center mb-4">Riwayat Order</h2>

        <table class="table table-striped">
        <thead>
            <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Jenis Barang</th>
            <th>Deskripsi</th>
            <th>Pos Tujuan</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Tanggal Pengiriman</th>
            <th>Metode Layanan</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "responsi");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Cek apakah ada query pencarian dari form
            if (isset($_GET['query']) && !empty($_GET['query'])) {
                $query = $conn->real_escape_string($_GET['query']);
                // Query untuk mencari berdasarkan metode layanan
                $sql = "SELECT * FROM kantorpos WHERE metode_layanan LIKE '%$query%'";
            } else {
                // Menampilkan semua data jika tidak ada pencarian
                $sql = "SELECT * FROM kantorpos";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["nama"]."</td>";
                    echo "<td>".$row["telepon"]."</td>";
                    echo "<td>".$row["jenis_barang"]."</td>";
                    echo "<td>".$row["deskripsi"]."</td>";
                    echo "<td>".$row["alamat"]."</td>";
                    echo "<td>".$row["latitude"]."</td>";
                    echo "<td>".$row["longitude"]."</td>";
                    echo "<td>".$row["tanggal_pengiriman"]."</td>";
                    echo "<td>".$row["metode_layanan"]."</td>";
                    echo "<td>
                        <a href='update.php?id=".$row["id"]."' class='btn btn-warning btn-sm'>
                            <i class='fa-solid fa-pen'></i>
                        </a>
                        <a href='delete.php?id=".$row["id"]."' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>
                            <i class='fa-solid fa-trash'></i>
                        </a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>Tidak ada hasil untuk pencarian.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
