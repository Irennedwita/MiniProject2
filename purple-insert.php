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
    
    $conn = mysqli_connect('localhost','root','','purple_calendar');

    $email = $_SESSION["email"];

    if ($_POST) {
        $nama = $_POST["nama"];
        $tglMulai = $_POST["tgl_mulai"];
        $tglSelesai = $_POST["tgl_selesai"];
        $level = $_POST["level_penting"];
        $durasi = $_POST["durasi"];
        $lokasi = $_POST["lokasi"];
        $gambar = $_FILES['gambar']['name'];

        if($gambar!=""){
            $uploadfile = "images/".$_FILES["gambar"]['name'];
            $tipefile = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));

            if($tipefile != "jpg" && $tipefile != "png" && $tipefile != "jpeg") {
                echo "<h3>Hanya bisa JPG,PNG, dan JPEG</h3>";	
            }
            else {
                if(move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
                    $sql = "INSERT INTO kegiatan (nama, tgl_mulai, tgl_selesai, level_penting, durasi, lokasi, gambar, id_user)
                    VALUES ('".$nama."', '".$tglMulai."', '".$tglSelesai."', '".$level."', '".$durasi."', '".$lokasi."', '".$uploadfile."',
                    (SELECT id FROM user WHERE email='".$email."'))";
    
                    if (mysqli_query($conn, $sql)) {
                        echo "<h3>Berhasil Menambahkan Kegiatan</h3>";
                        // header("Location: purple.php");
                    } else {
                        echo "<h3>Gagal Menambahkan Kegiatan</h3>";
                        // header("Location: purple-insert.php");
                    }
                }
            }
        }
        else {
            $sql = "INSERT INTO kegiatan (nama, tgl_mulai, tgl_selesai, level_penting, durasi, lokasi, id_user)
                    VALUES ('".$nama."', '".$tglMulai."', '".$tglSelesai."', '".$level."', '".$durasi."', '".$lokasi."',
                    (SELECT id FROM user WHERE email='".$email."'))";

            // var_dump($sql);
    
            if (mysqli_query($conn, $sql)) {
                echo "<h3>Berhasil Menambahkan Kegiatan</h3>";
                // header("Location: purple.php");
            } else {
                echo "<h3>Gagal Menambahkan Kegiatan</h3>";
                // header("Location: purple-insert.php");
            }
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT</title>
    <link rel="stylesheet" href="purple-insert.css">
</head>

<body>
    <a href="purple.php">
        << Home</a>

    <form action="purple-insert.php" method="post" name="formTambah" enctype="multipart/form-data">
        <table>
            <tr>
                <td colspan="3"><h2>Insert Kegiatan</h2></td>
            </tr>
            <tr>
                <td>Nama Kegiatan </td>
                <td>
                    <input type="text" name="nama" required>
                </td>
            </tr>
            <tr>
                <td>Tanggal Mulai </td>
                <td>
                    <input type="date" id="tglMulai" name="tgl_mulai" required>
                </td>
            </tr>
            <tr>
                <td>Tanggal Selesai </td>
                <td>
                    <input type="date" id="tglSelesai" name="tgl_selesai" required>
                </td>
            </tr>
            <tr>
                <td>Level Penting </td>
                <td>
                    <input type="radio" id="biasa" name="level_penting" value="biasa">
                    <label for="biasa">Biasa</label>
                    <input type="radio" id="sedang" name="level_penting" value="sedang">
                    <label for="sedang">Sedang</label>
                    <input type="radio" id="penting" name="level_penting" value="sangat penting">
                    <label for="penting">Sangat Penting</label>
                </td>
            </tr>
            <tr>
                <td>Durasi Kegiatan </td>
                <td>
                    <input type="number" id="durasi" name="durasi" required>
                    <label for="durasi">jam</label>
                </td>
            </tr>
            <tr>
                <td>Lokasi Kegiatan </td>
                <td>
                    <input type="text" name="lokasi" required>
                </td>
            </tr>
            <tr>
                <td>Pilih gambar: </td>
                <td>
                    <input type="file" id="gambar" name="gambar">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br>
                    <input type="submit" name="Submit" value="TAMBAH">
                    <input type="reset" name="Reset" value="RESET">
                </td>
            </tr>
        </table>
    </form>

</body>
</html>