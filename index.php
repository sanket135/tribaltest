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
.modal-backdrop {
  z-index: 0 !important;
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
require __DIR__ . '/vendor/autoload.php';
$key = '2015201520159';
// page number
if (isset($_GET['page'])) {
    $pagenumber = $_GET['page'];
} else {
    $pagenumber = 1;
}

// placing file input url 
$url = "http://atlas.atdw-online.com.au/api/atlas/products?key=" . $key . "&cla=APARTMENT&term=Blue%20Mountains&size=10&pge=" . $pagenumber . "&out=json";
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

//$contents = json_decode($contents); 


$contents = json_decode($contents, true);
$products = $contents[products];
$numberofresults = $contents[numberOfResults];
$numberofpages = $numberofresults / 10;
if ($numberofresults % 10 != 0) {
    $numberofpages = $numberofpages + 1;
}

// print $products;
//var_dump($contents);
echo '<ul class="list-group">';
foreach ($products as $product) {
    echo '<li class="list-group-item justify-content-between">';
    echo "<div  data-toggle='modal' id='btn_$product[productId]' data-target='#md_$product[productId]'>";
    echo $product[productName];
    echo '</div>';
    // echo "<span class='popuptext' id='$product[productId]'>";
    // echo $product[productDescription];
    //echo '</span>';
    
    echo "<div class='modal' id='md_$product[productId]'>";
    
    echo "<div class='modal-content'>";
    echo "<span class='close'>&times;</span>";
    echo "<p>'$product[productDescription];'</p>";
    echo "</div>";
    echo "</div>";
    
    echo '</li>';
}
echo '</ul>';




echo "<ul class='pagination'>";
for ($i = 1; $i <= $numberofpages; $i++) {
    echo "<li><a href='http://localhost/tribaltest/index.php?page=$i'>$i</a></li>";
}
echo "</ul>";
?>
            
      
        
    </div>
    </body>
</html>
