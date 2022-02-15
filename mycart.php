<?php include('partial-front/menuBootstrap.php');
$username=$_SESSION['username'];

$sql="SELECT * FROM tbl_customer WHERE username='$username'";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
if($res){
    if(mysqli_num_rows($res)>0){
        while($rows=mysqli_fetch_assoc($res)){
            $address = $rows['address'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col col-sm-12 col-md-12 col-lg-12 text-center my-5">
                <h1>CART</h1>
            </div>
            <div class="col col-lg-8 col-sm-12 col-md-12">
            <table class="table">
                <thead class="text-center">
                    <tr>
                    <th scope="col">S No.</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                <?php 
               if(isset($_SESSION['cart'])){
               foreach($_SESSION['cart'] as $key => $value){
                   $sr=$key+1;
                   echo"
                   <tr>
                   <td>$sr</td>
                   <td>$value[Food_Name]</td>
                   <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                   <td>
                   <form action='cart.php' method='POST'>
                   <input type='number' value='$value[Quantity]' min='1' max='10' class='text-center iquantity' name='Mod_Quantity' onchange='this.form.submit();'>
                   <input type='hidden' name='Food_Name' value='$value[Food_Name]'>
                   </form>
                   </td>
                   <td class='itotal'></td>
                   <td>
                   <form action='cart.php' method='POST'>
                   <button name='Remove_Food' class='btn btn-outline-danger'>Remove</button>
                   <input type='hidden' name='Food_Name' value='$value[Food_Name]'>
                   </form>
                   </td>
                   </tr>
                   ";

               }
            }
               ?>
                </tbody>
            </table>
            </div>
            <div class="col col-lg-4 col-sm-12 col-md-12">
                <div class="border bg-light rounded p-4">
                <h3>Grand Total:</h3>
                <h5 id="gtotal"></h5>
                <br>
                <?php 
                if(isset($_SESSION['cart'])&& count($_SESSION['cart'])>0)
                {
                
                ?>
                <form action="purchase.php" method="POST">
                    <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $address;?>" required>
                    </div>
                    <div class="form-group">
                    <label>Phone no.</label>
                    <input type="text" name="phone_no" class="form-control" required>
                    </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_method" id="exampleRadios1" value="COD" checked >
                    <label class="form-check-label" for="exampleRadios1">
                        Cash On Delivery
                    </label>
                    <br>
                    <input class="form-check-input" type="radio" name="pay_method" id="exampleRadios1" value="Online" >
                    <label class="form-check-label" for="exampleRadios1">
                        Online Payment
                    </label>
                    </div>
                    <br>
                    <button class="btn btn-primary btn-block" name="purchase">Place Order</button>
                </form>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>

<script>
    var gt=0;
    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('iquantity');
    var itotal=document.getElementsByClassName('itotal');
    var gtotal=document.getElementById('gtotal');

    function subTotal(){
        gt=0;
        for(i=0;i<iprice.length;i++){
            itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
            gt=gt+(iprice[i].value)*(iquantity[i].value)
        }
        gtotal.innerText=gt;
    }

subTotal();
</script>
</body>
</html>

