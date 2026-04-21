<?php session_start();
include "db.php";
include "header.html";
?>

<?php
if (isset($_SESSION["id"]) && isset($_POST["text"]) && isset($_POST["stars"])) {
    $user_id = $_SESSION["id"];
    $text = $_POST["text"];
    $stars = $_POST["stars"];

    $sql = "INSERT INTO Reviews (UserID, Text, Stars) VALUES ($user_id, '$text', $stars)";
    $conn->query($sql);

    Header("Location:reviews.php");
    exit();
}
?>

<h1 class="products-header">Recenze</h1>

<?php if (isset($_SESSION["id"])) { ?>
    <div class="review-form">
        <form action="reviews.php" method="post">
            <h3>Napište recenzi</h3>
            <textarea name="text" placeholder="Váš text recenze..." required></textarea>
            <label>Počet hvězdiček:
                <select name="stars">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5" selected>5</option>
                </select>
            </label>
            <button type="submit">Odeslat</button>
        </form>
    </div>
<?php } ?>

<div class="reviews-grid">
<?php
    $sql = "SELECT Reviews.*, Users.FirstName, Users.LastName FROM Reviews JOIN Users ON Reviews.UserID = Users.UserID";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='review'>";
        echo "<h3 class='review-author'>" . $row["FirstName"] . " " . $row["LastName"] . "</h3>";
        echo "<p class='review-text'>" . $row["Text"] . "</p>";

        $stars_html = "";
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row["Stars"]) {
                $stars_html .= "★ ";
            } else {
                $stars_html .= "☆ ";
            }
        }
        echo "<p class='stars'>" . $stars_html . "</p>";
        echo "</div>";
    }
?>
</div>

</body>
</html>
