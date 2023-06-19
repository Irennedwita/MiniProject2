<?php
// $_SESSION['email'] = 'irenne@gmail.com';

session_start();
if(!isset($_SESSION['email'])) {
    header("Location: purple-login.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:purple-login.php');
}

$conn = mysqli_connect("localhost", "root", "", "purple_calendar");

$id = null;
if($_GET){
    $id = $_GET["id"];
    $sql = "SELECT * FROM kegiatan WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $nama = $row["nama"];
        $tglMulai = $row["tgl_mulai"];
        $tglSelesai = $row["tgl_selesai"];
        $durasi =$row["durasi"];
        $level  = $row["level_penting"];
        $lokasi = $row["lokasi"];
        $gambar = $row["gambar"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
    <link rel="stylesheet" href="styledetail.css">
</head>
<body>
<header>
        <a href="purple.php"><img src="img/back.png" alt="icon back"></a>
        <h1>Details</h1>
    </header>
    <main>
        <table>
            <tr>
                <td colspan="3"><h2><?php echo $nama;?></h2></td>
            
            </tr>
            <tr>
                <td rowspan=""><img src="img/calendar.png" alt="icon calendar"></td>
                <td><p>Tanggal Mulai Kegiatan</p></td>
                <td><?php echo $tglMulai;?></td>
            </tr>
            <tr>
                <td></td>
                <td><p>Tanggal Selesai Kegiatan</p></td>
                <td><?php echo $tglSelesai;?></td>
            </tr>
            <tr>
                <td><img src="img/duration.png" alt="icon durasi"></td>
                <td><p>Durasi Kegiatan</p></td>
                <td>
                    <?php echo $durasi;?>       jam
                </td>
            </tr>
            <tr>
                <td><img src="img/location.png" alt="icon lokasi"></td>
                <td><p>Lokasi Kegiatan</p></td>
                <td><?php echo $lokasi;?></td>
            </tr>
            <tr>
                <td><img src="img/priority.png" alt="icon priority"></td>
                <td><p>Level Penting</p></td>
                <td>
                    <?php echo $level;?>
                </td>
            </tr>
        </table>

        <a class="hapus" href="purple-delete.php?id=<?php echo $row["id"]?>"><button>HAPUS</button></a>

    </main>
    <aside>
        <?php if($gambar != null) {?>
            <img src="<?php echo $gambar;?>" alt="">
        <?php }?>
    </aside>
    <footer>
        Purple Calendar
        <!-- <a href="detail4.html"><img src="prev.svg" alt="prev"></a>
        <a href="detail3.html"><img src="next.png" alt="next"></a> -->
    </footer>
    
</body>
</html>