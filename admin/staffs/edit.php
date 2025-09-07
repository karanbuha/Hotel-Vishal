<?php
	include '../../db.php';
	include '../../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $qry="SELECT * FROM users where id='$id' ";
                $res=mysqli_query($conn,$qry);
                $row=mysqli_fetch_object($res);

                $name= $row->name;
                $username= $row->username;
                $password= $row->password;
                $number= $row->number;
                $role= $row->role;
                $status= $row->status;
            }

            if(isset($_POST['update'])){
                $name=$_POST['name'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $number=$_POST['number'];
                $status=$_POST['status'];

                $qry="UPDATE users SET
                    `name`='$name',
                    `username`='$username',
                    `password`='$password',
                    `number`='$number',
                    `status`='$status'
                where id='$id'";
                $res=mysqli_query($conn,$qry);
                // header('Refresh:1');
                header('Location: ./');
            }
		?>
        <div class="row mb-5">
            <div class="col-12">
                <h2>Edit (<?php echo $name ?>) details</h2>
            </div>
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $password ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>number</label>
                            <input type="number" name="number" class="form-control" value="<?php echo $number ?>" >
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>status</label>
                            <select name="status" class="form-control">
                                <option value="active" <?php if($status== "active"){echo "selected";} ?>>active</option>
                                <option value="deactive" <?php if($status== "deactive"){echo "selected";} ?>>deactive</option>
                                <option value="delete" <?php if($status== "delete"){echo "selected";} ?>>delete</option>
                            </select>
                        </div>
                        <div class="btns_wrp col-12">
                            <button type="submit" name="update" class="btn btn-primary">Update Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
<div>

<?php
    include '../../footer.php';
?>