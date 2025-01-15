<?php
// Konfigurasi koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda, misalnya localhost
$username = 'root';  // Ganti dengan username MySQL Anda
$password = '';      // Ganti dengan password MySQL Anda
$dbname = 'hubungi_kami'; // Nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$perusahaan = isset($_POST['perusahaan']) ? trim($_POST['perusahaan']) : '';
$telepon = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';
$pesan = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';

// Validasi form
if (empty($nama) || empty($email) || empty($pesan)) {
    die("Nama, Email, dan Pesan harus diisi!");
}

// Pastikan email valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Alamat email tidak valid.");
}

// Validasi Captcha
$captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
if (empty($captcha)) {
    die("Captcha tidak diisi. Silakan lengkapi captcha.");
}

$secretKey = "6LdS4bcqAAAAAHHonfriaB3AtTePZGyw2CUCjIPs"; // Secret key reCAPTCHA Anda
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
$responseKeys = json_decode($response, true);

if (!$responseKeys['success']) {
    die("Verifikasi Captcha gagal. Silakan coba lagi.");
}

// Menggunakan Prepared Statement untuk menghindari SQL Injection
$stmt = $conn->prepare("INSERT INTO hubungi_kami (nama, email, perusahaan, telepon, pesan, captcha) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nama, $email, $perusahaan, $telepon, $pesan, $captcha);

// Menjalankan query dan cek hasilnya
if ($stmt->execute()) {
    echo "Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami!";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
