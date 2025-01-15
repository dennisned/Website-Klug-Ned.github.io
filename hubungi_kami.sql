-- Skema Basis Data untuk tabel "hubungi_kami"

CREATE TABLE hubungi_kami (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID unik untuk setiap entri
    nama VARCHAR(100) NOT NULL,        -- Nama pengirim
    email VARCHAR(150) NOT NULL,      -- Email pengirim
    perusahaan VARCHAR(150),          -- Nama perusahaan/organisasi (opsional)
    telepon VARCHAR(20),              -- Nomor telepon
    pesan TEXT NOT NULL,              -- Isi pesan
    captcha VARCHAR(10) NOT NULL,     -- Nilai balikan dari captcha
    tanggal_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Waktu pengisian
);
