<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

use Laminas\Barcode\Barcode as Laminas_barcode;

class Barcode extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//$this->load_global();
	}
	
    function index($input){
		
		$rendererOptions = array();
		
		Laminas_barcode::render(
				    'code128',
				    'image',
				    [
				        'text' => $input,
				        'font' => 5,
				        'fontSize' => 10,
				        //'barHeight' => 50,
				        'barThinWidth' => 2,
				        'factor' => 1.8,
				        'withQuietZones' => true,
				        'drawText' => true,
				        'stretchText' => true,
				    ]
		); // will use the 3rd GD internal font

		/*
		Zend Barcode Library:
		1. code128 	-> Allowed characters: the complete ASCII-character set
			code128 : working
		
		2. code25 	-> Allowed characters:‘0123456789’
				code25: not works
		3. code39	-> Allowed characters:‘0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ -.$/+%’
				code39 : works
		*/
    }

    public function get_barcode($code=''){
    	return $this->index($code);
    }
}

