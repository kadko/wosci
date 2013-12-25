jQuery(document).ready( function() {

   jQuery("#fat-btn").click( function() {
    var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)

function inArray(needle, haystack) { //http://stackoverflow.com/questions/784012/javascript-equivalent-of-phps-in-array
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

 function remove(arr, item) { // http://stackoverflow.com/a/18165553/1793482
      for(var i = arr.length; i--;) {
          if(arr[i] === item) {
              arr.splice(i, 1);
          }
      }
  }



var opname = []; var allname = [];  var id = {}; var key =''; var value ='';

jQuery(".btn-group .active input").each(function(){ /* checked */
if( jQuery(this).length ){ if( !inArray(jQuery(this).attr("name"), opname)  )
 {
 
	opname.push(jQuery(this).attr("name"));
	
	key = jQuery(this).data("opid");
	value = jQuery(this).val(); 
	id[key] = parseInt(value);
	 
 }
 }
 });

jQuery(".btn-group label input").each(function(){ /* All */
 if( jQuery(this).length ){ if( !inArray(jQuery(this).attr("name"), allname)  ){ allname.push(jQuery(this).attr("name")); } }

  });


//var ids = { 3: 9, 4: 4 };


for (var i = 0; i < opname.length; i++) {

remove(allname, opname[i]);

}

var otitle = '';
for (var i = 0; i < allname.length; i++) {
otitle +=  jQuery('*[data-name="'+ allname[i] +'"]').data("title")+'\n';
jQuery('*[data-name="'+ allname[i] +'"]').popover();

if (jQuery('*[data-name="'+ allname[i] +'"]').next('div.popover:visible').length){
  // popover is visible
}else{
jQuery('*[data-name="'+ allname[i] +'"]').click();
}

}

console.log(allname); 

console.log(id); 


//alert(allname[0]);
if(typeof allname[0] != 'undefined' ){ 

var btn = jQuery('#fat-btn');
btn.button('reset');
//alert("Please Select Following Product Options:\n\n" + otitle);
return false; 

}else{  }




      
      post_id = jQuery(this).attr("data-post_id")
      nonce = jQuery(this).attr("data-nonce")
      qty = jQuery('#quantity').val()
      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "the_cart_add", post_id : post_id, nonce: nonce, qty : qty, id : id },
         success: function(response) {
            if(response.type == "success") {
	
	jQuery('#myModal').modal('show');
	jQuery('.modal-body').empty();
	jQuery('#cartcount').empty();
	jQuery('#cartcount').append(response.cart_count);
	jQuery('.modal-body').append(response.cart_text);
	
	jQuery('#popoverContent').empty();
	jQuery("#popoverContent").append(response.cpo);
	
	var btn = jQuery('#fat-btn');
	btn.button('reset');
       
   
            }
            else {
               alert("Your vote could not be added")
            }
         }
      })   

   })


   jQuery(".listingbutton").click( function() {

        
	var post_id = jQuery(this).data("prodid");
	var selector = jQuery(this).data("jq_slctr");
	var currency = jQuery('#cart_quantity'+selector+ ' input[name="currency"]').val();
	var final_price = jQuery('#cart_quantity'+selector+ ' input[name="final_price"]').val();
	var cart_quantity = jQuery('#cart_quantity'+selector+ ' .abcd').val(); 


      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "shopping_cart", products_id : post_id },
         success: function(response) {
            if(response.type == "success") {
	//alert(response.durum);
	jQuery("#sub_total").text(response.sub_totaljs);
	var sa  = response.sepetadet;
	
	jQuery('#cartcount').empty();
	jQuery("#cartcount").append(sa);
	
	jQuery('#popoverContent').empty();
	jQuery("#popoverContent").append(response.cpo);

     if ( sa === '0' ){ 
     jQuery('#sepetmain').highlightFade({speed:1220,start:'#ff0000',end:'#ffffff',attr:'backgroundColor',complete:jQuery('#sepetmain,#sub_total').remove()}) 
     jQuery('#actionbuttons').remove();
     jQuery('.table-responsive').remove();
     //jQuery('#message').empty();
     jQuery('#cart-empty').show();
     jQuery("#sub_txt").empty();
     
     }
   jQuery('.urun'+selector).highlightFade({speed:1220,start:'#ff0000',end:'#ffffff',attr:'backgroundColor',complete:sil(selector)})
            }
            else {
               alert("error")
            }
         }
      })   

   })






   jQuery(".abcd").click( function() {

	var prid =  jQuery(this).attr("id");//"#jq_slctr_"+jQuery(this).attr("id");
	var prfullid =  jQuery(this).data("id");
	var post_id =  jQuery('#cart_quantity'+prid+ ' input[name="products_id[]"]').val(); // jQuery(this).attr("id");
	
	var currency = jQuery('#cart_quantity'+prid+ ' input[name="currency"]').val();
	var final_price = jQuery('#cart_quantity'+prid+ ' input[name="final_price"]').val();
	var cart_quantity = jQuery('#cart_quantity'+prid+ ' .abcd').val(); 
	var tax_class_id = jQuery('#cart_quantity'+prid+ ' input[name="tax_class_id"]').val(); 

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "cart_qty", products_id : post_id, f_id : prfullid, currency : currency, final_price: final_price, cart_quantity:cart_quantity, tax_class_id:tax_class_id },
         success: function(response) {
            if(response.type == "success") {
	
	jQuery("#jq_slctr_"+prid).highlightFade({speed:120,start:'#4ddc26',end:'#ffffff',attr:'backgroundColor'})
	jQuery("#jq_slctr_"+prid).empty();
	jQuery("#jq_slctr_"+prid).append(response.product_totaljs);
	jQuery("#sub_total").text(response.sub_totaljs);
        //alert(response.vote_count);
   
	jQuery('#cartcount').empty();
	jQuery('#cartcount').append(response.sepetadet);
   
	jQuery('#popoverContent').empty();
	jQuery("#popoverContent").append(response.cpo);

	if(response.sepetadet==0){
	//jQuery("#popoverContent").append(response.cartisempty);
	}
            }
            else {
               alert("error")
            }
         }
      })   

   })








//BEGIN new shipping address JS

jQuery('#myModal').on('submit', 'form[name="checkout_address_shipping"]',function( event ){

	var stateselect = jQuery('form[name="checkout_address_shipping"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="checkout_address_shipping"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="checkout_address_shipping"] input[name="lastname"]').val();
	var company = jQuery('form[name="checkout_address_shipping"] input[name="company"]').val();
	var street_address = jQuery('form[name="checkout_address_shipping"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="checkout_address_shipping"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="checkout_address_shipping"] input[name="postcode"]').val();
	var city = jQuery('form[name="checkout_address_shipping"] input[name="city"]').val();
	var state = jQuery('form[name="checkout_address_shipping"] input[name="state"]').val();

if( typeof state !== 'undefined' || stateselect != '' ){
if(  firstname.length < 3 || lastname.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	var btn = jQuery('#save_new_shipping_address');
	btn.button('reset');
	if(  firstname.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="firstname"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="firstname"]').removeClass("redborder");
	}
	
	if(  lastname.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="lastname"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="lastname"]').removeClass("redborder");
	}
	
	if(  company.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="company"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="company"]').removeClass("redborder");
	}
	
	if(  street_address.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="street_address"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="street_address"]').removeClass("redborder");
	}
	
	if(  suburb.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="suburb"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="suburb"]').removeClass("redborder");
	}
	
	if(  postcode.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="postcode"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="postcode"]').removeClass("redborder");
	}
	
	if(  city.length < 3 ){
	jQuery('form[name="checkout_address_shipping"] input[name="city"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_shipping"] input[name="city"]').removeClass("redborder");
	}
	
	//alert("Formda eksik doldurulmuş alanlar bulunuyor!");
	return false;
}
}
  var formdata = jQuery('#myModal form[name="checkout_address_shipping"]').serializeArray();
  console.log(formdata);
	jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "ca_nsa", formdata:formdata, s_or_p: "s" },
         success: processJson
      })
jQuery('select[name="shipping_address_select"]').trigger( "change" );
event.preventDefault();

});


jQuery('#myModal')
   .on('click', '#save_new_shipping_address',  function(){
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)
	
	jQuery('form[name="checkout_address_shipping"]').submit();

    });


//END new shipping address JS

//BEGIN new payment address JS

jQuery('#myModal4').on('submit', 'form[name="checkout_address_payment"]',function( event ){

	var stateselect = jQuery('form[name="checkout_address_payment"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="checkout_address_payment"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="checkout_address_payment"] input[name="lastname"]').val();
	var company = jQuery('form[name="checkout_address_payment"] input[name="company"]').val();
	var street_address = jQuery('form[name="checkout_address_payment"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="checkout_address_payment"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="checkout_address_payment"] input[name="postcode"]').val();
	var city = jQuery('form[name="checkout_address_payment"] input[name="city"]').val();
	var state = jQuery('form[name="checkout_address_payment"] input[name="state"]').val();

if( typeof state !== 'undefined' || stateselect != '' ){
if(  firstname.length < 3 || lastname.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	var btn = jQuery('#save_new_payment_address');
	btn.button('reset');

	if(  firstname.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="firstname"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="firstname"]').removeClass("redborder");
	}
	
	if(  lastname.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="lastname"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="lastname"]').removeClass("redborder");
	}
	
	if(  company.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="company"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="company"]').removeClass("redborder");
	}
	
	if(  street_address.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="street_address"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="street_address"]').removeClass("redborder");
	}
	
	if(  suburb.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="suburb"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="suburb"]').removeClass("redborder");
	}
	
	if(  postcode.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="postcode"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="postcode"]').removeClass("redborder");
	}
	
	if(  city.length < 3 ){
	jQuery('form[name="checkout_address_payment"] input[name="city"]').addClass("redborder");
	}else{
	jQuery('form[name="checkout_address_payment"] input[name="city"]').removeClass("redborder");
	}
	//alert("Formda eksik doldurulmuş alanlar bulunuyor!");
	return false;
}
}
  var formdata = jQuery('#myModal4 form[name="checkout_address_payment"]').serializeArray();
  console.log(formdata);
	jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "ca_nsa", formdata:formdata , s_or_p: "p"},
         success: processJson
      }) 
event.preventDefault();

});


jQuery('#myModal4')
   .on('click', '#save_new_payment_address',  function(){
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)
	
	jQuery('form[name="checkout_address_payment"]').submit();

    });


//END new payment address JS


//BEGIN edit shipping address JS

jQuery('#myModal2').on('submit', 'form[name="Edit_Shipping_Address"]',function( event ){
	var stateselect = jQuery('form[name="Edit_Shipping_Address"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="Edit_Shipping_Address"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="Edit_Shipping_Address"] input[name="lastname"]').val();
	var company = jQuery('form[name="Edit_Shipping_Address"] input[name="company"]').val();
	var street_address = jQuery('form[name="Edit_Shipping_Address"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="Edit_Shipping_Address"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="Edit_Shipping_Address"] input[name="postcode"]').val();
	var city = jQuery('form[name="Edit_Shipping_Address"] input[name="city"]').val();
	var state = jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').val();

if(  firstname.length < 3 || lastname.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	
	if(  firstname.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="firstname"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="firstname"]').removeClass("redborder");
	}
	
	if(  lastname.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="lastname"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="lastname"]').removeClass("redborder");
	}
	
	if(  company.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="company"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="company"]').removeClass("redborder");
	}
	
	if(  street_address.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="street_address"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="street_address"]').removeClass("redborder");
	}
	
	if(  suburb.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="suburb"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="suburb"]').removeClass("redborder");
	}
	
	if(  postcode.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="postcode"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="postcode"]').removeClass("redborder");
	}
	
	if(  city.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="city"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="city"]').removeClass("redborder");
	}
	
	if(  city.length < 3 ){
	jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').removeClass("redborder");
	}
	
	var btn = jQuery('#myModal2 #save_edit_shipping');
	btn.button('reset');

	return false;
}

if( typeof state !== 'undefined' ){
	if(  state.length < 3 ){
		if(  state.length < 3 ){
		jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').addClass("redborder");
		}else{
		jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').removeClass("redborder");
		}
	
	var btn = jQuery('#myModal2 #save_edit_shipping');
	btn.button('reset');
	return false;
	}
}

  var formdata = jQuery('#myModal2 form[name="Edit_Shipping_Address"]').serializeArray();
  
   /* Because serializeArray() ignores unset checkboxes and radio buttons: */
    formdata = formdata.concat(
            jQuery('#myModal2 form[name="Edit_Shipping_Address"] input[type=checkbox]:not(:checked)').map(
                    function() {
                        return {"name": this.name, "value": "off"}
                    }).get()
    );
  
  console.log(formdata);
  
	jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "ca_esa", formdata:formdata },
         success: processJson
      }) 

jQuery('select[name="shipping_address_select"]').trigger( "change" );
event.preventDefault();

});


jQuery('#myModal2')
   .on('click', '#save_edit_shipping',  function(){
        
        var btn = jQuery('#myModal2 #save_edit_shipping');
	btn.button('loading');
	
	jQuery('form[name="Edit_Shipping_Address"]').submit();
	setTimeout(function () {
        btn.button('reset')
        }, 300000)
    });



//END edit shipping address JS


//BEGIN edit payment address JS

jQuery('#myModal3').on('submit', 'form[name="Edit_Payment_Address"]',function( event ){
	var stateselect = jQuery('form[name="Edit_Payment_Address"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="Edit_Payment_Address"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="Edit_Payment_Address"] input[name="lastname"]').val();
	var company = jQuery('form[name="Edit_Payment_Address"] input[name="company"]').val();
	var street_address = jQuery('form[name="Edit_Payment_Address"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="Edit_Payment_Address"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="Edit_Payment_Address"] input[name="postcode"]').val();
	var city = jQuery('form[name="Edit_Payment_Address"] input[name="city"]').val();
	var state = jQuery('form[name="Edit_Payment_Address"] input[name="state"]').val();


if( firstname.length < 3 || lastname.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	
	if(  firstname.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="firstname"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="firstname"]').removeClass("redborder");
	}

	if(  lastname.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="lastname"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="lastname"]').removeClass("redborder");
	}

	if(  company.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="company"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="company"]').removeClass("redborder");
	}

	if(  street_address.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="street_address"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="street_address"]').removeClass("redborder");
	}

	if(  suburb.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="suburb"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="suburb"]').removeClass("redborder");
	}	

	if(  postcode.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="postcode"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="postcode"]').removeClass("redborder");
	}

	if(  city.length < 3 ){
	jQuery('form[name="Edit_Payment_Address"] input[name="city"]').addClass("redborder");
	}else{
	jQuery('form[name="Edit_Payment_Address"] input[name="city"]').removeClass("redborder");
	}

	var btn = jQuery('#myModal3 #save_edit_payment');
	btn.button('reset');
	return false;
}


if( typeof state !== 'undefined' ){
	if(  state.length < 3 ){
		if(  state.length < 3 ){
		jQuery('form[name="Edit_Payment_Address"] input[name="state"]').addClass("redborder");
		}else{
		jQuery('form[name="Edit_Payment_Address"] input[name="state"]').removeClass("redborder");
		}
	
	var btn = jQuery('#myModal3 #save_edit_payment');
	btn.button('reset');
	return false;
	}
}



  var formdata = jQuery('#myModal3 form[name="Edit_Payment_Address"]').serializeArray();
  
   /* Because serializeArray() ignores unset checkboxes and radio buttons: */
    formdata = formdata.concat(
            jQuery('#myModal3 form[name="Edit_Payment_Address"] input[type=checkbox]:not(:checked)').map(
                    function() {
                        return {"name": this.name, "value": "off"}
                    }).get()
    );
  
  console.log(formdata);
  
	jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "ca_esa", formdata:formdata, s_or_p: "p" },
         success: processJson
      }) 
event.preventDefault();

});


jQuery('#myModal3')
   .on('click', '#save_edit_payment',  function(){
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 300000)
	
	jQuery('form[name="Edit_Payment_Address"]').submit();

    });



//END edit payment address JS

//address select register BEGIN
jQuery('select[name="shipping_address_select"]').on( "change", function() {
	jQuery('#shipping_modules').animate({ opacity: 0.2 }, 500 );
	jQuery('#loading_shipping_modules').show();
	var adrID = jQuery(this).val();	
	jQuery('#edit_shipping_address').attr('href', 'edit-shipping-address/?edit='+ adrID +'&from=Edit_Shipping_Address');

jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "set_address", adrID: adrID, register: "shipping"},
         success: function(response) {
            if(response.type == "success") {
	

	jQuery('#shipping_modules').empty();
	jQuery('#shipping_modules').append(response.shipping_modules);
	//alert(response.updated);
	//console.log(response.shipping_modules);
	
	
	
	jQuery('#loading_shipping_modules').hide();
	jQuery('#shipping_modules_loaded').show();
	jQuery('#shipping_modules').animate({ opacity: 1 }, 500 );
	setTimeout( "jQuery('#shipping_modules_loaded').hide();",4000 );

	//jQuery('#shipping_modules_loaded').animate({ opacity: 1 }, 5000 );
	//jQuery('#shipping_modules_loaded').animate({ opacity: 0 }, 200 );
	//jQuery('#shipping_modules_loaded').css("opacity","1");
            } else {
               alert("error")
            }
         }
      })

});


jQuery('select[name="payment_address_select"]').change(function () {

	var adrID = jQuery(this).val();	
	jQuery('#edit_payment_address').attr('href', '?page_id=83&edit='+ adrID +'&from=Edit_Payment_Address');

jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "set_address", adrID: adrID, register: "payment"},
         success: function(response) {
            if(response.type == "success") {
	
   alert(response.bacb);
            } else {
               alert("error")
            }
         }
      })

});

//address select register END


//delete address book entry BEGIN

jQuery('.removeaddress').click(function () {

	var adrID = jQuery(this).data("delete");
if(confirm('Are You Sure to Delete Address?')){
jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "delete_address", adrID: adrID,},
         success: function(response) {
            if(response.type == "success") {
jQuery('*[data-adid="' + adrID + '"]').remove();
   alert("Address Deleted!");
   
   
            } else {
               alert("error")
            }
         }
      })

}


});
//delete address book entry END



})

function sil(selector){
jQuery('.urun'+selector).fadeOut(800, function(){
jQuery('.urun'+selector).remove();
});
}




function loadXMLDocNew(key, key2) {

// jQuery('#states_s').html('<img style="vertical-align:middle" src="/wp-content/plugins/custom-list-table-example/loading-line.gif">');


var spins = [
"■.",
"◢◣◤◥",
"▇ ▇ ",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#states_s'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.html("<div style='height:54px;'>"+spin[i]+"</div>");
    },50);



      jQuery.ajax({
         type : "post",
         dataType : "html",
         url : myAjax.ajaxurl,
         data : {action: "state_list", country : key , city_code : key2 },
         success: function(response) {
            if(response.type == "success") { }
            else {
              // alert("error")
            }
	//alert("");
	clearInterval(aaa);
    jQuery('#states_s').html(response);
   
           
         }
      })   

   }
   
   

function loadXMLDocNewp(key, key2) {

// jQuery('#states_s').html('<img style="vertical-align:middle" src="/wp-content/plugins/custom-list-table-example/loading-line.gif">');


var spins = [
"■.",
"◢◣◤◥",
"▇ ▇ ",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#states_p'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.html("<div style='height:54px;'>"+spin[i]+"</div>");
    },50);



      jQuery.ajax({
         type : "post",
         dataType : "html",
         url : myAjax.ajaxurl,
         data : {action: "state_list", country : key , city_code : key2 },
         success: function(response) {
            if(response.type == "success") { }
            else {
              // alert("error")
            }
	//alert("");
	clearInterval(aaa);
    jQuery('#states_p').html(response);
   
           
         }
      })   

   }
   
   

function loadXMLDocNewSA(key, key2) {

// jQuery('#states_s').html('<img style="vertical-align:middle" src="/wp-content/plugins/custom-list-table-example/loading-line.gif">');


var spins = [
"■.",
"◢◣◤◥",
"▇ ▇ ",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#statesNSA'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.html("<div style='height:54px;'>"+spin[i]+"</div>");
    },1.89);



      jQuery.ajax({
         type : "post",
         dataType : "html",
         url : myAjax.ajaxurl,
         data : {action: "state_list", country : key , city_code : key2 },
         success: function(response) {
            if(response.type == "success") { }
            else {
              // alert("error")
            }
	//alert("");
	clearInterval(aaa);
    jQuery('#statesNSA').html(response);
   
           
         }
      })   

   }


function loadXMLDocNewPA(key, key2) {

// jQuery('#states_s').html('<img style="vertical-align:middle" src="/wp-content/plugins/custom-list-table-example/loading-line.gif">');


var spins = [
"■.",
"◢◣◤◥",
"▇ ▇ ",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#statesNPA'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.html("<div style='height:54px;'>"+spin[i]+"</div>");
    },1.89);



      jQuery.ajax({
         type : "post",
         dataType : "html",
         url : myAjax.ajaxurl,
         data : {action: "state_list", country : key , city_code : key2 },
         success: function(response) {
            if(response.type == "success") { }
            else {
              // alert("error")
            }
	//alert("");
	clearInterval(aaa);
    jQuery('#statesNPA').html(response);
   
           
         }
      })   

   }
   
   
 //begin checkout shipping address JS
  function processJson(data) {
 	//alert(data.message); 
 	
 	if( data.message != 'tamam' ) {
	
	var fields = data.errorfields.split(" ");
    
	for (var i = 0; i < fields.length; i++) {

	jQuery('input[name="'+fields[i]+'"]').css("border", "solid 1px red");
   
	}
	jQuery('input[name="'+fields[0]+'"]').focus();
	}

	if( data.message == 'tamam' ) {
	
	
	jQuery('input').css("border", "");
	if( data.this_is == 'nsa' ) { jQuery('#myModal').modal('hide');  }
	if( data.this_is == 'npa' ) { jQuery('#myModal4').modal('hide'); }
	if( data.this_is == 'esa' ) { jQuery('#myModal2').modal('hide'); jQuery('#myModal3').modal('hide'); }
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').empty();
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').empty();
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').append(data.address);
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').append(data.address);
	if( data.this_is == 'nsa' ) {
		jQuery('select[name="shipping_address_select"]').prepend("<option value='"+ data.new +"'>"+data.address+"</option>");
		jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').prop('selected', true);
		jQuery('#edit_shipping_address').attr('href', '?page_id=83&edit='+ data.new +'&from=Edit_Shipping_Address');
	}
	
	if( data.this_is == 'npa' ) {
		jQuery('select[name="payment_address_select"]').prepend("<option value='"+ data.new +"'>"+data.address+"</option>");
		jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').prop('selected', true);
		jQuery('#edit_payment_address').attr('href', '?page_id=83&edit='+ data.new +'&from=Edit_Payment_Address');
	}
	
	
	if( data.this_is == 'esa' ) {
		jQuery('select[name="shipping_address_select"] option[value="' + data.edit + '"]').empty();
		jQuery('select[name="payment_address_select"] option[value="' + data.edit + '"]').empty();
		
		jQuery('select[name="shipping_address_select"] option[value="' + data.edit + '"]').append(data.address);
		jQuery('select[name="payment_address_select"] option[value="' + data.edit + '"]').append(data.address);	
		jQuery('*[data-labelid="' + data.edit + '"]').empty();
		jQuery('*[data-labelid="' + data.edit + '"]').append(data.address);	
	}
	
		jQuery('select[name="shipping_address_select"]').css("border", "solid 1px green");
		jQuery('select[name="payment_address_select"]').css("border", "solid 1px green");
	
	}
	
	if( data.this_is == 'nsa' ) {//?
	var btn = jQuery('#save_new_shipping_address');
	btn.button('reset');	
	}
	if( data.this_is == 'esa' ) {//?
	var btn = jQuery('#save_edit_shipping');
	btn.button('reset');
	}
	    
}
 //end  checkout shipping address JS
 
 jQuery(".addtowishlist").live('click', function( event ){
event.preventDefault();
var nonce = jQuery(this).attr("data-nonce");
var pID =  jQuery( this ).data( "id" );
jQuery( '*[data-id="'+pID+'"]' ).prop('disabled', true);
jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : { action: "add_to_wishlist", pID: pID, nonce: nonce },
         success: function(response) {
       
        jQuery( '*[data-id="'+pID+'"]' ).removeClass("btn-default");
        jQuery( '*[data-id="'+pID+'"]' ).addClass(response.btn);
        if(response.text != "") {
	jQuery( '*[data-id="'+pID+'"] small'  ).text(response.text);
	
	}
        
        console.log(response.uswl)
         if(response.type == "success") {

	} else {
         //      alert("error")
	}
	}
      })

}); 