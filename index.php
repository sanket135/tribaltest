<!DOCTYPE html>
<!--
Author : Sanket
Tribal Test
-->
<html>
    <head>
        <title>Accomodation in Blue Mountains</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


       

<!-- code for pop up -->
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>



    </head>
    <body>
        <div class="container-fluid" style="padding: 15px;">
            <nav class="nav navbar-fixed-top">
                <ul class="nav navbar-default">
            </ul>
            </nav>
            <div class="jumbotron">
                <h2>Accommodation in Blue Mountains</h2>
            </div>


        <?php
            // loaded the cross join package using composer for decoding json file
        require __DIR__ . '/vendor/autoload.php';
        // placing file input url 
        $url = "http://atlas.atdw-online.com.au/api/atlas/products?key=2015201520159&cla=APARTMENT&term=Blue%20Mountains&out=json";
         $contents = file_get_contents($url); 
         // further attempts to do encoding 
        // $contents = json_encode($contents); 
         // attempt to decode utf-16le
         //$contents = iconv(in_charset, out_charset, $contents);
       /*  $contents = iconv($in_charset = 'UTF-16LE' , $out_charset = 'UTF-8' , $contents);
if (false === $result)
{
    throw new Exception('Input string could not be converted.');
}*/

// encoding from UTF-16LE to UTF-8

$contents = mb_convert_encoding($contents , 'UTF-8' , 'UTF-16LE');

         //$contents = json_decode($contents); 
        

         $contents = json_decode($contents,true);
         $products = $contents[products];
        
        echo '<ul class="list-group">';
         foreach ($products as $product){
          echo '<li class="list-group-item justify-content-between">';
             echo "<a href onclick='showmodel($product[productId])' >";
             echo $product[productName];
             echo '</button>';
             echo '<span class="badge badge-default badge-pill">' ;
              echo $product[score];
              echo '</span>';

             // echo "<span class='popuptext' id='$product[productId]'>";
            // echo $product[productDescription];
              //echo '</span>';
                // creating modal with specific id for product description
              echo "<div class='modal' id='$product[productId]'>";
              
              echo "<div class='modal-content'>";
              echo "<span class='close'>&times;</span>";
              echo "<p>$product[productDescription];</p>";
              echo "</div>";
              echo "</div>";

            echo '</li>' ;
         }
         echo '</ul>';
        ?>
            
      
        
        </div>
       <script>

function(id){

  // Get the url  that opens the modal
var btn = document.getElementById(id);

// Get the modal
var modal = document.getElementById(id);

}




// Get the <span> element that closes the modal, giving error
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
    </body>
</html>
