<?php
session_start();
require '../config.php';

$header = htmlspecialchars($_POST['header']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$tentang = htmlspecialchars($_POST['tentang']);
$footer = htmlspecialchars($_POST['footer']);

// logo
$logo = $_FILES['logo'];
$ukuran_logo = $_FILES['logo']['size'];
$place_logo = $_FILES['logo']['tmp_name'];
$nama_logo = $_FILES['logo']['name'];
$logo_lama = htmlspecialchars($_POST['logo_lama']);
$enkripsi_nama_logo = time() . '_InJoon_' . $nama_logo;

// Favicon
$favicon = $_FILES['favicon'];
$ukuran_favicon = $_FILES['favicon']['size'];
$place_favicon = $_FILES['favicon']['tmp_name'];
$nama_favicon = $_FILES['favicon']['name'];
$favicon_lama = htmlspecialchars($_POST['favicon_lama']);
$enkripsi_nama_favicon = time() . '_InJoon_' . $nama_favicon;
$ubahLogo  = move_uploaded_file($place_logo, '../../frontend/images/' . $enkripsi_nama_logo);
$ubahFavicon  = move_uploaded_file($place_favicon, '../../frontend/images/' . $enkripsi_nama_favicon);
if ($ubahLogo || $ubahFavicon) {
    if ($ubahLogo && $ubahFavicon) {
        unlink('../../frontend/images/' . $logo_lama);
        unlink('../../frontend/images/' . $favicon_lama);
        $queryUbah = "UPDATE tb_pengaturan SET 
        pengaturan_headerWebsite='$header',
        pengaturan_deskripsiWebsite='$deskripsi',
        pengaturan_tentang='$tentang',
        pengaturan_footer='$footer',
        pengaturan_logo = '$enkripsi_nama_logo',
        pengaturan_favicon = '$enkripsi_nama_favicon'
        WHERE pengaturan_id = 1
        ";
    } else if ($ubahLogo) {
        unlink('../../frontend/images/' . $logo_lama);
        $queryUbah = "UPDATE tb_pengaturan SET 
        pengaturan_headerWebsite='$header',
        pengaturan_deskripsiWebsite='$deskripsi',
        pengaturan_tentang='$tentang',
        pengaturan_footer='$footer',
        pengaturan_logo = '$enkripsi_nama_logo'
        WHERE pengaturan_id = 1
        ";
    } else if ($ubahFavicon) {
        unlink('../../frontend/images/' . $favicon_lama);
        $queryUbah = "UPDATE tb_pengaturan SET 
        pengaturan_headerWebsite='$header',
        pengaturan_deskripsiWebsite='$deskripsi',
        pengaturan_tentang='$tentang',
        pengaturan_footer='$footer',
        pengaturan_favicon = '$enkripsi_nama_favicon'
        WHERE pengaturan_id = 1
        ";
    }
    $query = mysqli_query($conn, $queryUbah);
    if ($query > 0) {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Data berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../pengaturan.php');
    } else {
        $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Data gagal ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
        header('Location:../../pengaturan.php');
    }
} else {
    $queryUbah = "UPDATE tb_pengaturan SET 
    pengaturan_headerWebsite='$header',
    pengaturan_deskripsiWebsite='$deskripsi',
    pengaturan_tentang='$tentang',
    pengaturan_footer='$footer'
    WHERE pengaturan_id = 1
    ";
    $query = mysqli_query($conn, $queryUbah);

    if ($query > 0) {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../pengaturan.php');
    } else {
        $_SESSION['pesan'] = '
                <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
        header('Location:../../pengaturan.php');
    }
}
