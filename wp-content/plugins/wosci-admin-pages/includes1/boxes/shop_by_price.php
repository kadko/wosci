<?php
/*
  $Id: shop_by_price.php,v 2.5 2008/03/07 $
  
  Contribution by Meltus  http://www.highbarn-consulting.com
  Adapted for OsCommerce MS2 by Sylvio Ruiz suporte@leilodata.com
  Modified by Hugues Deriau on 09/23/2006 - display the price ranges in the selected currency
  Modified by Glassraven for dropdown list 24/10/2006 www.glassraven.com
  Modified by -GuiGui- (http://www.gpuzin.com) - 07/03/2008 - Just added a comment about the Box Heading

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<?
global $category_depth, $currencies,$_GET;

if ($category_depth == 'products' || isset($_GET['manufacturers_id'])) { ?>

<!-- shop by price //-->

<?php
if(isset($_GET['manufacturers_id'])){
$sq_ekle = "p.manufacturers_id= '" . (int)$_GET['manufacturers_id'] . "' and";

if(isset($_GET['filter_id'])){
$c_id = "p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
}else{
$c_id = "p2c.categories_id = p2c.categories_id";
}
}elseif(isset($_GET['cPath']) && isset($_GET['filter_id'])){
$ids = explode("_", $_GET['cPath']);
$kac_id = count($ids);
$sq_ekle = "p.manufacturers_id= '" . (int)$_GET['filter_id'] . "' and";
//print_r($ids);
$c_id = "p2c.categories_id = '" . (int)$ids[$kac_id-1] . "'";
}elseif(isset($_GET['cPath'])){
$ids = explode("_", $_GET['cPath']);
$kac_id = count($ids);
$c_id = "p2c.categories_id = '" . (int)$ids[$kac_id-1] . "'";
}

$price_query = tep_db_query("select products_price from " . TABLE_PRODUCTS ." p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on $c_id where $sq_ekle p.products_status =1 and p2c.products_id = p.products_id order by p.products_price DESC limit 1");

$pq = tep_db_fetch_array($price_query);


$sel_currency = array();
$prc = $pq['products_price'];
$txrt = 1+(tep_get_tax_rate(1)/100);
$price_ranges = Array(array('numfr'=>0,'numto'=>$prc/8,'text'=>$currencies->format($prc/8*$txrt)  ." ve altı"),

array('numfr'=>$prc/8,'numto'=>$prc/4,'text'=>$currencies->format($prc/8*$txrt) . " - " . $currencies->format($prc/4*$txrt). " arası"),
						 
array('numfr'=>$prc/4,'numto'=>$prc/2,'text'=>$currencies->format($prc/4*$txrt). " - " . $currencies->format($prc/2*$txrt) ." arası "),

array('numfr'=>$prc/2,'numto'=>$prc,'text'=>$currencies->format($prc/2*$txrt). " - " . $currencies->format($prc*$txrt) ." arası "),

array('numfr'=>$prc,'numto'=>10000,'text'=>$currencies->format($prc*$txrt) ." üstü")
						
);

// use dropdown list - comment out if using list format


// Box Heading - uncomment the following 3 line to display the Box Title
// $info_box_contents = array();
// $info_box_contents[] = array('text' => BOX_HEADING_SHOP_BY_PRICE);
// new infoBoxHeading($info_box_contents, false, false);


//print_r($price_ranges);
$info_box_contents = array();
$price_range_list = '';
	$price_range_list[] = array('id' => '0', 'text' => '---seçiniz---' );
	
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$fromprice[] = $price_ranges[$range]['numfr'];
		$toprice[] = $price_ranges[$range]['numto'];
		$textprice[] = $price_ranges[$range]['text'];
		$price_range_list[] = array('id' => $range, 'text' => $price_ranges[$range] );
	} 

/*if ($shop_price_type == 'dropdown') {
	

	$info_box_contents[] = array('form' => '<form name="shop_price" action="' . tep_href_link(FILENAME_SHOP_BY_PRICE) . '" method="get">' . tep_hide_session_id(),
								 'align' => 'left',
								 'text'  => 'cc'.tep_draw_pull_down_menu('range', $price_range_list, $range, 'onchange="this.form.submit();"  size="' . 1 . '" style="width: 100%"') . tep_hide_session_id().tep_draw_hidden_field('cPath', $HTTP_GET_VARS['cPath']));

} else {
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$info_box_contents[] = array('align' => 'left',
		'text'  => '<a href="' . tep_href_link(FILENAME_SHOP_BY_PRICE, 'range=' . $range , 'NONSSL') . '">' . $price_ranges[$range] . '</a><br>');
	}				
}*/


 		//new infoBox($info_box_contents);
  
?>

      <?php 
      if($_GET['cPath'] !=''){
      $query_string = '&cPath='.$_GET['cPath'];
      }
      if(isset($_GET['manufacturers_id'])){
      $query_string .= '&manufacturers_id='.$_GET['manufacturers_id'];
      }
      
      if(isset($_GET['filter_id'])){
      $query_string .= '&filter_id='.$_GET['filter_id'];
      }
      
      for ($range=0; $range<sizeof($price_ranges); $range++) {
	
	if(isset($_GET['numfr']) && $_GET['numfr']==$price_ranges[$range]['numfr']){$bb='<b>';$bs='</b>';}else{$bb='';$bs='';}
	echo '<li style="line-height:24px;font-size:0.9em;">'.$bb.'<a href="' . tep_href_link('index.php') . '?numfr='.$price_ranges[$range]['numfr'].'&numto='.$price_ranges[$range]['numto'].$query_string.'">'.$price_ranges[$range]['text'].'</a>'.$bs.'</li>';
	
	

		
	} 
	
      ?>
	
<!-- shop_by_price //-->
<?php } ?>