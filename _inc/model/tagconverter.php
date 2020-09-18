<?php
/*
| -----------------------------------------------------
| PRODUCT NAME: 	Modern POS
| -----------------------------------------------------
| AUTHOR:			GITLanka.COM
| -----------------------------------------------------
| EMAIL:			info@GITLanka.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY GITLanka.COM
| -----------------------------------------------------
| WEBSITE:			http://GITLanka.com
| -----------------------------------------------------
*/
class ModelTagconverter extends Model 
{
	public function convert($tags, $dataArr, $message) 
	{
    	if(count($tags)) {
			foreach ($tags as $tag) {
				$rtag = str_replace(array('[',']'), '', $tag);
				if(isset($dataArr[$rtag])) {
					$message = str_replace($tag, $dataArr[$rtag], $message);
				} else {
					$message = str_replace($tag, ' ', $message);
				}
			}
		}
		return $message;
	}
}

// Usage

	// $tc_model = registry()->get('loader')->model('tagconverter');
	// $message = 'Hello, [customer_name]';
	// $message = $tc_model->convert(array('[customer_name]'), array('customer_name' => 'Najmul Hossain'), $message);
	// print_r($message);die;