<?php
 
class data
{
    // Class properties and methods go here
    private $key;

    public function __construct()
    {
    	$key = '2015201520159';
    	$this->key = $key;
    }

    public function listings($page)
    { 
    	

    	// placing file input url 
		$url = "http://atlas.atdw-online.com.au/api/atlas/products?key=". $this->key ."&cla=APARTMENT&term=Blue%20Mountains&size=10&pge=".$page."&out=json";
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

		$contents = mb_convert_encoding($contents, 'UTF-8', 'UTF-16LE');

		//$contents = json_decode($contents); 


		$contents = json_decode($contents, true);
		$listings['numberOfResults'] = $contents[numberOfResults];
		if($contents){
			$listings['data'] = $contents[products];
			$listings['success'] = true;
		}
		

		if( $listings['data'] == false || isset($listings['success']) == false ) {
            throw new Exception('Request was not correct');
        }
         
        //if there was an error in the request, throw an exception
        if( $listings['success'] == false ) {
            throw new Exception($listings['errormsg']);
        }

    	return $listings;
    }


}
 

 
?>