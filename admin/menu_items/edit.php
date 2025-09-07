<?php
	include '../../db.php';
	include '../../header.php';
?>

<div class="tables_main pt-3">
	<div class="container">
        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $qry="SELECT * FROM menu_items where id='$id' ";
                $res=mysqli_query($conn,$qry);
                $row=mysqli_fetch_object($res);

                $cat= $row->cat;
                $gu_name= $row->gu_name;
                $en_name= $row->en_name;
                $price= $row->price;
                $status= $row->status;
            }

            if(isset($_POST['update'])){
                $cat=$_POST['cat'];
                $gu_name=$_POST['gu_name'];
                $en_name=$_POST['en_name'];
                $price=$_POST['price'];

                $qry="UPDATE menu_items SET
                    `cat`='$cat',
                    `gu_name`='$gu_name',
                    `en_name`='$en_name',
                    `price`='$price'
                where id='$id'";
                $res=mysqli_query($conn,$qry);
                // header('Refresh:1');
                header('Location: ./');
            }
		?>
        <div class="row mb-5">
            <div class="col-12">
                <h2>Edit (<?php echo $en_name ?>) details</h2>
            </div>
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>category</label>
                            <input type="text" name="cat" class="form-control" value="<?php echo $cat ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>gujarati name</label>
                            <input type="text" name="gu_name" class="form-control" value="<?php echo $gu_name ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>english name</label>
                            <input type="text" name="en_name" class="form-control" value="<?php echo $en_name ?>" required="">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label>price</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $price ?>" >
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