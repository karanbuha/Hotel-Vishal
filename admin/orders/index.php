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
        <?php if($t_id>0){?>
            <label class="switch">
                <input type="checkbox" id="statusCheckbox" <?php echo $checked; ?> data-tid="<?php echo $t_id; ?>">
                <span class="slider"></span>
                <span class="label label1">Table is not available</span>
                <span class="label label2">Table is available</span>
            </label>
        <?php } ?>
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
                    header('Refresh:1');
                }

            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="c_name" class="form-control" placeholder="Customer Name" required>
                </div>
                <div class="form-group">
                    <input type="number" name="c_num" class="form-control" placeholder="Customer Number">
                </div>
                <button type="submit" name="customer_order" class="btn btn-primary">Add Details</button>
            </form>
        </div>

        <div id="table_orders"><p>No data found</p></div>

    </div>
<div>
<script>
    function loadOrders() {
        $.get("update_table_orders.php", { t_id: "<?php echo $t_id; ?>" }, function(data) {
            $("#table_orders").html(data);
        });
    }
    loadOrders();
    setInterval(loadOrders, 5000);

$(document).on('change', '.statusCheckbox', function() {
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

    $(document).on('change', '.orderStatus', function() {
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

</script>

<?php
    include '../../footer.php';
?>