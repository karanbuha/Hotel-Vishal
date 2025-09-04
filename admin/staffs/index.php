<?php
	include '../../db.php';
	include '../../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
        <?php
        if (isset($_POST['add_staff'])) {
            $name = htmlspecialchars($_POST['name']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $number = htmlspecialchars($_POST['number']);
            $role = 'staff';

                $qry = "INSERT INTO users (
			        name,
			        username,
			        password,
			        number,
			        role
			    ) VALUES (
			        '$name',
			        '$username',
			        '$password',
			        '$number',
			        '$role'
			    )";

			    $res = mysqli_query($conn, $qry);
        }
        ?>
        <div class="row mb-5">
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="text" name="password" class="form-control" placeholder="password" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <input type="number" name="number" class="form-control" placeholder="number" >
                        </div>
                        <div class="btns_wrp col-12">
                            <button type="submit" name="add_staff" class="btn btn-primary">Add Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<?php
		$sql = "SELECT * FROM users WHERE `role`='staff'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
            echo "
                <div class='table_nums row'>
                <div class='col-12'>
                <table class='table table-striped table-responsive'>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>username</th>
                    <th>password</th>
                    <th>number</th>
                    <th>role</th>
                    <th>status</th>
                </tr>
            ";
			while($row = $result->fetch_assoc()) {
                $statusClass = ($row['status'] === 'active') ? 'active' : 'deactive';
                $checked = ($row['status'] === 'active') ? 'checked' : '';
                $statusLabel = ($row['status'] === 'active') ? 'active' : 'deactive';
                echo "
                    <tr>
                        <td><a href='edit.php?id={$row['id']}'>{$row['id']}</a></td>
                        <td>{$row['name']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['number']}</td>
                        <td>{$row['role']}</td>
                        <td>{$row['status']}</td>
                    </tr>
                ";
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

<?php
    include '../../footer.php';
?>