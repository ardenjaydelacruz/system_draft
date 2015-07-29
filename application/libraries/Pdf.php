<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('FPDF_FONTPATH',APPPATH .'plugins/font/');
require(APPPATH .'plugins/fpdf.php');
class Pdf extends FPDF
{
  // Extend FPDF using this class
  // More at fpdf.org -> Tutorials
  function __construct($orientation='P', $unit='mm', $size='Letter')
  {
    // Call parent constructor
    parent::__construct($orientation,$unit,$size);
  }
}
?>