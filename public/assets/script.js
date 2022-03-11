//
$(document).ready(function()
{
    $("#myBtn").click(function()
    {
        $("#myModal").modal();
    });

//
//
//     $('#cat').change(function()
//     {
//         var cat_id = $('#cat').val();
//         if(cat_id != '')
//         {
//             $.ajax(
//             {
//                 url: url_Site + "Pages/fetch_subcat",
//                 method: "POST",
//                 data:{cat_id:cat_id},
//                 success:function(data)
//                 {
//                     $('#subcat').html(data);
//                 }
//             });
//         }
//     });
//
//     // ajouter au panier
//     $('.add_cart').click(function(){
//
//         // console.log(url_Base);
//         var product_id = $(this).data("productid");
//         var product_name = $(this).data("productname");
//         var product_price = $(this).data("price");
//         var quantity = $('#' + product_id).val();
//         if(quantity != '' && quantity > 0)
//         {
//         $.ajax({
//             url: url_Site + "Pages/add_cart",
//             method:"POST",
//             data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity},
//             success:function(data)
//             {
//             alert("Product Added into Cart");
//             $('#cart_details').html(data);
//             $('#' + product_id).val('');
//             }
//         });
//         }
//         else
//         {
//         alert("Please Enter quantity");
//         }
//     });
//
//     // confirmation de supprision de produit
//     $(document).on('click', '.button_del', function()
//     {
//         // var prod_id = $(this).attr("id");
//         var prod_id = $('#id').val();
//         if(confirm("Are you sure you want to remove this?"))
//         {
//             $.ajax(
//             {
//                 url:"<?php echo base_url(); ?>Pages/product_delete",
//                 method:"POST",
//                 data:{prod_id:prod_id},
//                 success:function(data)
//                 {
//                     // alert("Product removed from Cart");
//                     // $('#cart_details').html(data);
//                 }
//             });
//         }
//         else
//         {
//             return false;
//         }
//     });
});
//
//
// jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
// jQuery('.quantity').each(function()
// {
//     var spinner = jQuery(this),
//     input = spinner.find('input[type="number"]'),
//     btnUp = spinner.find('.quantity-up'),
//     btnDown = spinner.find('.quantity-down'),
//     min = input.attr('min'),
//     max = input.attr('max');
//
//     btnUp.click(function()
//     {
//         var oldValue = parseFloat(input.val());
//         if (oldValue >= max) {
//         var newVal = oldValue;
//         } else {
//         var newVal = oldValue + 1;
//         }
//         spinner.find("input").val(newVal);
//         spinner.find("input").trigger("change");
//     });
//
//     btnDown.click(function()
//     {
//         var oldValue = parseFloat(input.val());
//         if (oldValue <= min)
//         {
//             var newVal = oldValue;
//         } else {
//             var newVal = oldValue - 1;
//         }
//         spinner.find("input").val(newVal);
//         spinner.find("input").trigger("change");
//     });
//
// });
//
//
