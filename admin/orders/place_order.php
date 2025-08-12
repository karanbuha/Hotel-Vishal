<?php
include '../../db.php';
include '../../header.php';

if ( isset($_GET['o_id']) ) {
    $o_id = $_GET['o_id'];
}
?>

<?php

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $o_id;
    $quantities = $_POST['quantity'];
    $status = 'pending';

    foreach ($quantities as $menu_item_id => $quantity) {
        if ($quantity > 0) {
            // Get price
            $stmt = $conn->prepare("SELECT price FROM menu_items WHERE id = ?");
            $stmt->bind_param("i", $menu_item_id);
            $stmt->execute();
            $stmt->bind_result($price);
            $stmt->fetch();
            $stmt->close();

            if ($price !== null) {
                $stmt = $conn->prepare("INSERT INTO order_items (staff_id,order_id, menu_item_id, quantity, price, status)
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiids", $id, $order_id, $menu_item_id, $quantity, $price, $status);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    echo "<p style='color: green;'>Order placed successfully with selected items.</p>";
}


$orderResult = $conn->query("SELECT * FROM orders WHERE id='$o_id' ");
$orders = [];
while ($row = $orderResult->fetch_assoc()) {
    $orders[] = $row;
}

$itemResult = $conn->query("SELECT id, en_name, price FROM menu_items");
$items = [];
while ($row = $itemResult->fetch_assoc()) {
    $items[] = $row;
}
?>

<?php foreach ($orders as $order): ?>

<h2>Add Items to Order</h2>

<?= 'Table:' . $order['t_id']; ?> <br>
<?= 'Name:-' . $order['c_name']; ?> <br>
<?= 'Mobile:-' . $order['c_num']; ?> <br>

<?php endforeach; ?>


<form method="post" action="">

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Menu Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>


        <?php
         foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['en_name']) ?></td>
                <td>₹<?= number_format($item['price'], 2) ?></td>
                <td>
                    <input type="number" name="quantity[<?= $item['id'] ?>]" value="0" min="0">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <input type="submit" value="Place Order">
</form>
