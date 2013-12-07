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
    $dp = '';
    $total=0;
    $total_wtax=0;
    while ($sales_products = tep_db_fetch_array($sales_products_query)) {
    
	$ddp = tep_date_short($sales_products['date_purchased']);
	$ddp2[] = tep_date_short($sales_products['date_purchased']);
	$ddpd = str_replace("/", "", $ddp);
	  
        if (($dp != $ddp)) { //if day has changed (or first day)
	   $tarihler[] = $ddpd;
           $metin_tarih[] = (int)substr($sales_products['date_purchased'], 8, 2).'.'.(int)substr($sales_products['date_purchased'], 5, 2); 
           $ddpt = tep_date_short($sales_products['date_purchased']);
           $ddpda = str_replace("/", "", $ddpt);
           $tarihlera[] = $ddpda;


           }
     $gunluktoplam[$ddpd][$ii]= $sales_products ['withtax'];
    
    $gunluktoplamy[$ddpd][]= $sales_products ['withtax'];
    $order_ids[$ddpd][] =  $sales_products['orders_id'];
    $total+=$sales_products ['daily_prod'];
    $total_wtax+=$sales_products ['withtax'];
	  

      $dp = $ddp;
      $ii++;


 }
 }

//print_r($gunluktoplamy);



 $month_day = $today['mday'];
 $today = getdate();
 
 $num = cal_days_in_month(CAL_GREGORIAN, $today['mon']-1, $today['year']) ; 
 $num2 = cal_days_in_month(CAL_GREGORIAN, $today['mon'], $today['year']) ; 

$full_month = '';

if( $month_day == 1 || $month_day == '1' ) { $full_month = 'true'; $loop = $num; } else { $loop = $num2; }


/////////////////////1 aylık zaman dilimini formata oluşturuyoruz//
$ba=0;
for( $i=0; $i<$loop+2; $i++ )
{
if($num >= $today['mday']+$i){
$day = $today['mday']+$i;
}else{
$ba++;
$day = $ba;
}
if(strlen($day) != 2){$day = '0'.$day; }
$ay[] = $day;
}
////////////////////////////////////////////////////////////////
//$maks = max($data_arr);

//print_r($data_arr);echo '<hr>';print_r($gunluktoplamy);


//////////////////////Bu aya ait günler//////////////////////
if(strlen($today['mon'])<2){ $ays = '0'.$today['mon']; }else{ $ays = $today['mon']; }
$ay = array_reverse($ay);
for( $b=0; $b<$today['mday']; $b++)
{
$ay[$b] = $ays.$ay[$b].$today['year'];
}
////////////////////////////////////////////////////////////

//////////////////////Önceki aya ait günler////////////////

if(strlen($today['mon']-1)<2){ $ays_o = '0'.($today['mon']-1); }else{ $ays_o = $today['mon']-1; }

for( $b=0; $b<count($ay); $b++ )
{
if(strlen($ay[$b])===2){ $ay[$b] = $ays_o.$ay[$b].$today['year']; }
}
////////////////////////////////////////////////////////////
//$ay = array_reverse($ay);
//print_r($ay);
/////////////////////////////////günlük toplamlar dizisindeki değerleri ayın günlerine dağıtıyoruz////////////
for( $iii=0; $iii<$loop+2; $iii++ )
{

if($gunluktoplamy[$ay[$iii]] !=''){
 $d_ord_ids[$iii] = implode('_', $order_ids[$ay[$iii]]);
}
  if(count($d_ord_ids[$iii]) == 0) { $d_ord_ids[$iii] = '0'; }else{  }
  
  if($gunluktoplamy[$ay[$iii]] !=''){
  $data_arr[$iii] = array_sum($gunluktoplamy[$ay[$iii]]);//rand(150, 1500);
  }

 if($data_arr[$iii] < 1 || $data_arr[$iii] == '') { $data_arr[$iii] = 0; }
  $order_qty[$iii] = count($gunluktoplamy[$ay[$iii]]);//rand(1, 55);

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<script type="text/javascript">
var chart1; // globally available
$(document).ready(function() {
var order_ids = new Array();
var order_ids = [<?php echo "'" .implode("','", array_reverse($d_ord_ids)). "'"; ?>];



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
            text: '<?php _e('Sales Chart With Daily Order Details'); ?>'
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
               text: 'Amount/Qty.'
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
            name: 'Daily Sales Total',
            data: [<?php echo implode(',', array_reverse($data_arr)); ?>]
            , pointStart: Date.UTC(<?php echo $today['year'];?>, <?php echo $today['mon']-2;?>, <?php echo $today['mday'];?>),
        pointInterval: 24 * 3600 * 1000 // one day
         }, {
            name: 'Order Qty.',
            data: [<?php echo implode(',', array_reverse($order_qty)); ?>],
             pointStart: Date.UTC(<?php echo $today['year'];?>, <?php echo $today['mon']-2;?>, <?php echo $today['mday'];?>),
        pointInterval: 24 * 3600 * 1000 // one day
         }]
      });
   });

</script>
<?php /*print_r($data_arr);*/  ?>
<div id="chart-container-1" style="width: 100%; height: 400px"></div>
