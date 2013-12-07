<?php
  require('/includes/application_top2.php');

 for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {

                                if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                $_POST['products_id'][$i];
                                  $cart->remove($_POST['products_id'][$i]);
                                } else {
                                  if (PHP_VERSION < 4) {
                                    // if PHP3, make correction for lack of multidimensional array.
                                    reset($_POST);
                                    while (list($key, $value) = each($_POST)) {
                                      if (is_array($value)) {
                                        while (list($key2, $value2) = each($value)) {
                                          if (ereg ("(.*)\]\[(.*)", $key2, $var)) {
                                            $id2[$var[1]][$var[2]] = $value2;
                                          }
                                        }
                                      }
                                    }
                                    $attributes = ($id2[$_POST['products_id'][$i]]) ? $id2[$_POST['products_id'][$i]] : '';
                                  } else {
                                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                                  }
                                  $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                 
                                }
                              }


 $pt = $currencies->display_price($_POST['currency'], $_POST['final_price'], tep_get_tax_rate($_POST['tax_class_id']), $_POST['cart_quantity'][0]);

                              if(isset($_POST['urunkodu'])) { $cart->remove($_POST['urunkodu']); }
                              



echo '{ "durum": "Silindi'.$cart->count_contents().'",
	"sepetadet": "'. $cart->count_contents() .'" ,
	"sub_totaljs": "'. $currencies->format($cart->show_total()) .'" ,
	"product_totaljs": "'.$pt.'" 
	
	}';

?>