<?php

  global $currencies; 

  if (isset($post->ID)) {
    $orders_query = tep_db_query("select p.ID from " . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, " . TABLE_ORDERS . " o, wp_posts p where opa.products_id = '" . (int)$post->ID . "' and opa.orders_id = opb.orders_id and opb.products_id != '" . (int)$post->ID . "' and opb.products_id = p.ID and opb.orders_id = o.orders_id and p.post_status = 'publish' group by p.ID order by o.date_purchased desc limit " . MAX_DISPLAY_ALSO_PURCHASED);
    $num_products_ordered = tep_db_num_rows($orders_query);
?>



<?php
    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {
      $counter = 0;
      $col = 0;
?>
<div class="well" style="margin-top:-12px;">
<div class="row" style="margin-top:0px;margin-bottom:15px;">

<h4 class="assistive-text" style="margin-left:15px;"><?php echo __('Customers who bought this product also purchased', 'wosci-language'); ?></h4>
<hr>
  <div class="col-xs-18">

<?php
      while ($orders = tep_db_fetch_array($orders_query)) {
        $counter++;
?>
<?php $c = get_post_custom_values('Currency', $orders['ID']); $f = get_post_custom_values('Price', $orders['ID']); $t = get_post_custom_values('Tax', $orders['ID']); $qty = get_post_custom_values('Quantity', $orders['ID']);  ?>
	<div class="col-sm-2">
          <div class="margin-top"></div> <div class="thumbnail">
            <a href="<?php echo get_permalink($orders['ID']); ?>"><?php echo get_the_post_thumbnail($orders['ID'], array('116','200'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h5><a href="<?php echo get_permalink($orders['ID']); ?>"><?php echo get_the_title($orders['ID']); ?></a></h5>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
               </div>
          </div>
        </div>
        
<?php    
      }
?>

</div> <!-- .col-xs-18 -->
</div> <!-- .row -->
</div><!-- .well -->
<?php
	}
	}
?>
