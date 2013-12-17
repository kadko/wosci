<?php
/*
  $Id: account_history_info.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

//  require('includes/application_top.php');

  if ($current_user->ID =='0') {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, 'redirect_to=pdf-invoice/?order_id='.$_GET['order_id'], 'SSL'));
  }

  if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = tep_db_query("select o.customers_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s where o.orders_id = '". (int)$_GET['order_id'] . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1'");
  $customer_info = tep_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $current_user->ID) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }




  $order = new order($_GET['order_id']);
?>

<?php

function pdf_invoice($oid)
{

global $order, $currencies;




$items = '';
for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    $items .= '<tr >'  .
	'<td align="center">' . $order->products[$i]['model'] . '</td>'.
	'<td align="center">' . $order->products[$i]['qty'] . '</td>'.
	'<td>' . $order->products[$i]['name'];

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        $items .= '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    $items .= '</td>';

    if (sizeof($order->info['tax_groups']) > 1) {
      $items .= '<td align="right" >' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>';
    }else{
    $items .= '<td align="right" >0%</td>';
    }

    $items .= '<td align="right">' . $currencies->display_price($order->products[$i]['currency'], $order->products[$i]['final_price'], tep_get_tax_rate($order->products[$i]['tax'])) . '</td>' .
    '<td align="right">' . $currencies->display_price($order->products[$i]['currency'], tep_add_tax( $order->products[$i]['final_price'], $order->products[$i]['tax'], '', $order->products[$i]['qty'])). '</td>'.
    
'</tr>';
  }
  
//$totals = '<table  width="100%" style="font-family: serif;border-collapse:collapse;"  cellpadding="10">';
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
    $totals .= '<tr>' .
         '<td class="totalsnoborder"></td>
         <td class="totals">' . $order->totals[$i]['title'] . '</td>' .
         '<td class="totals">' . $order->totals[$i]['text'] . '</td>' .
         '</tr>';
  }
//$totals .= '</table>';

include("MPDF/mpdf.php");

$mpdf=new mPDF('win-1252','A4','','',20,15,48,25,10,10); 
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Acme Trading Co. - Invoice");
$mpdf->SetAuthor("Acme Trading Co.");
$mpdf->SetWatermarkText( __('paid', 'wosci-language') );
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
}
p {    margin: 0pt;
}
td { vertical-align: top; }
.items td {
    border-left: 0.1mm solid #000000;
    border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
    text-align: center;
    border: 0.1mm solid #000000;
}
.items td.blanktotal {
    background-color: #FFFFFF;
    border: 0mm none #000000;
    border-top: 0.1mm solid #000000;
    border-right: 0.1mm solid #000000;
}
.items td.totals {
    text-align: right;
    border: 0.1mm solid #000000;
}
.items td.totalsnoborder {
    text-align: right;
    border: 0;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="30%" style="color:#000000;font-size: 9pt;"><img src="'.get_template_directory().'/images/logo-pdf-invoice.jpg"/><br /><br />'.nl2br(STORE_NAME_ADDRESS).'</td>

<td width="30%" style="text-align: center;"><span style="font-weight: normal; font-size: 14pt;">'.__('INVOICE', 'wosci-language').'</span><br /><span style="font-weight: bold; font-size: 14pt;">#'.$_GET['order_id'].'</span><span style="font-weight: bold; font-size: 12pt;"></span></td>


<td width="30%" style="text-align: right;"><barcode code="1985025470'.$_GET['order_id'].'" type="EAN13" height="0.66" text="1" /></td>


</tr></table>




</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
'.__( 'Page', 'wosci-language' ).' {PAGENO} / {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: right">'.__( 'Date', 'wosci-language' ).': '. tep_date_short($order->info['date_purchased']).'</div>

		


<table  width="100%" style="font-family: serif;border-collapse:collapse;"  cellpadding="10">
<tr>
<td align="left" width="50%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SOLD TO:</span><br /><br />'.tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>').'</td>

<td align="left" width="50%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br />'.tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>').'</td>
</tr>

</table>
<br>


<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
<thead>
<tr >
<td width="15%">'.__( 'SKU', 'wosci-language' ).'</td>
<td width="10%">'.__( 'QUANTITY', 'wosci-language' ).'</td>
<td width="45%">'.__( 'DESCRIPTION', 'wosci-language' ).'</td>
<td width="15%">'.__( 'TAX', 'wosci-language' ).'</td>
<td width="15%">'.__( 'UNIT PRICE', 'wosci-language' ).'</td>
<td width="15%">'.__( 'AMOUNT', 'wosci-language' ).'</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
'. $items .'

<!-- END ITEMS HERE -->
<tr>
<td class="blanktotal" colspan="3" rowspan="6" style="border-right:0px;border-left:0px;"></td>
<td class="blanktotal" style="border-right:0px;border-left:0px;"></td>
<td class="blanktotal" style="border-right:0px;border-left:0px;"></td>
<td class="blanktotal" style="border-right:0px;border-left:0px;"></td>
</tr>


'.$totals.'


</tbody>
</table>

<div style="text-align: center; font-style: italic;">'.__( 'Payment terms: payment due in 30 days', 'wosci-language' ).'</div>
</body>
</html>
';

$mpdf->WriteHTML($html);

$mpdf->Output(); exit;

exit;


}
if(!empty($_GET['order_id'])){
pdf_invoice($_GET['order_id']);
}
?>