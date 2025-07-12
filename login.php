
<?php
session_start();


$conn = mysqli_connect("localhost", "root", "", "cukierniaUsers");


$login = $_POST['loginFromLogin'];
$password = $_POST['passFromLogin'];
$login = mysqli_real_escape_string($conn, $login);

$sql = "SELECT login, password FROM `user` WHERE login = '$login'";

$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);

    
    if ($password === $row['password']) {
        $_SESSION["user"] = htmlspecialchars($login);  

        header('Location:http://localhost/4-06-25/admin/uploadFile.php');
        exit();

    } else {
        echo "Błędne hasło";
    }
} else {
    echo "Użytkownik nie istnieje";
}


mysqli_close($conn);


?>