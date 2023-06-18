<?php
    //kode anda
$con = mysqli_connect("localhost","root","","purple_calendar") or die("Koneksi gagal.");
if($_GET){
    $id = $_GET["id"];
    $sql = "DELETE FROM kegiatan WHERE id ='".$id."'";
    $result = mysqli_query($con,$sql);   
    
    echo '<h3 style="color:black;text-align:center;">Data Berhasil Dihapus</h3>';
}
?>