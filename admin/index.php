<?php
	include '../db.php';
	include '../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
<?php
$filename = "../menu.csv";
if (($handle = fopen($filename, "r")) !== false) {
    $i=1;
    echo " <form>  <table> ";
    while (($row = fgetcsv($handle)) !== false) {
        echo "
            <tr data-id='{$i}'>
                <td><input type='text' name='cat' value='{$row[0]}' ></td>
                <td><input type='text' name='gu_name' value='{$row[1]}' ></td>
                <td><input type='text' name='en_name' value='{$row[2]}' ></td>
                <td><input type='text' name='price' value='{$row[3]}' ></td>
            </tr>
            ";
            $i++;

        // $sql = "INSERT INTO menu_items (cat, gu_name, en_name, price) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]')";
        // mysqli_query($conn, $sql);
    }
    echo "</table></form>";
    fclose($handle);
} else {
    echo "Error: Unable to open file.";
}
?>

		<?php
		$sql = "SELECT * FROM tables";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<div class="table_nums row">';
			while($row = $result->fetch_assoc()) {
				$available_is = '';
				if($row['status'] == 'available'){
					$available_is = 'available';
					// $ava_txt = 'ખાલી (Available)';
					$ava_txt = 'Available';
				}elseif($row['status'] == 'not_available'){
					$available_is = 'not_available';
					// $ava_txt = 'ભરેલું (Not Available)';
					$ava_txt = 'Not Available';
				}
			?>
				<div class="table_num <?php echo $available_is ?> col-6 col-sm-4 mb-3 mb-md-3 px-2 px-sm-2">
					<a href="<?php echo $admin.'orders/?i_id='.$row['t_num'] ?>" class="tables_item_wrp text-decoration-none">
						<?php echo '<span>Table '.$row['t_num'] .'</span>'; ?>
						<?php
							echo '<div>' . $ava_txt . '</div>';
						?>
					</a>
				</div>
			<?php }
			echo '</div>';
		} else {
			echo "No Table here";
		}
		?>
	</div>
<div>
<?php if($web == ''){?>
	<div class="display_table" id="fetch_table"></div>
<script>
function loadTables() {
    $.ajax({
        url: "<?php echo rtrim($web, '/'); ?>/API/tables.php",
        method: "GET",
        dataType: "json",
        success: function(response) {
            let html = '<div class="table_nums row">';
            
            // Array actual response.data છે
            response.data.forEach(function(row) {
                let available_is = '';
                let ava_txt = '';

                if (row.status === 'available') {
                    available_is = 'available';
                    ava_txt = 'ખાલી (Available)';
                } else if (row.status === 'not_available') {
                    available_is = 'not_available';
                    ava_txt = 'ભરેલું (Not Available)';
                }

                html += `
                    <div class="table_num ${available_is} col-6 col-sm-4 mb-3 mb-md-3 px-2 px-sm-2">
                        <a href="<?php echo $admin; ?>orders/?i_id=${row.t_num}" class="tables_item_wrp text-decoration-none">
                            <span>Table ${row.t_num}</span>
                            <div>${ava_txt}</div>
                        </a>
                    </div>
                `;
            });

            html += '</div>';
            $("#fetch_table").html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data:", error);
            console.log("Raw response:", xhr.responseText);
        }
    });
}
loadTables();
setInterval(loadTables, 2000);
</script> 
<?php } ?>

<?php
    include '../footer.php';
?>