<?php
	include '../db.php';
	include '../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
		<?php
		$sql = "SELECT * FROM tables";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<div class="table_nums row">';
			while($row = $result->fetch_assoc()) {
				$available_is = '';
				if($row['status'] == 'available'){
					$available_is = 'available';
					$ava_txt = 'ખાલી (Available)';
				}elseif($row['status'] == 'not_available'){
					$available_is = 'not_available';
					$ava_txt = 'ભરેલું (Not Available)';
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

<?php
    include '../footer.php';
?>