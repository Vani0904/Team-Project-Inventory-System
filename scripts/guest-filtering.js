
var selector = '.our-p-products li';

$(selector).on('click', function(){
    $(selector).removeClass('active')
    $(this).addClass('active')
});

/*---box filter */
$(document).ready(function (){
  $('.our-p-products li').click(function(){
    const value = $(this).attr('data-filter');
    if(value == 'mix'){
      $('.our-product-box').show('1000');
    }
    else{
      $('.our-product-box').not('.'+value).hide('1000');
      $('.our-product-box').filter('.'+value).show('1000');
    }
  });

});