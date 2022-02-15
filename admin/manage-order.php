<?php include('partials/menu.php');?>


<div class="container my-5">
<h1 class="mb-5">Manage Order</h1>
    <div class="row">
        <div class="col-lg-12">
            <table class="table text-center table-dark">
                <thead>
                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Address</th>
                    <th scope="col">Pay Method</th>
                    <th scope="col">Orders</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query="SELECT * FROM `tbl_order`";
                    $user_result=mysqli_query($conn,$query);
                    while($user_fetch=mysqli_fetch_assoc($user_result)){
                        echo"
                            <tr>
                                <td>$user_fetch[order_id]</td>
                                <td>$user_fetch[username]</td>
                                <td>$user_fetch[phone_no]</td>
                                <td>$user_fetch[address]</td>
                                <td>$user_fetch[pay_method]</td>
                                <td>
                                    <table class='table text-center table-dark' style='background-color:#212529'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>Item Name</th>
                                                <th scope='col'>Price</th>
                                                <th scope='col'>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        ";
                                                $order_query="SELECT * FROM `tbl_order_item` WHERE `order_id`='$user_fetch[order_id]'";
                                                $order_result=mysqli_query($conn,$order_query);
                                                while($order_fetch=mysqli_fetch_assoc($order_result))
                                                {
                                                    echo" 
                                                    <tr>
                                                        <td>$order_fetch[food_name]</td>
                                                        <td>$order_fetch[price]</td>
                                                        <td>$order_fetch[quantity]</td>
                                                    </tr>
                                                    ";
                                                }
                                                echo"
                                                
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                                ";
                    }
                    ?>
                    
                </tbody>
        </table>

        </div>


      
</div>
</div>

<?php include('partials/footer.php');?>

<!-- $res=mysqli_query($conn,$order_query) or die(mysqli_error($conn));
                                                if($res){
                                                    if(mysqli_num_rows($res)>0){
                                                        while($rows=mysqli_fetch_assoc($res)){
                                                            echo" Hello 
                                                                <tr>
                                                                    <td>$rows[order_id]</td>
                                                                    <td>$rows[price]</td>
                                                                    <td>$rows[Quantity]</td>
                                                                </tr>
                                                            ";
                                                        }

                                                    }
                                                } -->