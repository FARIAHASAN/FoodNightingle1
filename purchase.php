<?php
include('config/constants.php');
$username=$_SESSION['username'];
 
if(mysqli_connect_error())
 {
    echo "
    <script>
    alert('Cannot connect to database');
    window.location.href = 'mycart.php';
    </script>
    ";
    exit();
 }

     if(isset($_POST['purchase']))
     {
         $query1="INSERT INTO `tbl_order`( `username`, `phone_no`, `address`, `pay_method`) VALUES ('$username','$_POST[phone_no]','$_POST[address]','$_POST[pay_method]')";
         if(mysqli_query($conn,$query1)){
             $order_id=mysqli_insert_id($conn);
             $query2="INSERT INTO `tbl_order_item`(`order_id`, `food_name`, `price`, `quantity`) VALUES (?,?,?,?)";
             $stmt=mysqli_prepare($conn,$query2);
             $gtot=0;
             if($stmt){
                 mysqli_stmt_bind_param($stmt,"isii",$order_id,$Food_Name,$Price,$Quantity);
                 foreach($_SESSION['cart'] as $key => $values){
                     $Food_Name=$values['Food_Name'];
                     $Price=$values['Price'];
                    
                     $gtot=$gtot+(int)$Price;
                     $Quantity=$values['Quantity'];
                     mysqli_stmt_execute($stmt);
                 }
                 

                 unset($_SESSION['cart']);
                 if($_POST['pay_method']=="COD")
                 {
                 echo "
                <script>
                alert('Order Placed');
                window.location.href ='index.php' ;
                </script>
            ";
                  }
                  else
                  {
                    echo "
                <script>
                alert('Order Placed');
                window.location.href ='onlinepayment.php?user=$username&total=$gtot' ;
                </script>
            ";

                  }
             }

         } 
         else{
            echo "
            <script>
            alert('SQL Error');
            window.location.href = 'mycart.php';
            </script>
            ";
         }    
 }

 ?>