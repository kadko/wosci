<?php


 require('/includes/application_top2.php');
  if($_POST['cartpop_action'] == 'sil') {
   $cart->remove($_POST['product_id']);
   
   $toplam = $currencies->format($cart->show_total());
   $qty = $cart->get_quantity($_POST['product_id']);
     echo '{ "name": "silindi", "toplam":"'.$toplam.'", adet: "'.$qty.'"  }';
    }
    
   
   if($_POST['cartpop_action'] == 'azalt' || $_POST['cartpop_action'] == 'artir') {

   $qty = $cart->get_quantity($_POST['product_id']);
   $do =  ($_POST['cartpop_action'] == 'artir' ? $qty+1 : $qty-1);
   $cart->add_cart($_POST['product_id'], $do, '', false);
   $cqty = $cart->get_quantity($_POST['product_id']);
   $toplam = $currencies->format($cart->show_total());
   echo '{ "name": "Sepet Güncellendi", "toplam":"'.$toplam.'", adet: "'.$cqty.'" }';
   
   }   
    
    
   if (isset($_POST['products_id']) && is_numeric($_POST['products_id']) ) {

	$cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+$_POST['quantity'], $_POST['id']);
	echo '{ "message": "sepette '.$cart->count_contents().' adet ürün var", "cart_total": "'.$cart->count_contents().'"  }';
   
   }


?>