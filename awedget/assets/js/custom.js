$(document).ready(function() {
   /*********************** Dependable Dropdown *********************/

   $('#category').change(function(){
      $("#sub_category").empty();
      var id = $('#category').val();

      $.ajax({
         type: "POST",
         url: hostname +"common/ajax_get_sub_category_by_category/" + id,
         success: function(func_data)
         {
            var item='';
            $.each(func_data,function(id,name)
            {
               item+='<option value="'+id+'">'+name+'</option>';
            });
            $("#sub_category").append(item);

         }
      });
   });


// function category_dd(sl){
//    //Category Dropdown
//    $('#category_'+sl).change(function(){
//       $('.sub_category_val_'+sl).addClass('form-control input-sm');
//       $(".sub_category_val_"+sl+"> option").remove();
//       var id = $('#category_'+sl).val();

//       $.ajax({
//          type: "POST",
//          url: hostname +"common/ajax_get_sub_category_by_category/" + id,
//          success: function(func_data)
//          {
//             $.each(func_data,function(id,name)
//             {
//                var opt = $('<option />');
//                opt.val(id);
//                opt.text(name);
//                $('.sub_category_val_'+sl).append(opt);
//             });
//          }
//       });
//    });
// }

   // Item
   // $('#sub_category').change(function(){
   //    $('.item_val').addClass('form-control input-sm');
   //    $(".item_val > option").remove();
   //    var id = $('#category').val();

   //    $.ajax({
   //      type: "POST",
   //      url: hostname +"common/ajax_get_item_by_sub_category/" + id,
   //      success: function(func_data)
   //      {
   //        $.each(func_data,function(id,name)
   //        {
   //          var opt = $('<option />');
   //          opt.val(id);
   //          opt.text(name);
   //          $('.item_val').append(opt);
   //       });
   //     }
   //  });
   // });


});   