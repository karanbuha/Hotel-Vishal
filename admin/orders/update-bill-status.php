<?php
include '../../db.php'; // Database connection

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'] === 'paid' ? 'paid' : 'pending'; // sanitize

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

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
