


//商品用
$('[name="persons_id"]').on('change',function(){
let persons_id = $(this).find('option:selected').val();
let parent_id = $(this).parents('form').data('id')

var products_id = '';
product_ajax(persons_id,products_id,parent_id)
    //時間差でoptionも変更 
    setTimeout(function() {
        var products_id = $('[data-id="'+parent_id+'"] [name="products_id"]').find('option:selected').data('value')

        
        product_option_ajax(persons_id,products_id,parent_id)
    }, 300)
})







//商品オプション用
$(document).on('change','[name="products_id"]',function(){
let products_id = $(this).find('option:selected').data('value')
let persons_id = $('[name="persons_id"]').find('option:selected').val()
let parent_id = $(this).parents('form').data('id')
// let persons_id = '';
product_option_ajax(persons_id,products_id,parent_id)

})







//商品オプション用
function product_option_ajax(persons_id,products_id,parent_id){
let url = '/customers/ajax/add_product_option_ajax/';
let name = '[data-id="'+parent_id+'"] [name="products_options_id"]';

ajax(persons_id,url,products_id,name)
}

//商品データ用
function product_ajax(persons_id,products_id,parent_id){
let url = '/customers/ajax/add_product_ajax/';
let name = '[data-id="'+parent_id+'"] [name="products_id"]';

ajax(persons_id,url,products_id,name)
}

//ajax
function ajax(persons_id,url,products_id,name){
let date_year = $('[name="search_date_year"]').val()
let date_month = $('[name="search_date_month"]').val()
 $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },    
  url: url,
  type: 'POST',
  data: {
    persons_id : persons_id,
    date_year : date_year,
    date_month : date_month,
    products_id : products_id,
},

success: function(data){
     $(name).html(data)
  },
  error: function(){
  }
});   
}
