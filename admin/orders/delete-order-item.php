<?php
include '../../db.php'; // Database connection

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // SQL Query
    $stmt = $conn->prepare("DELETE FROM order_items WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "no_id";
}
?>