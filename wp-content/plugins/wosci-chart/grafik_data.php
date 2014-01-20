<script src="<?php echo WP_CONTENT_URL; ?>/plugins/wosci-chart/js/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<?php echo WP_CONTENT_URL; ?>/plugins/wosci-chart/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo WP_CONTENT_URL; ?>/plugins/wosci-chart/highslide/highslide-full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WP_CONTENT_URL; ?>/plugins/wosci-chart/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WP_CONTENT_URL; ?>/plugins/wosci-chart/highslide/highslide.css" />
<?php
  

$sales_products_query = tep_db_query("select o.orders_id, sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from orders as o, orders_products as op where o.orders_id = op.orders_id GROUP by o.orders_id DESC, date_purchased");


/****************************TIMEZONE*****************************/
/*
if your php default timezone different than your actual timezone (or you dont saw last days order total) you can set your timezone with this command below.
All timezones are listd here > http://www.php.net/manual/en/timezones.php
*/
//date_default_timezone_set('Turkey');
/****************************************************************/

  if (tep_db_num_rows($sales_products_query) > 0) {
    $ii = 0;   
    
    while ($sales_products = tep_db_fetch_array($sales_products_query)) {
    
	$ddpd = substr($sales_products['date_purchased'], 0, 10);//tep_date_short($sales_products['date_purchased']);
	
	$gunluktoplam[$ddpd][$ii]= $sales_products ['withtax'];
    
	$gunluktoplamy[$ddpd][]= $sales_products ['withtax'];
	$order_ids[$ddpd][] =  $sales_products['orders_id'];
   
	$total+=$sales_products ['daily_prod'];
	$total_wtax+=$sales_products ['withtax'];
	  

	$dp = $ddp;
	$ii++;


 }
 }





 $month_day = $today['mday'];
 $today = getdate();

function createDateRangeArray($strDateFrom,$strDateTo,$gunluktoplamy,$order_ids,$returntype)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        $i=0;
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        $total_orders[] = count($gunluktoplamy[date('Y-m-d',$iDateFrom)]);
      
       
        $o_ids ='';
        for($oi=0; $oi < count($order_ids[date('Y-m-d',$iDateFrom)]); $oi++){
        
	if( (count($order_ids[date('Y-m-d',$iDateFrom)])-1) == $oi  ){ $add=''; }else{ $add='_'; }
	if( count($order_ids[date('Y-m-d',$iDateFrom)]) > 0 ){ $o_ids  .= $order_ids[date('Y-m-d',$iDateFrom)][$oi].$add; }
	
	}
        
        $orderids[] = $o_ids;
        
        if( count($gunluktoplamy[date('Y-m-d',$iDateFrom)]) > 0){
          $total_amount[] = array_sum($gunluktoplamy[date('Y-m-d',$iDateFrom)]);
        }else{
         $total_amount[] = 0;
        }
        $i++;
        }
       
    }

   if($returntype == 'dailytotalamount'){ return $total_amount; }
   if($returntype == 'dailytotalorders'){ return $total_orders; }
    if($returntype == 'order_ids'){ return $orderids; } 
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

if( strlen($today['mon']) ==1 ){ $today['mon'] = '0'.$today['mon']; }
if( strlen($today['mday']) ==1 ){ $today['mday'] = '0'.$today['mday']; }

if( $today['mon'] == 1 ){ $pastmonth = '12'; $pastyear = $today['year']-1; }else{ $pastmonth = $today['mon']-1; $pastyear = $today['year']; }
if( strlen( $pastmonth) ==1 ){  $pastmonth = '0'. $pastmonth; }

$d_from = $pastyear.'-'.$pastmonth.'-'.$today['mday'];
$d_to =   $today['year'].'-'.$today['mon'].'-'.($today['mday']);

?>

<script type="text/javascript">
var chart1; // globally available
$(document).ready(function() {
var order_ids = new Array();
var order_ids = [<?php echo "'" .implode("','", createDateRangeArray($d_from,$d_to,$gunluktoplamy,$order_ids,'order_ids')). "'"; ?>];



var d = new Date(); 

   var day = d.getDate();
   var month = d.getMonth(); 
   var year = d.getFullYear();
   
/*Highcharts.setOptions({
	lang: {
		months: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 
			'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
		weekdays: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi']
	}
});*/

      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'chart-container-1',
            defaultSeriesType: 'line'
         },
         title: {
            text: '<?php _e('Sales Chart With Daily Order Details','wosci-language'); ?>'
         },
         xAxis: {
          type: 'datetime',
        dateTimeLabelFormats: {
            day: '%b.%e'
        }
      },
         
         
               
         
         
         
            plotOptions: {
         series: {
            cursor: 'pointer',
            point: {
               events: {
                  click: function() {
                  this.select();
                  for (i2=0;i2 < chart1.series[0].options.data.length;i2++ )
			{
			if(chart1.series[0].data[i2].x == this.x){ /*alert("bu:"+this.x);*/ var i3 = i2; }
			}
                  
                  var links = ''; i4 = chart1.series[0].data[i3].y; 
                  for (i=0;i < order_ids[i3].split('_').length;i++ )
			{
			eval("var ord_" + i + "=" + order_ids[i3].split('_')[i] + ";");
			links = 'Order ID: <a onclick="return hs.htmlExpand(this, { objectType: \'ajax\', preserveContent: true} )" href="admin.php?page=orders&oID='+ eval("ord_" + i) +'&action=edit">'+ eval("ord_" + i) + '</a><br/>'+ links;
			}
                     hs.htmlExpand(null, {
                        pageOrigin: {
                           x: this.pageX, 
                           y: this.pageY
                        },
                       
                        headingText: this.series.name,
                        maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) +'<h3>'+ 
                           this.y + '</h3>Orders: <br/>'+links,
                        width: 200
                     });
                  }
               }
            },
            marker: {
               lineWidth: 1
            }
         }
      },
         
         
         
         
         
         
         
         
         
         yAxis: [{
            title: {
               text: '<?php _e('Daily total / Order qty.','wosci-language'); ?>'
            }
         }, { // Secondary yAxis
					gridLineWidth: 0,
					title: {
						text: '',
						style: {
							color: '#4572A7'
						}
					},
					labels: {
						formatter: function() {
							return this.value +' mm';
						},
						style: {
							color: '#4572A7'
						}
					}
					
				}],
				tooltip: {
				shared:true,
				crosshairs: true
				},
         series: [{
            name: '<?php _e('Daily Sales Total','wosci-language'); ?>',
            data: [<?php echo implode(',', createDateRangeArray($d_from ,$d_to, $gunluktoplamy,$order_ids,'dailytotalamount')); ?>]
            , pointStart: Date.UTC(<?php if( $today['mon']==1){ echo $today['year']-1; }else{ echo $today['year']; } ?>, <?php if( $today['mon']==1){ echo '11'; }else{echo $today['mon']-2;} ?>, <?php echo $today['mday']+1;?>),
        pointInterval: 24 * 3600 * 1000 // one day
         }, {
            name: '<?php _e('Order Qty.','wosci-language'); ?>',
            data: [<?php echo implode(',', createDateRangeArray($d_from ,$d_to, $gunluktoplamy,$order_ids,'dailytotalorders')); ?>],
             pointStart: Date.UTC(<?php if( $today['mon']==1){ echo $today['year']-1; }else{ echo $today['year']; } ?>, <?php if( $today['mon']==1){ echo '11'; }else{echo $today['mon']-2;} ?>, <?php echo $today['mday']+1;?>),
        pointInterval: 24 * 3600 * 1000 // one day
         }]
      });
   });

</script>
<?php /*print_r($data_arr);*/  ?>
<div id="chart-container-1" style="width: 100%; height: 400px"></div>
