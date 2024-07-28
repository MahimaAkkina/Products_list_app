<?php
$conn = mysqli_connect("localhost", "root", "", "products_list"); //connection to database

//Setting default filter values if not set, if sets it takes from form submission
$min=isset($_POST['price_min']) ? $_POST['price_min'] : '';
$max=isset($_POST['price_max']) ? $_POST['price_max'] : '';
$cat=isset($_POST['cat']) ? $_POST['cat'] : 'All';
$sale=isset($_POST['sale']) ? $_POST['sale'] : 'All';

$products_for_each_page=12; // we need 12 products per page for pagination 

//getting current page number from url, default to 1 if not set
$curr_page=isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset=($curr_page-1)*$products_for_each_page; // if page=3 then (3-1)*12 = 24 , so it starts from 25th row

//filter conditions
$filt_conditions=[];
if($min!==''){
    $filt_conditions[]="price>= $min";
}
if($max!==''){
    $filt_conditions[]="price<=$max";
}
if($cat!=='All'){
    $filt_conditions[]="category='$cat'";
}
if($sale!=='All'){
    $filt_conditions[]="sale_status ='$sale'";
}
$check_all_conditions=implode(' AND ', $filt_conditions); //conditions array converted into string

//query checking how many products will match the filters (all conditions)
$sql = "SELECT * FROM products";
if (!empty($check_all_conditions)) {
    $sql .= " WHERE $check_all_conditions";
}

//below query is for calculating no. of products will match all conditions
$count_query="SELECT COUNT(*) as total FROM products";
if(!empty($check_all_conditions)){
    $count_query .= " WHERE $check_all_conditions";
}

//after counting products then finding how many pages required for pagination
$count_result=mysqli_query($conn, $count_query);
$total_products=mysqli_fetch_assoc($count_result)['total'];
$total_pages=ceil($total_products/$products_for_each_page);

//This query is used to fetch filtered products with pagination
$sql .= " LIMIT $offset, $products_for_each_page";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Listing App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        *{
            background-color: black;
            color: aliceblue;
        }
        ::placeholder {
            color: white;
        }
        ul {
            border-radius: 15%;
        }
        li {
            border: 2px solid yellow;
            border-radius: 15%;
        }
        a {
            color: yellow !important;
            background-color: black !important;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="h1 text-center p-3 rounded-4 text-white mt-2 fw-bolder" style="font-family:Verdana, Geneva, Tahoma, sans-serif; border:3px solid yellow;">Product Listing App</h1>
        <!-- Form for filters -->
        <form method="post" action="#">
            <div class="mt-3 mb-4 text-center">
                <label class="fw-bold">Price Range:</label>
                <input type="number" name="price_min" class="border border-3 rounded-4 p-2 ms-3" placeholder="Min" value="<?= htmlspecialchars($min) ?>">
                <input type="number" name="price_max" class="border border-3 rounded-4 p-2 ms-3" placeholder="Max" value="<?= htmlspecialchars($max) ?>">
                <label class="ms-3 fw-bold">Category:</label>
                <select name="cat" id="category" class="border border-3 rounded-4 p-2 ms-3">
                    <option value="All" <?= $cat === 'All' ? 'selected' : '' ?>>All</option>
                    <option value="Mobile" <?= $cat === 'Mobile' ? 'selected' : '' ?>>Mobile</option>
                    <option value="Laptop" <?= $cat === 'Laptop' ? 'selected' : '' ?>>Laptop</option>
                    <option value="Headphones" <?= $cat === 'Headphones' ? 'selected' : '' ?>>Headphones</option>
                </select>
                <label class="ms-3 fw-bold">Sale Status:</label>
                <select name="sale" id="sale_status" class="border border-3 rounded-4 p-2 ms-3">
                    <option value="All" <?= $sale === 'All' ? 'selected' : '' ?>>All</option>
                    <option value="On sale" <?= $sale === 'On sale' ? 'selected' : '' ?>>On Sale</option>
                    <option value="Not on sale" <?= $sale === 'Not on sale' ? 'selected' : '' ?>>Not on Sale</option>
                </select>
                <button type="submit" name="submit" class="border border-3 rounded-pill p-2 ms-3 fw-bold" style="color:yellow;">Apply Filters</button>
            </div>
        </form>
        <!-- Form Closed -->
        <!-- Displaying products in table form -->
        <?php
        if (mysqli_num_rows($res) > 0) {
            echo "<table class='ms-4'>";
            $count = 0;
            while ($row = mysqli_fetch_assoc($res)) {
                if ($count % 4 == 0) {
                    echo "<tr class='d-flex'>";
                }
                echo "<td class='text-center rounded-4' style='border:4px solid yellow; color:yellow;'>";
                echo "<img class='rounded-3' src='products/{$row['image']}' alt='{$row['name']}' width='360' height='300'><br>";
                echo "<b class='fs-4'>{$row['name']}</b><br>";
                echo "Price: ₨ {$row['price']}<br>";
                echo "Category: {$row['category']}<br>";
                echo "<b class='text-info'>{$row['sale_status']}</b><br>";
                echo "<button class='border border-3 px-4 py-1 my-1 fw-bold' style='color:yellow;'>VIEW</button>";
                echo "</td>";
                $count++;
                if ($count % 4 == 0) {
                    echo "</tr>";
                }
            }
            if ($count % 4 != 0) {
                echo "</tr>";
            }
            echo "</table><br><br>";
        } else {
            echo "No results";
        }
        ?>
        <!-- End of Table showing 4 products per row -->

        <!-- Pagination Links includes current filter values to maintain filtering across the pages-->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if($curr_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $curr_page - 1 ?>&price_min=<?= $min ?>&price_max=<?= $max ?>&cat=<?= $cat ?>&sale=<?= $sale ?>"><</a>
                    </li>
                <?php endif; ?>
                <?php for($i=1;$i<=$total_pages;$i++): ?>
                    <li class="page-item <?= $i===$curr_page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&price_min=<?= $min ?>&price_max=<?= $max ?>&cat=<?= $cat ?>&sale=<?= $sale ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($curr_page<$total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $curr_page + 1 ?>&price_min=<?= $min ?>&price_max=<?= $max ?>&cat=<?= $cat ?>&sale=<?= $sale ?>">></a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- End of pagination-->
    </div>
</body>
</html>