
<?php include('partial-front/food_menu.php');
// session_start();
// session_destroy();

?>

 <?php
 $customer=$_SESSION['username'];
 if(isset($_GET['username']))
 {
     $username=$_GET['username'];
     $sql="SELECT res_name FROM tbl_restaurant_info WHERE username='$username'";
     $res = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($res);
     $res_name = $row['res_name'];

 }
 else{
     header('location:'.SITEURL);
 }
 ?> 

<section class="food-search text-center">
        <div class="container">
            <div class="text">
            <h1><?php echo $res_name;?></h1>
            </div>
        </div>
    </section>


    <section class="food">
        <div class="container">
        <h1>Menu</h1>
        <?php
                     $sql1 = "SELECT DISTINCT(category) as category FROM tbl_food WHERE username = '$username'";
                     $res1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
                     if($res1)
                     {
                         $count1 = mysqli_num_rows($res);
                 
                         if($count1>0)
                         { 
                             //we have data in database
                             while($rows1=mysqli_fetch_assoc($res1)) 
                          {
                              //using while loop to get all the from database
                              //while loop will run as long as we have data in database
                 
                              //get individual data
                              $category = $rows1['category'];
                             
                 
                             
                
                
                ?>
         
                 <h3><?php echo $category;?></h3>
            <div class="food-container">

        <?php
        $sql2="SELECT * FROM tbl_food WHERE username='$username' AND category='$category'";
        $res2=mysqli_query($conn,$sql2);
        $count2=mysqli_num_rows($res2);
        if($count2>0){
            ?>
            <?php

            while($row2=mysqli_fetch_assoc($res2)){
                $food_name=$row2['food_name'];
                $category=$row2['category'];
                $price=$row2['price'];
                $description = $row2['Description'];
                $foodid = $row2['id'];



               // User rating
               //$query = "SELECT * FROM food_rating WHERE foodid=" . $foodid . " and customer=" .$customer;
               $query="SELECT * FROM food_rating WHERE foodid='$foodid' AND customer='$customer' ";
               $userresult = mysqli_query($conn, $query) or die(mysqli_error($conn));
               if($userresult)
               {
                   if(mysqli_num_rows($userresult)>0)
                   {    $row3 = mysqli_fetch_assoc($userresult);
                       $rating=$row3['rating'];
                   }
                }

               // get average
               $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM food_rating WHERE foodid=".$foodid;
               $avgresult = mysqli_query($conn, $query) or die(mysqli_error($conn));
               $fetchAverage = mysqli_fetch_array($avgresult);
               $averageRating = $fetchAverage['averageRating'];

               if ($averageRating <= 0) {
                   $averageRating = "No rating yet!";
               }





                ?>
    
       <?php         
        echo "     
        <div class='food-box'>
        <form action='cart.php?username=$username' method='POST'>";
           ?>      
                <div class="post-action">
                
                <select class='rating' id='rating_<?php echo $foodid; ?>' data-id='rating_<?php echo $foodid; ?>'>
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
           </select>
           
           Average Rating : <span id='avgrating_<?php echo $foodid; ?>'><?php echo $averageRating; ?></span>
    
              </div>
                      

                        <?php  
                echo "   
                <h3>$row2[food_name]</h3>
                <h4>$row2[price]</h4>
                <p>$row2[Description]</p>
                <button type='submit' name='Add_To_Cart' class='btn btn-primary'>Add to cart</button>
                <input type='hidden' name='Food_Name' value='$row2[food_name]'>
                <input type='hidden' name='Price' value='$row2[price]'>
                

        </form>   
            
        </div>
        ";
        ?>

              <?php  
            
           
            } 
            ?>
            </div>
            <?php
        }
    }
}
                     }
        ?>
        
                   

            <div class="clearfix"></div>
        </div>
        
    
    </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="newweb/jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>

    <script type="text/javascript">
     $(document).ready(function(){
        $('#rating_<?php echo $foodid;?>').barrating('set',<?php echo $rating; ?>);
    });

        $(function() {
         $('.rating').barrating({
          theme: 'fontawesome-stars',
          onSelect: function(value, text, event) {
           // Get element id by data-id attribute
           var el = this;
           var el_id = el.$elem.data('id');
           // rating was selected by a user
           if (typeof(event) !== 'undefined') {
         
             var split_id = el_id.split("_");
             var post_id = split_id[1]; // post_id
             // AJAX Request
             $.ajax({
               url: 'rating.php',
               type: 'post',
               data: {post_id:post_id,rating:value},
               dataType: 'json',
               success: function(data){
                 // Update average
                 var average = data['averageRating'];
                 $('#avgrating_'+post_id).text(average);
               }
             });
           }
          }
         });
        });
      </script>
    <?php include('partial-front/footer.php');?>