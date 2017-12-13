require([
  'jquery',
  'jquery/ui'
], function($){

  $(document).ready(function() {
    
	//$('.quick_find').keyup(function(event){

    $('body').on('keyup', '.quick_find', function () {

        var ajaxurl = 'search/product';
        var data_id = $(this).attr('data-num');
        var search_text = $(this).val();
            $.ajax({
                showLoader: true,
                url: ajaxurl,
                data: {search_text: search_text},
                type: "POST",
                dataType: 'json'
            }).done(function (data) {

                var listitems = '';
                $('#suggesstionbox_'+data_id+' ul').empty();
                for (var i = 0; i < data.products.length; i++) {
                    var user = data.products[i];
                    listitems += '<li data-num="'+data_id+'" data-product="'+ user.name+'" data-prodid="'+ user.id+'" >' + user.name + '</li>';
                }
                 $('#suggesstionbox_'+data_id+' ul').append(listitems);
                
                $(this).val(data);
            });

        });



 $('body').on('click', '.suggesstionbox ul li', function () {
         var datanum = $(this).attr('data-num');
         $('#product_'+datanum).val($(this).attr('data-product')); 
         $('#prodid_'+datanum).val($(this).attr('data-prodid')); 
         $('#suggesstionbox_'+datanum+' ul').empty();
    });



    var maxField = 16; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper'); 
    var x = 6; 
    $(addButton).click(function(){ 
      var fieldHTML = '<div class="row"><div class="column"><div class="suggesstionbox" id="suggesstionbox_'+x+'"><ul></ul></div><input type="text" name="product[]" class="quick_find" id="product_'+x+'" data-num="'+x+'" /> <input type="hidden" name="prod_id[]" id="prodid_'+x+'"  /></div><div class="column"><input type="text" name="quality[]" class="quality" id="quality_'+x+'" /></div></div>';
        if(x < maxField){ 
            x++; 
            $(wrapper).append(fieldHTML); 
        }
    });
    




});

 function selectproduct(val) {
    $("#suggesstion-box").hide();
}


}); 
