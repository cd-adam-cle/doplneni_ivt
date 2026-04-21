<?php
include "db.php";

$email = $_POST["email"];
$pwd = $_POST["pwd"];

$sql = "SELECT * FROM Users WHERE Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    Header("Location:login_page.php?pwd=false");
} else {
    $row = $result->fetch_assoc();

    if (!password_verify($pwd, $row["Password"])) {
        Header("Location:login_page.php?pwd=false");
    } else {
        if (session_id() == '') {
            session_start();
            $_SESSION["id"] = $row["UserID"];
            $_SESSION["first-name"] = $row["FirstName"];
            $_SESSION["last-name"] = $row["LastName"];
        }

        Header("Location:main_page.php");
    }
}
?>
