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
        
        <div id="table_list"></div>

	</div>
<div>
    
<script>
    function loadTables(){
        $.ajax({
            url: "table_update.php",
            type: "GET",
            success: function(data){
                $("#table_list").html(data); // HTML direct replace
            }
        });
    }
    loadTables();
    setInterval(loadTables, 2000);
</script> 


<?php
    include '../footer.php';
?>