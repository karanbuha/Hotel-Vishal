        <div class="customer_order_details">
            <?php
                $sql = "SELECT * FROM orders WHERE t_id = $t_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class='customer_order_list'>";
                    while ($row = $result->fetch_assoc()) {?>
                        <div class="customer_orders">
                            <address class="bill_address">
                                Hotel Vishal <br>
                                opp. Mamlatdar kacheri, <br>
                                At Liliya Mota, <br>
                                Gujarat 365535 <br>
                                Mo. 1234567890
                            </address>
                            <?php echo "<div class='bill_name'>Name: {$row['c_name']} (M: {$row['c_num']}) <a href='place_order.php?o_id={$row['id']}'>Add Order</a></div>"; ?>
                            <div class="hotel_info">
                                <table>
                                    <tr>
                                        <td>Date. <?php echo $row['date']; ?></td>
                                        <td><?php echo "<strong>Dine In: {$t_id}</strong>"; ?>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="item_details">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>item</th>
                                            <th>qty</th>
                                            <th>price</th>
                                            <th>ammount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $order_id = $row['id'];
                                    $sql_items = "
                                        SELECT mi.en_name, oi.quantity, oi.price, (oi.quantity * oi.price) AS amount
                                        FROM order_items oi
                                        JOIN menu_items mi ON oi.menu_item_id = mi.id
                                        WHERE oi.order_id = $order_id
                                    ";

                                    $result_items = $conn->query($sql_items);
                                    $total_qty = 0;
                                    $sub_total = 0;
                                    ?>

                                    <tbody>
                                    <?php while ($item = $result_items->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['en_name']) ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= number_format($item['price'], 2) ?></td>
                                            <td><?= number_format($item['amount'], 2) ?></td>
                                        </tr>
                                        <?php 
                                            $total_qty += $item['quantity'];
                                            $sub_total += $item['amount'];
                                        ?>
                                    <?php endwhile; ?>
                                    </tbody>

                                    <?php
                                        $cgst = round($sub_total * 0.025, 2);
                                        $sgst = round($sub_total * 0.025, 2);
                                        $grand_total = $sub_total + $cgst + $sgst;
                                    ?>

                                    <tfoot>
                                        <tr>
                                            <td>Total Qty</td>
                                            <td><?= $total_qty ?></td>
                                            <td>Sub Total</td>
                                            <td>₹<?= number_format($sub_total, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>CGST</td>
                                            <td>2.5%</td>
                                            <td>₹<?= number_format($cgst, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>SGST</td>
                                            <td>2.5%</td>
                                            <td>₹<?= number_format($sgst, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total</th>
                                            <th colspan="3">₹<?= number_format($grand_total, 2) ?></th>
                                        </tr>
                                    </tfoot>

                                </table>
                                <address>
                                    FSSAI Lic No. 10724026000972 <br>
                                    Thanks & Visit Again <br>
                                    GSTN: 24ARHPP9062B1ZU
                                </address>
                            </div>
                        </div>
                        
                    <?php }
                    echo "</div>";
                } else {
                    echo "<p>No data found</p>";
                }
            ?>
        </div>