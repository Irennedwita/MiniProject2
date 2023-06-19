<?php
    //kode anda
$con = mysqli_connect("localhost","root","","purple_calendar") or die("Koneksi gagal.");

session_start();
if(!isset($_SESSION['email'])) {
    header("Location: purple-login.php");
}
if (isset($_POST['logout'])) {
   session_destroy();
   header('location:purple-login.php');
}

if($_GET){
    $id = $_GET["id"];
    $sql = "DELETE FROM kegiatan WHERE id ='".$id."'";
    $result = mysqli_query($con,$sql);   
    
    echo "<h3>Data Berhasil Dihapus</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Page</title>
    <link rel="stylesheet" href="purple-insert.css">
</head>
<body>
<a href="purple.php">
        << Home</a>
</body>
</html>