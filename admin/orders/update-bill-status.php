<?php
include '../../db.php'; // Database connection

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'] === 'paid' ? 'paid' : 'pending'; // sanitize

    // Calculate the sub_total by summing the 'total' from order_items
    $stmt_items = $conn->prepare("SELECT SUM(total) AS sub_total FROM order_items WHERE order_id = ?");
    $stmt_items->bind_param("i", $id);
    $stmt_items->execute();
    $stmt_items->bind_result($sub_total);
    $stmt_items->fetch();
    $stmt_items->close();

    // Now update the 'orders' table with the new status and sub_total
    $stmt = $conn->prepare("UPDATE orders SET status = ?, sub_total = ? WHERE id = ?");
    $stmt->bind_param("sdi", $status, $sub_total, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "invalid";
}
?>
