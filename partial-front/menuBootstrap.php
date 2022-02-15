<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.css">

    <title>Document</title>
</head>
<body>
<div class="container">
        <header>
           <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-light">
                <a href="<?php echo SITEURL;?>" class="navbar-brand" ><img src="images/logo2.png" alt="logo" style="width:150px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="background-color:#C1C1C1;padding:15px"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav ml-auto" style="font-weight:600;font-size:21px">
                    <li class="nav-item" > <a href="<?php echo SITEURL;?>" class="nav-link" style="color:coral">Home</a> </li>
                    <li class="nav-item" > <a href="<?php echo SITEURL;?>restaurant.php" class="nav-link" style="color:coral">Restaurant</a> </li>
                    <?php
                        $count=0;
                        if(isset($_SESSION['cart'])){
                        $count=count($_SESSION['cart']);
                    }
            
                    ?>
                    <li class="nav-item" > <a href="<?php echo SITEURL;?>mycart.php" class="nav-link" style="color:coral">Cart(<?php echo $count;?>)</a> </li>
                    <li class="nav-item" > <a href="#" class="nav-link" style="color:coral">About</a> </li>
                    <li class="nav-item" > <a href="#" class="nav-link" style="color:coral">Contact</a> </li>
                    <li class="nav-item" > <a href="#" class="nav-link" style="color:coral">logout</a> </li>



                </ul>
                </div>
            </nav>

        </header>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>