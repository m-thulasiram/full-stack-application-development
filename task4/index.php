<?php
$conn = new mysqli("localhost","root","","ecommerce");

if($conn->connect_error){
    die("Database Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT c.name, p.product_name, o.quantity, o.total_amount, o.order_date
        FROM Orders o
        JOIN Customers c ON o.customer_id = c.customer_id
        JOIN Products p ON o.product_id = p.product_id
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Order History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Customer Order History</h2>

    <!-- 🔍 Search Box -->
    <input type="text" id="searchInput" placeholder="Search by name..." onkeyup="searchTable()">

    <table>
        <tr>
            <th>Name</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total = number_format($row['total_amount'], 2);
                $date = date("d M Y", strtotime($row['order_date']));

                echo "<tr>
                        <td data-label='Name'>{$row['name']}</td>
                        <td data-label='Product'>{$row['product_name']}</td>
                        <td data-label='Quantity'>{$row['quantity']}</td>
                        <td data-label='Total'>₹{$total}</td>
                        <td data-label='Date'>{$date}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='no-data'>No Orders Found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

<!-- 🔍 Search Script -->
<script>
function searchTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        if(index === 0) return;
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
}
</script>

</body>
</html>