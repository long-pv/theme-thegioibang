jQuery(document).ready(function($) {
    var submit1 = jQuery("#like_button");
    var submit1_value = jQuery("#like_button").val();
    var submit2 = jQuery("#dislike_button");
    var submit2_value = jQuery("#dislike_button").val();
    
    jQuery('input.like_button').on('change', function() {
        jQuery('input.like_button').not(this).prop('checked', false);  
    });
    
    
  
    submit1.click(function(){ 
        if(jQuery('input[name="like_button"]').is(':checked')){ 
           var count_value_item = 1;
           var like_dislike_checked = 1;
            jQuery('input[name="like_button"]').addClass('checked_box');
            jQuery('input[name="dislike_button"]').removeClass('checked_box');  
            
        }
        else{
           var count_value_item = 0;  
           jQuery('input[name="like_button"]').removeClass('checked_box');
        }
        
        var data = {
            action: 'my_action',
            like: 1,
            dislike: 0,
            dislike_remove: 0,
            like_dislike_checked: like_dislike_checked,
            security : MyAjax.security,
            post_id:submit1_value,
            count_value: count_value_item
            
        }
        jQuery.post(MyAjax.ajaxurl, data, function(response) {
            jQuery('.like_content').empty();
            jQuery('.like_content').append(response);
        });
    });
  
    submit2.click(function(){ 
        if(jQuery('input[name="dislike_button"]').is(':checked')){ 
            var count_value_item2 = 1;
            var like_dislike_checked = 0;
            jQuery('input[name="dislike_button"]').addClass('checked_box'); 
            jQuery('input[name="like_button"]').removeClass('checked_box'); 
          
        }else{
            var count_value_item2 = 0; 
             jQuery('input[name="dislike_button"]').removeClass('checked_box'); 
        }
        
        var data = {
            action: 'my_action',
            dislike: 1,
            like: 0,
            like_remove: 0,
            like_dislike_checked: like_dislike_checked,
            security : MyAjax.security,
            post_id2:submit2_value,
            count_value2: count_value_item2
        }
        
        jQuery.post(MyAjax.ajaxurl, data, function(response) {
            
            jQuery('.dislike_content').empty();
            jQuery('.dislike_content').append(response);
                
        });
        
    });
  
  
  

  
  
  
  
  
  
});
