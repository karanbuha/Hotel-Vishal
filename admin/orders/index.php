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

                    $stmt = $conn->prepare("INSERT INTO orders (staff_id, t_id, c_name, c_num, status) VALUES (?,?,?,?,?)");
                    $stmt->bind_param("sssss", $id, $t_id, $c_name, $c_num, $status);
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
                $sql = "SELECT * FROM orders WHERE t_id = $t_id AND status = 'pending' ";
                // $sql = "SELECT * FROM orders WHERE t_id = $t_id ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "
                        <div class='row flex-wrap align-items-start'>
                    ";
                    while ($row = $result->fetch_assoc()) {?>
                    <div class='col col-sm-6 overflow-auto'>
                        <table class='table table-striped table-responsive' >
                            <tr>
                                <!-- <a href='place_order.php?o_id={$row['id']}'>Add Order</a> -->
                                <th colspan="6" cellpadding="10">
                                    <?php 
                                        echo "
                                        Name: {$row['c_name']} (M: {$row['c_num']}) <br>
                                        Date. {$row['date']} <br> Dine In: {$t_id} - Order. #{$row['id']} <br>
                                        
                                        ";
                                        if($row['status'] == 'pending'){
                                            echo "
                                            <a href='place_order.php?o_id={$row['id']}'>Add Order</a> <br>
                                            ";
                                        }
                                    ?>
                                    <label class="switch <?= $row['status'] === 'paid' ? 'paid' : 'pending' ?>">
                                        <input type="checkbox" class="bill_generate" 
                                            data-orderid="<?= $row['id'] ?>" 
                                            <?= $row['status'] === 'paid' ? 'checked' : '' ?>>
                                        <span class="slider"></span>
                                        <span class="status-label text-nowrap">
                                            bill <?= $row['status'] === 'paid' ? 'paid' : 'pending' ?>
                                        </span>
                                    </label>
                                </th>
                            </tr>

                            <tr>
                                <th>item</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>amount</th>
                                <th>status</th>
                                <?php if($row['status'] == 'pending'){echo "<th>action</th>";} ?>
                                
                            </tr>

                                <?php
                                    $order_id = $row['id'];
                                    $sql_items = "SELECT oi.id, mi.en_name, oi.quantity, oi.price, (oi.quantity * oi.price) AS amount, oi.status FROM order_items oi JOIN menu_items mi ON oi.menu_item_id = mi.id WHERE oi.order_id = $order_id ";

                                    $result_items = $conn->query($sql_items);
                                    $total_qty = 0;
                                    $sub_total = 0;
                                    
                                ?>

                                <tbody>
                                <?php while ($item = $result_items->fetch_assoc()): ?>
                                    <tr data-id="<?= number_format($item['id']) ?>">
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
                                        <?php if($row['status'] == 'pending'){?>
                                                <td>
                                                    <button type='button' class='btn btn-primary delete-btn' >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"></path></svg>
                                                    </button>
                                                </td>
                                        <?php } ?>
                                    </tr>
                                    <?php 
                                        $total_qty += $item['quantity'];
                                        $sub_total += $item['amount'];
                                    ?>
                                <?php endwhile; ?>
                                </tbody>

                                <?php
                                    // $cgst = round($sub_total * 0.025, 2);
                                    // $sgst = round($sub_total * 0.025, 2);
                                    // $grand_total = $sub_total + $cgst + $sgst;
                                    $cgst = round($sub_total * $row['cgst'] / 100, 2);
                                    $sgst = round($sub_total * $row['sgst'] / 100, 2);
                                    $grand_total = $sub_total + $cgst + $sgst;
                                ?>

                                <tfoot>
                                    <tr class="table-primary">
                                        <td>Total Qty</td>
                                        <td><?= $total_qty ?></td>
                                        <td>Sub Total</td>
                                        <td>₹<?= number_format($sub_total, 2) ?></td>
                                        <td></td>
                                        <?php if($row['status'] == 'pending'){echo "<td></td>";} ?>
                                    </tr>
                                    <?php if($row['cgst']>0){?>
                                        <tr class="">
                                            <td></td>
                                            <td>CGST</td>
                                            <td><?= $row['cgst'] ?>%</td>
                                            <td>₹<?= number_format($cgst, 2) ?></td>
                                            <td></td>
                                            <?php if($row['status'] == 'pending'){echo "<td></td>";} ?>
                                        </tr>
                                    <?php }?>
                                    <?php if($row['sgst']>0){?>
                                    <tr class="">
                                        <td></td>
                                        <td>SGST</td>
                                        <td><?= $row['sgst'] ?>%</td>
                                        <td>₹<?= number_format($sgst, 2) ?></td>
                                        <td></td>
                                        <?php if($row['status'] == 'pending'){echo "<td></td>";} ?>
                                    </tr>
                                    <?php }?>
                                    <?php if($row['cgst']>0 | $row['sgst']>0){?>
                                    <tr class="table-success">
                                        <th class="text-right" colspan="3">Grand Total</th>
                                        <th>₹<?= number_format($grand_total, 2) ?></th>
                                        <td></td>
                                        <?php if($row['status'] == 'pending'){echo "<td></td>";} ?>
                                    </tr>
                                    <?php }?>
                                </tfoot>
                        </table>
                    </div>
                    <?php }
                    echo "</div>";
                } else {
                    echo "<p>No data found</p>";
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

    $(document).on('click', '.delete-btn', function () {
        if (!confirm("Are you sure you want to delete this item?")) return;

        let row = $(this).closest('tr');
        let itemId = row.data('id');

        $.ajax({
            url: 'delete-order-item.php',
            type: 'POST',
            data: { id: itemId },
            success: function (response) {
                if (response === 'success') {
                    row.remove(); // remove row from UI
                } else {
                    alert("Failed to delete item.");
                }
            },
            error: function () {
                alert("Server error.");
            }
        });
    });

$(document).on('change', '.bill_generate', function () {
    let checkbox = $(this);
    let orderId = checkbox.data('orderid');
    let newStatus = checkbox.is(':checked') ? 'paid' : 'pending';

    $.ajax({
        url: 'update-bill-status.php',
        method: 'POST',
        data: {
            id: orderId,
            status: newStatus
        },
        success: function(response) {
            if(response === 'success') {
                checkbox.siblings('.status-label').text('bill ' + newStatus);
            } else {
                alert('Update failed.');
                checkbox.prop('checked', !checkbox.is(':checked')); // undo checkbox
            }
        },
        error: function() {
            alert('Server error.');
            checkbox.prop('checked', !checkbox.is(':checked')); // undo checkbox
        }
    });
});

});
</script>

<?php
    include '../../footer.php';
?>