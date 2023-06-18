<?php
$conn = mysqli_connect('localhost','root','','purple_calendar');

if($_POST){
    // Get the input values from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for the user
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if the user was found
    if(mysqli_num_rows($result) == 1) {
        // Login successful, redirect to the dashboard or home page
        
        session_start();
        setcookie('name',  mysqli_fetch_array($result)['nama'], time() + 60);
        $_SESSION['email'] = $email;
        header("Location: purple.php");
        exit();
    } else {
        // Login failed, display an error message
        $error = "Invalid email or password.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="purple-login.css">
    <style>
        .warning{
            color:red;
            font-weight:bold;
        }
        .warningBox{
            border: 1px #d1a4a8 dotted;
        }
    </style>
</head>
<body>
    <header>
        <center>
            <h1>Purple Calendar</h1>
        </center>
    </header>
    <main>
        <center>
            <form method="POST" action="purple-login.php" id="loginpage">
                <table>
                    <h2>Log In</h2>
                    <tr>
                        <div>
                            <td><input type="email" class="login" name="email" placeholder="Masukkan email"></td>
                        </div>
                    </tr>
                    <tr>
                        <div>
                            <td><input type="password" class="login" name="password" placeholder="Masukkan password"></td>
                        </div>
                    </tr>
                </table><br>
                <input type="submit" name="submit" value="Log In" id="submit"><br><br>
                <span class="warning" hidden>For Error</span>
            </form>
        </center>
    </main>
    <footer class="footer">
        <span>
            &#169; UAS Praktikum ProgWeb Kelompok 3
        </span>
    </footer>
</body>
</html>

<script src="purple-login.js"></script>