<?php
include "db.php";

$first_name = $_POST["first-name"];
$last_name = $_POST["last-name"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];

if (isset($_POST["remember"]) && $_POST["remember"] == "on") {
    $newsletter = "TRUE";
} else {
    $newsletter = "FALSE";
}

$check_sql = "SELECT * FROM Users WHERE Email='$email'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    Header("Location:login_page.php?exists=true");
    exit();
}

$password = password_hash($pwd, PASSWORD_DEFAULT);

$sql = "INSERT INTO Users (FirstName, LastName, Email, Newsletter, Password) VALUES ('$first_name', '$last_name', '$email', $newsletter, '$password')";

if ($conn->query($sql)) {
    $result = $conn->query("SELECT * FROM Users WHERE Email='$email'");
    $row = $result->fetch_assoc();

    if (session_id() == '') {
        session_start();
        $_SESSION["id"] = $row["UserID"];
        $_SESSION["first-name"] = $row["FirstName"];
        $_SESSION["last-name"] = $row["LastName"];
    }

    Header("Location:main_page.php");
} else {
    Header("Location:signup_page.php?error=true");
}
?>
