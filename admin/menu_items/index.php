<?php
	include '../../db.php';
	include '../../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
        <?php
        if (isset($_POST['add_menu'])) {
            $cat = htmlspecialchars($_POST['cat']);
            $gu_name = htmlspecialchars($_POST['gu_name']);
            $en_name = htmlspecialchars($_POST['en_name']);
            $price = htmlspecialchars($_POST['price']);
            $status = 'active';

                $qry = "INSERT INTO menu_items (
			        cat,
			        gu_name,
			        en_name,
			        price,
			        status
			    ) VALUES (
			        '$cat',
			        '$gu_name',
			        '$en_name',
			        '$price',
			        '$status'
			    )";
			    $res = mysqli_query($conn, $qry);
                header('Refresh:1');
        }
        ?>
        <div class="row mb-5">
            <div class="col-12">
                <h2>Add new menu</h2>
            </div>
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="cat" class="form-control" placeholder="category" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="gu_name" class="form-control" placeholder="gujarati name" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="en_name" class="form-control" placeholder="english name" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="number" name="price" class="form-control" placeholder="price" >
                        </div>
                        <div class="btns_wrp col-12">
                            <button type="submit" name="add_menu" class="btn btn-primary">Add Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<?php
		$sql = "SELECT * FROM menu_items order by id desc";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            echo "
            <div class='table_nums row'>
            <div class='col-12'>
                    <h2>Menu list</h2>
                </div>
            <div class='col-12'>
                <table class='table table-striped table-responsive'>
                <tr>
                    <th>#</th>
                    <th>category</th>
                    <th>GU name</th>
                    <th>EN name</th>
                    <th>price</th>
                    <th>status</th>
                    </tr>
                    ";
                    // <th>date</th>
			while($row = $result->fetch_assoc()) {
                $statusClass = ($row['status'] === 'active') ? 'active' : 'deactive';
                $checked = ($row['status'] === 'active') ? 'checked' : '';
                $statusLabel = ($row['status'] === 'active') ? 'active' : 'deactive';
                echo "
                    <tr id='{$row['id']}'>
                        <td><a href='edit.php?id={$row['id']}'>{$row['id']}</a></td>
                        <td>{$row['cat']}</td>
                        <td>{$row['gu_name']}</td>
                        <td>{$row['en_name']}</td>
                        <td>{$row['price']}</td>
                        <td>
                            <label class='switch {$statusClass}'>
                                <input type='checkbox' class='menu_status' data-orderid='{$row['id']}' {$checked}>
                                <span class='slider'></span>
                                <span class='status-label text-nowrap' hidden>{$statusLabel}</span>
                            </label>
                        </td>
                        </tr>
                        ";
                        // <td>{$row['date']}</td>
			}

			echo '</table>';
			echo '</div>';
            echo '</div>';
		} else {
			echo "No data found";
		}
		?>
	</div>
</div>
    
<script>
$(document).on("change", ".menu_status", function () {
    let id = $(this).data("orderid");   // row id
    let status = $(this).is(":checked") ? "active" : "deactive"; // new status
    let label = $(this).closest("label").find(".status-label");

    $.ajax({
        url: "update_menu_status.php",
        type: "POST",
        data: { id: id, status: status },
        success: function (res) {
            console.log("Server Response:", res);  // 👈 log karo
            if (res.trim() === "success") {
                // label.text(status);
                label.closest("label").removeClass("active deactive").addClass(status);
            } else {
                alert("Error updating status! " + res); // 👈 actual error show karo
            }
        }
    });

});
</script>

<?php
    include '../../footer.php';
?>