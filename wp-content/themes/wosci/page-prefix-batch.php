<?php
header('Content-type: text/html; charset=UTF-8');
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/


get_header();
//require('includes/application_top.php');


/*

$oldSetting = libxml_use_internal_errors( true ); 
ini_set('display_errors', 1);

error_reporting(E_ALL); 
*/
//libxml_clear_errors();


set_time_limit(240000);//66... saat

function downloadUrl($Url, $ch){
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    return $output;
}

function yayinevi($url, $sayfa, $ch){

    $fid = substr($url, 27); 
    $url2='http://www.prefix.com.tr/'.$url;

    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in sconds
    if($sayfa > 1){
    $postData='kisiid=&tree=&query=&fid='.$fid.'&dzid=&sira=&sayfa='.$sayfa;
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);    
    $post=1;
    }else{$post=0;}
    curl_setopt($ch, CURLOPT_POST, $post);
    curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    return $output;
}

function kitap($url, $ch){
    $url2='http://www.prefix.com.tr/'.$url;

    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in sconds
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    return $output;
}


function login(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://www.prefix.com.tr/uye_kontrol.asp'); //login URL
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in sconds
    $postData='email=blue@chalcedonymine.com&sifre=10081977p&x=40&y=10&redirect=http%3A%2F%2Fwww.prefix.com.tr%2FDefault.asp';
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $store = curl_exec ($ch);
    return $ch;
}

$ch = login();
$html1 = downloadUrl('http://www.prefix.com.tr/firma_index.asp', $ch);
//print_r( $html1 );


/**/
$html = new DOMDocument(); 

/* */
$html->loadHtml($html1);//loadHtmlFile  direk urlden çekmek için 

$xpath = new DOMXPath( $html ); 
$cat1 = trim($xpath 
	->query( "//div[@class='contenttitle']")
	->item(0)->nodeValue
	);

	
		
	$sayfa = 1; $tsayfa=1;
	for ($i=1;$i<6;$i+=2) {	for($ii=1;$ii<1733;$ii+=3) { //ii login olunmad???nda 2 ?er art?yor , komisyon stunuda ekleniyor loginde
	if( $i == 1 && $ii < 1640 ){ continue; }//thanks to eisberg
	
	$cat2 = trim($xpath 
	->query( '//*[@id="mid"]/tr/td/table/tr/td/table/tr/td['.$i.']/div['.$ii.']/a/@href')
	->item(0)->nodeValue
	);
	
	$cat3 = trim($xpath 
	->query( '//*[@id="mid"]/tr/td/table/tr/td/table/tr/td['.$i.']/div['.$ii.']/a')
	->item(0)->nodeValue
	);
for($s=1;$s <= $tsayfa;$s++){
	//if($sayfa == 0){ $sayfa=$sayfa+1; }
	$ye_ki = yayinevi($cat2, $s, $ch);
	$yehtml = new DOMDocument(); 

/* */
$yehtml->loadHtml($ye_ki);//loadHtmlFile  direk urlden çekmek için 
//print_r($ye_ki);
$yexpath = new DOMXPath( $yehtml ); 

$yekili = trim($yexpath 
	->query( '//*[@class="pagingbox"]')
	->item(0)->nodeValue
	
	);

	$paging = trim($yexpath 
	->query( '//*[@class="pagingbox"]')
	->item(0)->nodeValue
	);

$tu = trim($yexpath 
	->query( '//*[@id="orta"]/div[1]/b[2]')
	->item(0)->nodeValue
	);




	$paging_a = explode(' ', $paging);
	$pa = count($paging_a);

	//yay?nevini veritaban?na ekle BOF
	$fid = substr($cat2, 27); 

	$ye_query = tep_db_query("select term_id from wp_terms where slug ='".sanitize_title($cat3).'-'.$fid."' "); 
		
	$ye_id=tep_db_fetch_array($ye_query);
	$yid = $ye_id['term_id'];
	
	if( empty($yid)  && !empty($fid) ){
	
	$sql_data_arraym = array( 'name' => tep_db_prepare_input($cat3), 'slug'=> sanitize_title($cat3).'-'.$fid);
	
	tep_db_perform('wp_terms', $sql_data_arraym, $action = 'insert');
	$manufacturer_i_id = tep_db_insert_id(); 
	
	
	$sql_data_arraymi = array('taxonomy' => 'yayinevleri',
	'term_id' => $manufacturer_i_id);
	tep_db_perform('wp_term_taxonomy', $sql_data_arraymi, $action = 'insert');
	//yay?nevini veritaban?na ekle EOF

	}
	if( strlen($yid) < 2 ){ echo '<br>skipped:'.$cat3; $ch = login(); continue; }
	$rmv = array("(", ")", "ürün", " ");
	$tur = str_replace($rmv, "", $tu);
	if( $tur < 1 ){ continue; }//$kalan division by zero veriyor pas geçilmez ise.
	$tsayfa = ceil((int)$tur/50);
	$kalan = (int)$tur % $tsayfa;

for($k=1;$k<51;$k++){
$kitap = trim($yexpath 
	->query( '(//*[@class="listeurun"]/a)['.$k.']')
	->item(0)->nodeValue
	);

$kitap_url = trim($yexpath 
	->query( '(//*[@class="listeurun"]/a/@href)['.$k.']')
	->item(0)->nodeValue
	);


//buradan itibaren yay?nevindeki kitap listesi okunuyor BOF 

$kitaphtml = kitap($kitap_url, $ch);	

$kidom = new DOMDocument(); 

/* */
$kidom->loadHtml($kitaphtml);//loadHtmlFile  direk urlden çekmek için 
//print_r($ye_ki);
$kixpath = new DOMXPath( $kidom ); 

$kategoril1 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[1]/div[1]/a[1]')
	->item(0)->nodeValue
	);
if(empty($kategoril1url)){
$kategoril1 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[1]')
	->item(0)->nodeValue
	);
}
/*
if(strlen($kategoril1) < 5){
$kategoril1 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[1]')
	->item(0)->nodeValue
	);
}*/
//


$kategoril1url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[1]/div[1]/a[1]/@href')
	->item(0)->nodeValue
	);

if(empty($kategoril1url)){

$kategoril1url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[1]/@href')
	->item(0)->nodeValue
	);
}


if(empty($kategoril1url)){

$kategoril1url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[2]/ul/li[1]/div[1]/a[1]/@href')
	->item(0)->nodeValue
	);
}
		 
$kategoril2 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[1]/div[1]/a[2]')
		  //*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[2]

	->item(0)->nodeValue
	);
	
if(empty($kategoril2)){
$kategoril2 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[2]')
		  //*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[2]

	->item(0)->nodeValue
	);
}

if(empty($kategoril2)){
$kategoril2 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[2]/ul/li[1]/div[1]/a[2]')
		  //*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[2]

	->item(0)->nodeValue
	);
}

$kategoril2url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[1]/div[1]/a[2]/@href')
	->item(0)->nodeValue
	);

if(empty($kategoril2url)){
$kategoril2url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li/div[1]/a[2]/@href')
	->item(0)->nodeValue
	);

}

if(empty($kategoril2url)){
$kategoril2url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[2]/ul/li[1]/div[1]/a[2]/@href')
	->item(0)->nodeValue
	);

}

$kategori2l1 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[2]/div[1]/a[1]')
	->item(0)->nodeValue
	);

$kategori2l1url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[2]/div[1]/a[1]/@href')
	->item(0)->nodeValue
	);
	
$kategori2l2 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[2]/div[1]/a[2]')
	->item(0)->nodeValue
	);

$kategori2l2url = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[2]/td/div[1]/ul/li[2]/div[1]/a[2]/@href')
	->item(0)->nodeValue
	);


$fiyatr = trim($kixpath 
	->query( '//*[@id="fiyattbl"]/tr[1]/td[2]/b')
	->item(0)->nodeValue
	);

$tanim1 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]')
	->item(0)->nodeValue
	);
$tanim11 = $kixpath->query('//*[@id="tanitimbox"]');
if(!empty($tanim11->item(0)->nodeValue)){

$doc2 = new DOMDocument();
$doc2->appendChild($doc2->importNode($tanim11->item(0), true));
$tanimhtmlb = $doc2->saveHTML();

$rmv3 = array("urun_liste.asp?kid=");
$tanim =  str_replace($rmv3, "advanced_search_result.php?k=", $tanimhtmlb);
}
//*[contains(@address,'Downing')]
//*[@id="tanitimbox"][contains(@href,'urun_liste.asp?kid=')]

for($ki=0;$ki<7;$ki++){
	
$kidu = trim($kixpath 
	->query( '//*[contains(@href,"urun_liste.asp?kid=")]['.$ki.']/@href') //link
	->item(0)->nodeValue
	);

$k_isim = trim($kixpath 
	->query( '//*[contains(@href,"urun_liste.asp?kid=")]['.$ki.']') //isim
	->item(0)->nodeValue
	);
	if( sizeof($kids) >0 ){ unset($kids); }
	if(!empty($kidu) && !empty($k_isim)){
		$k_id = substr($kidu, 19); 
		$kids['kid'][$ki] = $k_id;
		$kids['isim'][$ki] = $k_isim;

	//kisiyi veritaban?na ekle BOF
	$ki_query = tep_db_query("select term_id from wp_terms where slug ='".sanitize_title($kids['isim'][$ki]).'-'.$kids['kid'][$ki]."' "); 
	
	$ki_id=tep_db_fetch_array($ki_query);
	$kiddb = $ki_id['term_id'];
	
	if(strlen($kiddb) < 2 && !empty($kids['kid'][$ki])){//$kids['kid'][$ki] bo? de?er olarak aray?ncada do?ru ç?k?yor düzelt
	
	
	
	
	$sql_data_arrayki = array( 'name' => tep_db_prepare_input($kids['isim'][$ki]), 'slug'=> sanitize_title($kids['isim'][$ki]).'-'.$kids['kid'][$ki]);
	
	tep_db_perform('wp_terms', $sql_data_arrayki, $action = 'insert');
	$ki_i_id = tep_db_insert_id(); 
	
	
	$ki_tax = array('taxonomy' => 'kisiler',
	'term_id' => $ki_i_id);
	tep_db_perform('wp_term_taxonomy', $ki_tax, $action = 'insert');
	/*
	$ki_i_id = tep_db_insert_id(); 
	$sql_data_arraymi = array('manufacturers_id' => tep_db_prepare_input($manufacturer_i_id),
	'languages_id' => tep_db_prepare_input('4'));
	tep_db_perform('manufacturers_info', $sql_data_arraymi, $action = 'insert');
	*/
	//kisiyi veritaban?na ekle EOF

			}

	}



}//for ki



$products_kids = serialize($kids['kid']);
/*$tanim2 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/div[2]')
	->item(0)->nodeValue
	);

$tanim3 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/div[3]')
	->item(0)->nodeValue
	);

$tanim4 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/div[4]')
	->item(0)->nodeValue
	);

$tanim5 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/text()[1]')
	->item(0)->nodeValue
	);

$tanim6 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/text()[2]')
	->item(0)->nodeValue
	);

$tanim7 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/text()[3]')
	->item(0)->nodeValue
	);


$tanim8 = trim($kixpath 
	->query( '//*[@id="tanitimbox"]/text()[4]')
	->item(0)->nodeValue
	);

$tanim9 = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[1]/td[2]/div[1]/h2/div/a')
	->item(0)->nodeValue
	);*/

//*[@id="boxTanimVideo"]/div/a

//$tanim = $tanim1.'<hr>'.$tanim9 ;


$resim = trim($kixpath 
	->query( '//*[@id="orta"]/div/div[2]/table/tr[1]/td[1]/div/a/@href')
	->item(0)->nodeValue
	);


$p3 = explode( '/', $resim );
for($r=0;$r< count($p3);$r++){
if($p3[$r]=='images') { $klasor_adi = $p3[$r+1]; }
if( strrpos($p3[$r], '.jpg', 0) != FALSE ) { $dosya_adi = $p3[$r]; }
}

$ka_id1L1 = substr($kategoril1url, 18); 
$ka_id1L2 = substr($kategoril2url, 18); 
$ka_id2L1 = substr($kategori2l1url, 18); 
$ka_id2L2 = substr($kategori2l2url, 18); 

$rmv2 = array("TL", " ", ":");
$fiyat_b =  str_replace($rmv2, "", $fiyatr);
$fiyat = str_replace(",", ".", $fiyat_b);
$kitap_id = substr($kitap_url, 14); 
/* $fiyat ile elde edilen 4.90 ?eklindeki string veritaban?na eklenmeden önce say?ya çevrilemedi! intval, int i?e yaramad?, var_dump 4.90 için 4 döndürüyor */
/*echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$kitap.' -:- '.$kitap_url.' : '.$fiyat.$kitap_id;
echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$kategoril1.':'.$ka_id1L1.':'.$kategoril2.':'.$ka_id1L2;
echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$kategori2l1.':'.$ka_id2L1.':'.$kategori2l2.':'.$ka_id2L2;
echo $resim.'<>';
echo '<br><br>';*/



// BOF Kategorileri ekliyoruz
//ANA KATEGOR?LER? EKLE
$uk_query = tep_db_query("select term_id from wp_terms where slug ='".sanitize_title($kategoril1).'-'.$ka_id1L1."' "); 

$uk_id = tep_db_fetch_array($uk_query);
$u_id = $uk_id['term_id'];
if( !isset($u_id) && strlen($ka_id1L1)>4) {//

$sql_data_arrayk = array('name' => tep_db_prepare_input($kategoril1), 'slug' => sanitize_title($kategoril1).'-'.$ka_id1L1);

tep_db_perform('wp_terms', $sql_data_arrayk, $action = 'insert');
$kategori_id = tep_db_insert_id(); 


$sql_data_arraykd = array('taxonomy' => 'product_category', 'term_id' => $kategori_id);
tep_db_perform('wp_term_taxonomy', $sql_data_arraykd, $action = 'insert');

}

//ALT KATEGOR? EKLE


$ak_query = tep_db_query("select term_id from wp_terms where slug ='".sanitize_title($kategoril2).'-'.$ka_id1L2."' ");  

$ak_id = tep_db_fetch_array($ak_query);
$e_id = $ak_id['term_id'];

if( !isset($e_id) && strlen($ka_id1L2) > 5 ) {

$kac = strlen($ka_id1L2);
//if($kac>2){

$ust_kate_ID = substr($ka_id1L2, 0, 5);

$ca_query = tep_db_query("select term_id from wp_terms where slug = '" . sanitize_title($kategoril2).'-'.$ust_kate_ID . "'");

$ana_kat_id=tep_db_fetch_array($ca_query);

$sql_data_arrayka = array('name' => $kategoril2, 'slug' => tep_db_prepare_input(sanitize_title($kategoril2).'-'.$ka_id1L2));
//echo '$ka_id1L2:'.$ka_id1L2.'<';
tep_db_perform('wp_terms', $sql_data_arrayka, $action = 'insert');
$c_id = tep_db_insert_id(); 


$sql_data_arraykd = array('taxonomy' => 'product_category', 'term_id' => $kategori_id, 'parent'=> $kategori_id);
tep_db_perform('wp_term_taxonomy', $sql_data_arraykd, $action = 'insert');
//}


}//if - existence of sub-category
// EOF Kategorileri ekliyoruz




/*buraya manufacturers kayd?n? yap insert id ile id al?p manufacturers_id de?erini tan?mla*/
//osC veritaban?na ürün kay?t i?lemleri BOF//
if ( empty($resim) ){ $status = '0'; $ch = login(); echo 'login()';  }else{ $status = '1'; }

$sql_data_array = array(	'products_quantity' => (int)tep_db_prepare_input(4),
				'products_model' => tep_db_prepare_input($kitap_id),
				'products_image' => tep_db_prepare_input($dosya_adi),
				'products_price' => $fiyat,
				'products_currency' => tep_db_prepare_input('TL'),
				'products_weight' => tep_db_prepare_input('0'),
				'products_status' => tep_db_prepare_input($status),
				'manufacturers_id' => $ye_id['manufacturers_id'],
				'products_vendor' => tep_db_prepare_input('PRFX'),
				'products_kids' => $products_kids
			);





$post = array(
	  'comment_status' => 'open' ,
	  'ping_status'    => 'open' , 
	  'post_author'    => 1 , 
	  'post_content'   => $tanim,
	  'post_parent'    => '',
	  'post_excerpt'   => '', 
	  'post_name'      => sanitize_title_with_dashes($kitap), 
	  'post_status'    => 'publish',
	  'post_title'     => $kitap,
	  'post_type'      => 'product',
	);

	$args = array(
	'post_type' => 'product',
	'meta_query' => array(
	array(
	'key' => 'SKU',
	'value' => $kitap_id,
	)
	)
	);
	$my_query = new WP_Query($args);	
	 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Cannot open database');
	$what = '';
	if(!$my_query->have_posts()){ //kitap kay?tlarda yoksa -$c_id yani alt kategorisi yoksa anakategori idye ekle exception yap -
		$pid = wp_insert_post( $post ); 
		$setcat = $mysqli->query("INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('" . $pid . "', '" . $c_id . "', 0)");
		update_post_meta($pid, 'SKU', $kitap_id );
		update_post_meta($pid, 'Price', $fiyat );
		update_post_meta($pid, 'Currency', 'TL' );

		$what ='insert';
	}



//$SKU = get_post_meta( $my_query->post->ID, 'SKU' ); 
		if ( $my_query->have_posts()  ){//kitap sayfas? aç?ld?, kay?t veritaban?nda var ve veritaban?nda kitab?n resmi yoksa
		$post = array( 'ID' => $my_query->post->ID );
		
		wp_update_post( $post );
		
		update_post_meta($my_query->post->ID , 'SKU', $kitap_id );
		update_post_meta($pid, 'Price', $fiyat );
		update_post_meta($pid, 'Currency', 'TL' );
		
		$what = 'update';
		}
		


		if ( $c_id ) { // kitap kategorisi varsa
		$setcat = $mysqli->query("INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('" . $my_query->post->ID. "', '" . $c_id . "', 0)");
		
		$what='C-update';
		
		}


		if(curl_errno($ch))
		{
		    echo 'Curl error: ' . curl_error($ch);
		}

//osC veritaban?na ürün kay?t i?lemleri EOF//

//resim dosyas?n? kopyal?yoruz



$byt = 0; $fe = 0;
if( $dosya_adi !='' ) {
$fe = file_exists('images/'.$dosya_adi);

if( $fe == TRUE ) { $byt = filesize('images/'.$dosya_adi); }


if( $byt < 500 ) {
$content = file_get_contents($resim);
$fp = fopen('images/'.$dosya_adi, "w");
$fwr = fwrite($fp, $content);
fclose($fp);
if($fwr == FALSE){ echo 'FALSE:'.$resim.':'; }else {   } 

echo $dosya_adi.':'.$fwr.':'.$kitap_url;
echo '<br>';

}else{
//echo '**var:'.$kitap.'*'.$resim.'*'.$dosya_adi.'**<br>';
}
}

// print_r( $kitaphtml );
echo 'manufacturers_id =>'. $ye_id['manufacturers_id'].'>'.$kitap.':db>'.$product['products_status'].':si>'.$status.':what:'.$what.':fe:'.$fe.':byt:'.$byt.'<br>';

$resim = ''; $dosya_adi = ''; 

}

}

	 }	}

	

?>
  <div class="well">
<?php /* Template Name: Wosci - Order Success Page*/ ?>
<div style="margin-top:20px;"></div>	
<div class="alert alert-success">
<h3><span class="glyphicon glyphicon-ok"></span>     <?php _e('Your order has been successfully placed. Thank you!', 'wosci-language');?></h3></div>	
<div style="margin-top:10px;"></div>	
<p><?php _e('We sent order confirmation to your email, please check your <b>email inbox</b> for more details about your order.', 'wosci-language');?></p>
<p><?php _e('If confirmation email not arrived to your inbox don\'t forget to check <b>spam</b> folder.', 'wosci-language');?></p>
<div style="margin-top:20px;"></div>	
	
</div><!--.well-->
<?php get_footer(); ?>