<?php
include './koneksi.php';
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $poin = 0;
    $win = 0;
    $insert = mysqli_query($conn, "INSERT INTO team (nama, poin, win) VALUES ('$nama', '$poin', '$win')");
    header('location: ./index.php');
}
