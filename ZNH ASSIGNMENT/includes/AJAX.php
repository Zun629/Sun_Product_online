<?php
include_once "dataAccess.php";

$dataAccess = new DataAccess();

$query = isset($_GET['query']) ? $_GET['query'] : '';
    
if (!empty($query)) {
    $result = $dataAccess->search_Product($query);


    if (!empty($result)) {
        echo '<table class="table table-striped">';
        echo '<thead><tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Post Date</th>
                <th>Description</th>
                <th>Seller</th>
                <th>Category</th>
                <th>Status</th>
                <th>View</th>
              </tr></thead>';
        echo '<tbody>';
        
        foreach ($result as $results) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($results["ID"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["PRODUCT_NAME"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["PRICE"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["POST_DATE"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["DESCRIPTION"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["SELLER_ID"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["CATEGORY"]) . '</td>';
            echo '<td>' . htmlspecialchars($results["STATUS"]) . '</td>';
            echo '<td><a href="/ZNH ASSIGNMENT/views/product.php?id=' . urlencode($results["ID"]) . '">' . "See More" . '</a></td>';
            echo '</tr>';
        }
    
        echo '</tbody></table>';
    }
} else {
    echo json_encode([]);
}
