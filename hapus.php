<?php
include './koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $poin_sekarang = mysqli_query($conn, "DELETE FROM team WHERE id='" . $_GET['id'] . "'");
    header('location: ./index.php');
}
