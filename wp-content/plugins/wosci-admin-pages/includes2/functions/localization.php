<?php
/*
  $Id: localization.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  function quote_oanda_currency($code, $base = DEFAULT_CURRENCY) {
    $page = file('http://www.oanda.com/convert/fxdaily?value=1&redirected=1&exch=' . $code .  '&format=CSV&dest=Get+Table&sel_list=' . $base);

    $match = array();

    preg_match('/(.+),(\w{3}),([0-9.]+),([0-9.]+)/i', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[3];
    } else {
      return false;
    }
  }

  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
    $page = file('http://www.xe.net/ucc/convert.cgi?Amount=1&From=' . $from . '&To=' . $to);

    $match = array();

    preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[1];
    } else {
      return false;
    }
  }
  
  
   
 function quote_tcmb_currency($to, $from = DEFAULT_CURRENCY) {
    
    switch($to){
    case 'USD':
    $to = 'US DOLLAR';
    break;

    case 'EUR':
    $to = 'EURO';
    break;
    
    case 'GBP':
    $to = 'POUND STERLING';
    break;
    
    case 'JPY':
    $to = 'YEN';
    break;
    
    case 'CAD':
    $to = 'CANADIAN DOLLAR';
    break;
    
    case 'CHF':
    $to = 'SWISS FRANK';
    break;
    
    case 'AUD':
    $to = 'AUSTRALIAN DOLL';
    break;
    }
    
    if($to !='TL'){
    $page = file('http://www.tcmb.gov.tr/kurlar/today.xml');
    $element_ilk = '<CurrencyName>'.$to.'</CurrencyName><ForexBuying>';
    $element_son  = '</ForexBuying>';

    $kalan = stristr($page[2], $element_ilk);
    $pos = strpos($kalan, $element_son);
    $oran = substr($kalan, strlen($element_ilk), $pos-strlen($element_ilk));
    $b=1;
    $oranw= pow($oran,-1);}else{$oranw=1;}
 
    if($oranw >0) {return "$oranw";}else{return false;}

    }
  
?>