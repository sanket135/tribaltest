<?php
class listingitem
{
   
    public $productname;
    public $productdescription;
   
     
    public function save()
    {
       
        //get the array version of this todo item
        $listing_item_array = $this->toArray();
         
        // post call or save in database code here
         
        //if saving was not successful, throw an exception
        if( $success === false ) {
            throw new Exception('Failed to save listing item');
        }
         
        //return the array version
        return $todo_item_array;
    }
     
    public function toArray()
    {
        //return an array version of the todo item
        return array(
            'productname' => $this->productname,
            'productdescription' => $this->productdescription
        );
    }
}