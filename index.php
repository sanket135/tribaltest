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

//load required files 

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/classes/data.php';


// page number
if (isset($_GET['page'])) {
    $pagenumber = $_GET['page'];
} else {
    $pagenumber = 1;
}


// new listing object 
$data = new data;
$listing = $data->listings($pagenumber);
$numberofresults = $listing['numberOfResults'];

// counting for pagination , number of total listings divided by number of listing in a page ie 10.
$numberofpages = $numberofresults / 10;
// counting for last page , last page added if remainder is not 0
if ($numberofresults % 10 != 0) {
    $numberofpages = $numberofpages + 1;
}

echo '<ul class="list-group">';
foreach ($listing['data'] as $product) {
    echo '<li class="list-group-item justify-content-between">';
    // div that trigger modal pop up for displaying description
    echo "<div  data-toggle='modal' id='btn_$product[productId]' data-target='#md_$product[productId]'>";
    echo $product[productName];
    echo '</div>';
    
    
    echo "<div class='modal' id='md_$product[productId]'>";
    
    echo "<div class='modal-content'>";
    echo "<span class='close'>&times;</span>";
    echo "<p>'$product[productDescription];'</p>";
    echo "</div>";
    echo "</div>";
    
    echo '</li>';
}
echo '</ul>';



// pagination code here - declared loop 
echo "<ul class='pagination'>";
for ($i = 1; $i <= $numberofpages; $i++) {
    // url is hardcoded and may require to be changed depending on your server settings 
    echo "<li><a href='http://localhost/tribaltest/index.php?page=$i'>$i</a></li>";
}
echo "</ul>";
?>
           
      
        
        </div>
       
    </body>
</html>
