<?php
include '../../db.php';
include '../../header.php';

if ( isset($_GET['o_id']) ) {
    $o_id = $_GET['o_id'];
}
?>

<?php

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $o_id;
    $quantities = $_POST['quantity'];
    $status = 'pending';

    foreach ($quantities as $menu_item_id => $quantity) {
        if ($quantity > 0) {
            // Get price
            $stmt = $conn->prepare("SELECT price FROM menu_items WHERE id = ?");
            $stmt->bind_param("i", $menu_item_id);
            $stmt->execute();
            $stmt->bind_result($price);
            $stmt->fetch();
            $stmt->close();

            if ($price !== null) {
                $stmt = $conn->prepare("INSERT INTO order_items (staff_id,order_id, menu_item_id, quantity, price, status)
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiids", $id, $order_id, $menu_item_id, $quantity, $price, $status);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    echo "<p style='color: green;'>Order placed successfully with selected items.</p>";
}
?>

<div class="tables_main pt-3">
    <div class="container">
            
        <?php 
            $orderResult = $conn->query("SELECT * FROM orders WHERE id='$o_id' ");
            if ($orderResult->num_rows > 0) {
                echo "
                <div class='customer_order'>
                <h2>Add Items to Order</h2>
                ";
                while ($row = $orderResult->fetch_assoc()) {
                    $tID = $row['t_id'];
                    $cName = $row['c_name'];
                    $cNumber = $row['c_num'];
                    echo "
                    Table:- {$tID} <br>
                    Table:- {$cName} <br>
                    Table:- {$cNumber} <br>
                    ";
                }
                echo "
                </div>
                <div class='order_details'></div>
                ";
            }
        ?>

        <?php
        $itemTabs = $conn->query("SELECT cat, GROUP_CONCAT(en_name) as items FROM menu_items GROUP BY cat ");
        if ($itemTabs->num_rows > 0) {
            echo "
            <ul class='menu_tabs_list'>
            <li class='btn btn-outline-primary' data-aatr='all'>All</li>
            ";
            while ($row = $itemTabs->fetch_assoc()) {
                $rowCat = $row['cat'];
                echo "
                    <li class='btn btn-outline-primary' data-aatr='{$rowCat}'>{$rowCat}</li>
                ";
            }
            echo "
            </ul>
            ";
        }

        $itemResult = $conn->query("SELECT * FROM menu_items WHERE status='active' ");
        if ($itemResult->num_rows > 0) {
            echo "
            <div class='meni_list'>
            <form method='post' action=''>
            <input type='submit' value='Place Order' class='btn btn-primary'>
            <table class='table table-striped table-responsive'>
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Menu Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
            ";
            while ($row = $itemResult->fetch_assoc()) {
                $CatName = $row['cat'];
                $rowID = $row['id'];
                $menuItem = $row['en_name'];
                $price = number_format($row['price'], 2);
                echo "
                    <tr class='all {$CatName}'>
                        <td>{$CatName}</td>
                        <td>{$menuItem}</td>
                        <td>{$price}</td>
                        <td>
                            <input type='number' name='quantity[{$rowID}]' value='0' min='0'>
                        </td>
                    </tr>
                ";
            }
            echo "
            </tbody>
            </table>
            </form>
            </div>
            ";
        }
        ?> 
    </div>
</div>

<script>
	$(document).ready(function() {
        $('.menu_tabs_list li').click(function(){
            $attr = $(this).attr('data-aatr');
            $('.meni_list table tbody tr').attr('hidden','');
            $('.meni_list table tbody tr.'+$attr).removeAttr('hidden');
        })
	})
</script>


<script>
// Table structure ek vaar create karva mate
if ($(".order_details table").length === 0) {
    $(".order_details").html(`
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr id="subtotal_row">
                    <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                    <td><span id="subtotal_amount">0.00</span></td>
                </tr>
            </tfoot>
        </table>
    `);
}

$(document).on("input", "input[type=number]", function () {
    let qty = parseInt($(this).val());
    let row = $(this).closest("tr");

    let cat = row.find("td:eq(0)").text().trim();
    let item = row.find("td:eq(1)").text().trim();
    let price = parseFloat(row.find("td:eq(2)").text().trim());
    let id = $(this).attr("name");

    let total = (qty * price).toFixed(2);
    let existing = $(".order_details tbody").find("[data-id='" + id + "']");

    if (qty > 0) {
        let html = `
            <tr class="order_item" data-id="${id}" data-total="${total}">
                <td>${cat}</td>
                <td>${item}</td>
                <td>${qty}</td>
                <td>${price}</td>
                <td>${total}</td>
            </tr>
        `;

        if (existing.length > 0) {
            existing.replaceWith(html);
        } else {
            $(".order_details tbody").append(html);
        }
    } else {
        existing.remove();
    }

    // ✅ Subtotal calculate sahi tarike
    let subtotal = 0;
    $(".order_details tbody tr").each(function () {
        subtotal += parseFloat($(this).attr("data-total"));
    });
    $("#subtotal_amount").text(subtotal.toFixed(2));
});

</script>
