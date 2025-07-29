<?php
include '../../db.php';
include '../../header.php';

if ( isset($_GET['i_id']) ) {
    $t_id = $_GET['i_id'];
}

$checked = '';
$sql = "SELECT * FROM tables WHERE t_num = $t_id LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['status'] == 'not_available') {
    $checked = "checked";
}
?>



<div class="tables_main pt-3">
    <div class="container">

        <label class="switch">
            <input type="checkbox" id="statusCheckbox" <?php echo $checked; ?> data-tid="<?php echo $t_id; ?>">
            <span class="slider"></span>
            <span class="label label1">Table is not available</span>
            <span class="label label2">Table is available</span>
        </label>
        <div class="mb-4"></div>

        <div class="customer_details mb-3">
            <?php
                if (isset($_POST['customer_order'])) {
                    $c_name = $_POST['c_name'];
                    $c_num = $_POST['c_num'];
                    $status = 'pending';

                    $stmt = $conn->prepare("INSERT INTO orders (t_id, c_name, c_num, status) VALUES (?,?,?,?)");
                    $stmt->bind_param("ssss", $t_id, $c_name, $c_num, $status);
                    if ($stmt->execute()) {
                        echo "Order inserted successfully.";
                    } else {
                        echo "Error inserting order: " . $stmt->error;
                    }

                }

            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="c_name" class="form-control" placeholder="Customer Name" required>
                </div>
                <div class="form-group">
                    <input type="number" name="c_num" class="form-control" placeholder="Customer Number" required>
                </div>
                <button type="submit" name="customer_order" class="btn btn-primary">Add Details</button>
            </form>
        </div>

        <div class="customer_order_details">
            <?php
                $sql = "SELECT * FROM orders WHERE t_id = $t_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "
                        <table border='1' cellpadding='6' >
                    ";
                    while ($row = $result->fetch_assoc()) {?>
                            <tr>
                                <!-- <a href='place_order.php?o_id={$row['id']}'>Add Order</a> -->
                                <th colspan="5" cellpadding="10">
                                    <?php 
                                        echo "
                                        Name: {$row['c_name']} (M: {$row['c_num']}) <br>
                                        Date. {$row['date']} <br> Dine In: {$t_id}
                                        ";
                                    ?>
                                </th>
                            </tr>

                            <tr>
                                <th>item</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>ammount</th>
                                <th>status</th>
                            </tr>

                                    <?php
                                    $order_id = $row['id'];
                                   $sql_items = "
    SELECT 
        oi.id,
        mi.en_name, 
        oi.quantity, 
        oi.price, 
        (oi.quantity * oi.price) AS amount,
        oi.status
    FROM order_items oi
    JOIN menu_items mi ON oi.menu_item_id = mi.id
    WHERE oi.order_id = $order_id
";


                                    $result_items = $conn->query($sql_items);
                                    $total_qty = 0;
                                    $sub_total = 0;
                                    
                                    ?>

                                    <tbody>
                                    <?php while ($item = $result_items->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['en_name']) ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= number_format($item['price'], 2) ?></td>
                                            <td><?= number_format($item['amount'], 2) ?></td>
                                            <td width="100">
                                                 <label class="switch">
                                                    <input type="checkbox" class="orderStatus" 
                                                        data-itemid="<?= $item['id'] ?>" 
                                                        <?= $item['status'] === 'delivered' ? 'checked' : '' ?>>
                                                    <span class="slider"></span>
                                                    <span class="status-label">
                                                        <?= $item['status'] === 'delivered' ? 'delivered' : 'pending' ?>
                                                    </span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php 
                                            $total_qty += $item['quantity'];
                                            $sub_total += $item['amount'];
                                        ?>
                                    <?php endwhile; ?>
                                    </tbody>

                                    <?php
                                        $cgst = round($sub_total * 0.025, 2);
                                        $sgst = round($sub_total * 0.025, 2);
                                        $grand_total = $sub_total + $cgst + $sgst;
                                    ?>

                                    <tfoot>
                                        <tr>
                                            <td>Total Qty</td>
                                            <td><?= $total_qty ?></td>
                                            <td>Sub Total</td>
                                            <td>₹<?= number_format($sub_total, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>CGST</td>
                                            <td>2.5%</td>
                                            <td>₹<?= number_format($cgst, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>SGST</td>
                                            <td>2.5%</td>
                                            <td>₹<?= number_format($sgst, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total</th>
                                            <th colspan="3">₹<?= number_format($grand_total, 2) ?></th>
                                        </tr>
                                    </tfoot>

                              
                        
                    <?php }
                    echo "</table>";
                } else {
                    echo "<p>Customer order not placed.</p>";
                }
            ?>
        </div>

    </div>
<div>
<script>
$(document).ready(function() {
  $('#statusCheckbox').change(function() {
    var isChecked = $(this).is(':checked') ? 'not_available' : 'available';
    var t_id = $(this).data('tid');

    $.ajax({
      url: 'table_update_status.php',  // This will be the PHP file handling update
      method: 'POST',
      data: { t_id: t_id, status: isChecked },
      success: function(response) {
        // alert('Status updated successfully!');
      },
      error: function() {
        // alert('Failed to update status.');
      }
    });
  });

$('.orderStatus').change(function() {
    var checkbox = $(this);
    var status = checkbox.is(':checked') ? 'delivered' : 'pending';
    var item_id = checkbox.data('itemid');

    $.ajax({
        url: 'update_item_status.php',
        type: 'POST',
        data: {
            item_id: item_id,
            status: status
        },
        success: function(response) {
            console.log(response);
            // Update label text
            checkbox.closest('label').find('.status-label').text(status);
        },
        error: function() {
            alert("Failed to update item status.");
        }
    });
});

});
</script>

<?php
    include '../../footer.php';
?>