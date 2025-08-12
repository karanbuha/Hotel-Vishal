
    <?php
        header('Content-Type: application/json');
        include 'db.php';
        if (isset($_GET['orders']) && $_GET['orders'] == 'orders') {
    $res = mysqli_query($conn, "SELECT * FROM orders");
    $orders = [];

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            // Fetch related items
            $items_res = mysqli_query(
                $conn,
                "SELECT * FROM order_items WHERE order_id = '".$row['id']."'"
            );
            $items = [];

            if (mysqli_num_rows($items_res) > 0) {
                while ($item = mysqli_fetch_assoc($items_res)) {
                    $items[] = [
                        'id' => $item['id'],
                        'staff_id' => $item['staff_id'],
                        'order_id' => $item['order_id'],
                        'menu_item_id' => $item['menu_item_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total' => $item['total'],
                        'status' => $item['status'],
                        'date' => $item['date']
                    ];
                }
            }

            // Push order with items into main array
            $orders[] = [
                'id' => $row['id'],
                'staff_id' => $row['staff_id'],
                't_id' => $row['t_id'],
                'c_name' => $row['c_name'],
                'c_num' => $row['c_num'],
                'status' => $row['status'],
                'sub_total' => $row['sub_total'],
                'cgst' => $row['cgst'],
                'sgst' => $row['sgst'],
                'grand_total' => $row['grand_total'],
                'date' => $row['date'],
                'items' => $items
            ];
        }

        echo json_encode([
            'total' => count($orders),
            'data' => $orders
        ], JSON_PRETTY_PRINT);

    } else {
        echo json_encode([
            'total' => 0,
            'data' => []
        ]);
    }
}

        
    ?>