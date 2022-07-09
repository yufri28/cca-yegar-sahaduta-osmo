<?php
include './koneksi.php';

if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
    if ($mod == 'tambah') {
        $poin_sekarang = mysqli_query($conn, "SELECT poin FROM team WHERE id='" . $_GET['id'] . "'");
        $fetchPoin = mysqli_fetch_assoc($poin_sekarang);
        $countUp = $fetchPoin['poin'] + 100;
        $update_poin = mysqli_query($conn, "UPDATE team SET poin = '$countUp' WHERE id='" . $_GET['id'] . "'");
        // hitung pemenang
    } elseif ($mod == 'kurang') {
        $poin_sekarang = mysqli_query($conn, "SELECT poin FROM team WHERE id='" . $_GET['id'] . "'");
        $fetchPoin = mysqli_fetch_assoc($poin_sekarang);
        $countDown = $fetchPoin['poin'] - 100;
        $update_poin = mysqli_query($conn, "UPDATE team SET poin = '$countDown' WHERE id='" . $_GET['id'] . "'");
        // hitung pemenang
    }
    header('location: ./index.php');
}
