<?php
// session_start();

// if($_SERVER["REQUEST_METHOD"]=="POST"){
//     if(isset($_POST['Add_To_Cart'])){
//         if(isset($_SESSION['cart'])){

//         }
//         else{
//             $_SESSION['cart'][0]=array('Item_Name' => $_POST['Item_Name'],'Price' => $_POST['Price'],
//             'Quantity' => 1);
//             print_r($_SESSION['cart']) ;

//         }
//     }
// }

session_start();
// session_destroy();
// $username=$_GET['username'];

if(isset($_POST['Add_To_Cart'])){
     $food_name=$_POST['Food_Name'];
    $food_price=$_POST['Price'];
    

    if(isset($_SESSION['cart'])){
        $myItems=array_column($_SESSION['cart'],'Food_Name');
        if(in_array($_POST['Food_Name'],$myItems)){
            echo "<script>
            alert('Item Already Added');
            window.location.href='food.php?username=$_GET[username]';
            </script>";
        }
        else{
        $count=count($_SESSION['cart']);
        $_SESSION['cart'][$count]=array('Food_Name'=>$_POST['Food_Name'],'Price'=>$_POST['Price'],'Quantity'=>1);
        echo "<script>
            alert('Item Added');
            window.location.href='food.php?username=$_GET[username]';
            </script>";
        }
        

    }
else{
    $_SESSION['cart'][0]=array('Food_Name'=>$food_name,'Price'=>$food_price,'Quantity'=>1);
    echo "<script>
            alert('Item Added');
            window.location.href='food.php?username=$_GET[username]';
            </script>";
    
}
}
if(isset($_POST['Remove_Food'])){
    foreach($_SESSION['cart'] as $key=>$value){
        if($value['Food_Name']==$_POST['Food_Name']){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>
            alert('Item Removed');
            window.location.href='mycart.php';
            </script>
            ";
        }

    }
   
}
if(isset($_POST['Mod_Quantity'])){
    foreach($_SESSION['cart'] as $key=>$value){
        if($value['Food_Name']==$_POST['Food_Name']){
            $_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
            echo "<script>
            window.location.href='mycart.php';
            </script>
            ";
        }

    }
}


?> 