<?php
// Mengatur informasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kedaikopi";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus pesanan
if(isset($_GET['hapus'])) {
  $id_pesanan = $_GET['hapus'];
  $sql_delete = "DELETE FROM transaksi WHERE id = $id_pesanan";
  if ($conn->query($sql_delete) === TRUE) {
  } else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
  }
}

// Mengambil semua transaksi yang berhasil
$sql = "SELECT * FROM transaksi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <h2>DAFTAR TRANSAKSI BERHASIL</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal & Jam Pemesanan</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["produk"] . "</td>";
                echo "<td>" . $row["jumlah"] . "</td>";
                echo "<td>" . $row["total_harga"] . "</td>";

                // Menggabungkan tanggal dan jam pemesanan
                if (isset($row["tanggal_pemesanan"]) && isset($row["jam_pemesanan"])) {
                    $tanggal_pemesanan = date('Y-m-d H:i', strtotime($row["tanggal_pemesanan"] . ' ' . $row["jam_pemesanan"]));
                    echo "<td>" . $tanggal_pemesanan . "</td>";
                }

                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["no_hp"] . "</td>";
                echo "<td><a href='?hapus=" . $row["id"] . "' class='hapus-link'>Hapus</a></td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Tidak Ada Pemesanan.</td></tr>";
        }
        ?>
    </table>
    <div class="navbar">
        <a href="index.html" class="back-link"><i class="fas fa-arrow-left"></i> BACK TO HOME</a>
    </div>
</body>

</html>
