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
                    <th>date</th>
                </tr>
            ";
			while($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['cat']}</td>
                        <td>{$row['gu_name']}</td>
                        <td>{$row['en_name']}</td>
                        <td>{$row['price']}</td>
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

<?php
    include '../../footer.php';
?>