<?php
include '../../db.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = ($_POST['status'] === 'active') ? 'active' : 'deactive';

    $qry = "UPDATE menu_items SET status='$status' WHERE id='$id'";

    if (mysqli_query($conn, $qry)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn); // 👈 actual error show
    }
} else {
    echo "invalid post data";
}
?>
