  <?php

  // Memeriksa apakah form telah disubmit
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Mengambil data dari form
      $nama = $_POST['nama'];
      $jumlah = $_POST['jumlah'];
      $alamat = $_POST['alamat'];
      $noHp = $_POST['no_hp'];

      // Menghitung total harga
      $totalHarga = $productPrice * $jumlah;

      // Mendapatkan tanggal dan jam saat ini
      $tanggalPemesanan = date('Y-m-d');
      $jamPemesanan = date('H:i:s');

      // Simpan data ke database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "kedaikopi";

      // Membuat koneksi ke database
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Memeriksa koneksi
      if ($conn->connect_error) {
          die("Koneksi ke database gagal: " . $conn->connect_error);
      }

      // Memasukkan data pembayaran ke tabel transaksi
      $sql = "INSERT INTO transaksi (nama, produk, jumlah, total_harga, tanggal_pemesanan, jam_pemesanan, alamat, no_hp)
          VALUES ('$nama', '$productName', '$jumlah', '$totalHarga', '$tanggalPemesanan', '$jamPemesanan', '$alamat', '$noHp')";

      if ($conn->query($sql) === TRUE) {
          echo "Pembayaran berhasil. Terima kasih!";
          header('location: index.html');
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Menutup koneksi
      $conn->close();
  }
  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN PEMBAYARAN</title>
    <link rel="stylesheet" href="css/pembayaran.css">
    <script>
    function showSuccessMessage() {
        
        alert
    alert('Pesanan kamu berhasil dibuat Dan siap dikirmkan');
    window.location.href='index.html';
    return false;
        }
    </script>
  </head>


  <body>
    <h2>Form Pembayaran</h2>

    <form action="" method="post" onsubmit="showSuccessMessage()">
      <div>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
      </div>
      <div>
        
      
        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" min="1" value="1" required>
      </div>
      <div>
      <label for="no_hp">Nomor HP:</label>
        <input type="text" id="no_hp" name="no_hp" required>
      </div>  
      <div>
        <label for="alamat">Alamat Pengiriman dengan Lengkap:</label>
        <textarea id="alamat" name="alamat" rows="4" required></textarea>
      </div>
      <div>
        <label for="total_harga">Total Harga:</label>
        <input type="text" id="total_harga" name="total_harga" required>
      </div>
      <button type="submit">Kirim</button>
    </form>

  </body>

  </html>