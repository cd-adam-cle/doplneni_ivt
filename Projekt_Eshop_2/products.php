<?php session_start();
include "db.php";
include "header.html";
?>
<h1 class="products-header">Naše nabídka</h1>

<?php
if (isset($_GET["sort"])) {
    $_SESSION["filter_category"] = $_GET["category"];
    $_SESSION["filter_sort"] = $_GET["sort"];
    $_SESSION["filter_skladem"] = isset($_GET["skladem"]);
}

$category = $_SESSION["filter_category"] ?? "none";
$sort = $_SESSION["filter_sort"] ?? "none";
$skladem = $_SESSION["filter_skladem"] ?? false;
?>

<form id="form-filter" method="GET" action="">
    <select name="category">
        <option value="none">Všechny kategorie</option>
        <?php
        $cat_res = $conn->query("SELECT * FROM Categories");
        while ($cat = $cat_res->fetch_assoc()) {
            $selected = ($category == $cat["CategoryID"]) ? "selected" : "";
            echo "<option value={$cat['CategoryID']} $selected>{$cat['Name']}</option>";
        }
        ?>
    </select>

    <select name="sort">
        <option value="none" <?php echo $sort == "none" ? "selected" : "" ?>>Základní řazení</option>
        <option value="price_asc" <?php echo $sort == "price_asc" ? "selected" : "" ?>>Od nejlevnějšího</option>
        <option value="price_desc" <?php echo $sort == "price_desc" ? "selected" : "" ?>>Od nejdražšího</option>
    </select>

    <div>
        <input type="checkbox" name="skladem" <?php echo $skladem ? "checked" : "" ?>>
        <label>Pouze položky, které jsou skladem</label>
    </div>

    <button type="submit">Aplikovat</button>
</form>

<div class="products-grid">
    <?php
        $sql = "SELECT * FROM Items";
        $where_added = false;

        if ($category != "none") {
            $sql .= " WHERE CategoryID = $category";
            $where_added = true;
        }
        if ($skladem) {
            if ($where_added) {
                $sql .= " AND Pieces > 0";
            } else {
                $sql .= " WHERE Pieces > 0";
            }
        }
        if ($sort == "price_asc") {
            $sql .= " ORDER BY Price ASC";
        } else if ($sort == "price_desc") {
            $sql .= " ORDER BY Price DESC";
        }

        $result = $conn->query($sql);

        while ($item = $result->fetch_assoc()) {
            if($item["Pieces"] > 0) {  ?>
                <div class="item">
    <?php   } else { ?>
                <div class="item sold-out">
    <?php   }
    ?>
                    <img src="products/<?php echo $item["ItemID"] ?>.jpg">
                    <div class="item-text">
                        <h2><?php echo $item["Name"] ?></h2>
                        <p><?php echo $item["Price"] ?> Kč</p>
                    </div>
                    <?php
                        if($item["Sale"] > 1) {
                            $sale_id = $item["Sale"];
                            $sql2 = "SELECT * FROM Sales WHERE SaleID = $sale_id";
                            $sale = $conn->query($sql2);
                            $sale_info = $sale->fetch_assoc();
                        ?>
                        <p class="sale"><?php echo "-" . $sale_info["Percentage"] . "% (" . $sale_info["Name"] . ")"; ?></p>
                <?php } ?>
                </div>

    <?php
        }
    ?>
</div>

</body>
</html>
