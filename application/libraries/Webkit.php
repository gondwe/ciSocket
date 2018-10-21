<?php 
require 'vendor/autoload.php';
use Knp\Snappy\Pdf;

class Webkit {

    
    function __construct(){

        
    }

    function init(){
        $snappy = new Pdf();
        $snappy->setBinary("C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe");
    }
    
    function display(){

    }
    
}