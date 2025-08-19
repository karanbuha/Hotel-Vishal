<?php
	include '../../db.php';
	include '../../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
		<?php
		$sql = "SELECT * FROM menu_items";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            echo "
                <div class='table_nums row'>
                <table class='table table-striped table-responsive'>
                <tr>
                    <th>#</th>
                    <th>cat</th>
                    <th>gu_name</th>
                    <th>en_name</th>
                    <th>price</th>
                    <th>status</th>
                    <th>date</th>
                </tr>
            ";
			while($row = $result->fetch_assoc()) {
                $statusClass = ($row['status'] === 'active') ? 'active' : 'deactive';
                $checked = ($row['status'] === 'active') ? 'checked' : '';
                $statusLabel = ($row['status'] === 'active') ? 'active' : 'deactive';
                echo "
                    <tr id='{$row['id']}'>
                        <td>{$row['id']}</td>
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
                        <td>{$row['date']}</td>
                    </tr>
                ";
			}

			echo '</table>';
			echo '</div>';
		} else {
			echo "No data found";
		}
		?>
	</div>
<div>
    
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