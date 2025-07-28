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
                    echo "<div class='customer_order_list'>";
                    while ($row = $result->fetch_assoc()) {?>
                        <div class="customer_orders">
                            <address class="bill_address">
                                Hotel Vishal <br>
                                opp. Mamlatdar kacheri, <br>
                                At Liliya Mota, <br>
                                Gujarat 365535 <br>
                                Mo. 1234567890
                            </address>
                            <?php echo "<div class='bill_name'>Name: {$row['c_name']} (M: {$row['c_num']}) <a href='place_order.php?o_id={$row['id']}'>Add Order</a></div>"; ?>
                            <div class="hotel_info">
                                <table>
                                    <tr>
                                        <td>Date. <?php echo $row['date']; ?></td>
                                        <td><?php echo "<strong>Dine In: {$t_id}</strong>"; ?>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="item_details">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>item</th>
                                            <th>qty</th>
                                            <th>price</th>
                                            <th>ammount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $order_id = $row['id'];
                                    $sql_items = "
                                        SELECT mi.en_name, oi.quantity, oi.price, (oi.quantity * oi.price) AS amount
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

                                </table>
                                <address>
                                    FSSAI Lic No. 10724026000972 <br>
                                    Thanks & Visit Again <br>
                                    GSTN: 24ARHPP9062B1ZU
                                </address>
                            </div>
                        </div>
                        
                    <?php }
                    echo "</div>";
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
});
</script>
</body>
</html>
