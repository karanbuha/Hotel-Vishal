<?php
include '../../db.php';

if (isset($_POST['item_id']) && isset($_POST['status'])) {
    $item_id = intval($_POST['item_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE order_items SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $item_id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
