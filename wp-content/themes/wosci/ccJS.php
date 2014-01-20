<SCRIPT TYPE="text/javascript">
<!--

 jQuery(document).ready(function(){

jQuery('input[name="cc_number"],input[name="cc_checkcode"]').keypad({keypadOnly: false});
<?php

/*
	jQuery('input[type="text"], select').live('click', function() {
	
	var name = jQuery(this).attr('name')
	
	//jQuery('input[CHECKED]').removeAttr('CHECKED');
	if(name !='ykboos_cc_taksit'){
	//document.checkout_shipping.payment[0].checked=true;
	
	jQuery('#havale, #havale5, #havale6, #havale3, #havale2, #cod2, #defaultSelected, #ykboos').removeClass('moduleRowSelected');
	//jQuery('input[value="cc"]').attr('CHECKED', 'CHECKED');
	jQuery('tr[class="moduleRow"]:last').addClass('moduleRowSelected');
	jQuery('input[value="cc"]').attr('CHECKED', 'CHECKED');
	
	
	var con2 = jQuery('.moduleRowSelected input').val();
	}
	
	if(name =='ykboos_cc_taksit'){
	//document.checkout_shipping.payment[8].checked=true;
	jQuery('#havale, #havale5, #havale6, #havale3, #havale2, #cod2, #defaultSelected,#cc').removeClass('moduleRowSelected');
	//jQuery('input[value="cc"]').attr('CHECKED', 'CHECKED');
	jQuery('#ykboos').addClass('moduleRowSelected');
	
	var con2 = jQuery('.moduleRowSelected input').val();
	}
	});

*/
?>



	jQuery('select[name="bonuskart_cc_taksit"]').hide();
	jQuery('select[name="finansbank_cc_taksit"]').hide();
	jQuery('select[name="ykb_cc_taksit"]').hide();

	jQuery('#bonus_taksit').hide();
	jQuery('#cardfinans_taksit').hide();
	jQuery('#ykb_taksit').hide();

	jQuery('.finans_taksit_not').hide();
	jQuery('.bonus_taksit_not').hide();
	jQuery('.ykb_taksit_not').hide();
	
		
	
function dojob(bk,ba)
{
//alert("Welcome " + bk + ", the " + ba);
jQuery('#bankaadi').text(ba);	


	if(bk !='')
		{
	
		jQuery('select[name="bonuskart_cc_taksit"]').hide();
		jQuery('select[name="finansbank_cc_taksit"]').hide();
		jQuery('select[name="ykb_cc_taksit"]').hide();
		
		}
		
	jQuery('input[name="bankaADI"]').val(ba);	
	if(bk==62)
	{
	jQuery('input[name="cc_number"]').css("background","url(<?php echo get_bloginfo('template_url').'/placeholder-bonus.png) no-repeat right 3px top 6px #ffffff';?>");
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="bonuskart_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('#bonus_taksit').show();
	jQuery('.bonus_taksit_not').show();
	jQuery('input[name="bankaID"]').val("62");	
	}

	if(bk==111)
	{
	jQuery('input[name="cc_number"]').css("background","url(<?php echo get_bloginfo('template_url').'/placeholder-cardfinans.png) no-repeat right 3px top 6px #ffffff';?>");
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="finansbank_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('.finans_taksit_not').show();
	jQuery('input[name="bankaID"]').val("111");	
	}

	if(bk==67)
	{
	jQuery('input[name="cc_number"]').css("background","url(<?php echo get_bloginfo('template_url').'/placeholder-world.png) no-repeat right 3px top 6px #ffffff';?>");
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="ykb_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('#ykb_taksit').show();
	jQuery('.ykb_taksit_not').show();
	jQuery('input[name="bankaID"]').val("67");	
	}

	if(bk=='')
	{
	
	jQuery('select[name="bonuskart_cc_taksit"]').hide();
	jQuery('select[name="finansbank_cc_taksit"]').hide();
	jQuery('select[name="ykb_cc_taksit"]').hide();
	jQuery('select[name="bonuskart_cc_taksit"]').val(jQuery("#target option:first").val());
	jQuery('select[name="finansbank_cc_taksit"]').val(jQuery("#target option:first").val());
	jQuery('select[name="ykb_cc_taksit"]').val(jQuery("#target option:first").val());
	
	jQuery('#bonus_taksit').hide();
	jQuery('#cardfinans_taksit').hide();
	jQuery('#ykb_taksit').hide();
	jQuery('.finans_taksit_not').hide();
	jQuery('.bonus_taksit_not').hide();
	jQuery('.ykb_taksit_not').hide();
	}
}





function check (){
var kkn = jQuery('input[name="cc_number"]').val();

if( kkn.length < 6 ){
jQuery('input[name="cc_number"]').css("background","url(<?php echo get_bloginfo('template_url').'/placeholder.png) no-repeat right 3px top 6px #ffffff';?>");
dojob('','');
}
if( kkn.length > 5 ){
var prx6 = kkn.substring(0,6); 

//alert(prx6);

 jQuery.post("<?php echo get_bloginfo('template_url');?>/bin-list.php", { "kkprx": prx6 },
 function(data){
//   console.log(data.name); // John
//alert( data.ba + data.bk );
dojob(data.bk,data.ba);
 }, "json");




}
}

jQuery('input[name="cc_number"]').live('click keyup change',function () {
check ();
});
jQuery(window).load(function () {
check ();
});

/* var a = pos.success(function() { alert("second success"); })
    var b = pos.error(function() { alert("error"); })
    var c = pos.complete(function() { alert("complete"); });
alert(a +b +c);*/

});

//-->
</SCRIPT>