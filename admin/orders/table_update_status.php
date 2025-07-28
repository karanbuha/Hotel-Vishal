<?php
// update_status.php
include '../../db.php'; // Your database connection file

if (isset($_POST['t_id']) && isset($_POST['status'])) {
    $t_id = intval($_POST['t_id']);
    $status = $_POST['status'];

    // Validate $status if necessary (e.g., only allow 'available' or 'not_available')

    $stmt = $conn->prepare("UPDATE tables SET status = ? WHERE t_num = ?");
    $stmt->bind_param("si", $status, $t_id);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        http_response_code(500);
        echo "Error updating status";
    }
    $stmt->close();
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>
