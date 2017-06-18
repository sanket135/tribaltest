<?php
class listing
{
    private $_params;
     
    public function __construct($params)
    {
        $this->_params = $params;
    }
     
    public function createlistingAction()
    {

        //create new listing
    $listing = new listingItem();
    $listing->productname = $this->_params['productname'];
    $listing->productdescription = $this->_params['productdescription'];

    return $product->toArray();

    }
     
    
}