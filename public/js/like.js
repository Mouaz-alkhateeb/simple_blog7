$('.like').on('click',function(){
  var like_s = $(this).attr('data-like');
  var post_id = $(this).attr('data-post_id');
  post_id=post_id.slice(0,-2);
  $.ajax({
      type : 'POST',
      url : url,
      data :{like_s: like_s,post_id: post_id,_token:token},
       success:function(data){  
         if(data.is_like == 1)
            {
                $('*[data-post_id="'+ post_id +'_l"]').removeClass('btn-secondary').addClass('btn-success');
                $('*[data-post_id="'+ post_id +'_d"]').removeClass('btn-danger').addClass('btn-secondary');

                var current_like= $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text();
                var new_like=parseInt(current_like) +1;
                $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text(new_like);

                if(data.change_like==1)
                {
                    var current_dislike= $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text();
                    var new_dislike=parseInt(current_dislike) - 1;
                    $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text(new_dislike); 
                }
            }
            if(data.is_like == 0)
            {
                $('*[data-post_id="'+ post_id +'_l"]').removeClass('btn-success').addClass('btn-secondary');
                var current_like= $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text();
                var new_like=parseInt(current_like) -1;
                $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text(new_like);
            }  
       }
   })
});


$('.dislike').on('click',function(){
    var like_s = $(this).attr('data-like');
    var post_id = $(this).attr('data-post_id');
    post_id=post_id.slice(0,-2);
    $.ajax({
        type : 'POST',
        url : url_dis,
        data :{like_s: like_s,post_id: post_id,_token:token},
         success:function(data){               
           if(data.is_dislike == 1)
              {
                  $('*[data-post_id="'+ post_id +'_d"]').removeClass('btn-secondary').addClass('btn-danger');
                  $('*[data-post_id="'+ post_id +'_l"]').removeClass('btn-success').addClass('btn-secondary');

                  var current_dislike= $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text();
                  var new_dislike=parseInt(current_dislike) + 1;
                  $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text(new_dislike);
                 
                  if(data.change_dislike==1)
                  {
                      var current_like= $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text();
                      var new_like=parseInt(current_like) - 1;
                      $('*[data-post_id="'+ post_id +'_l"]').find('.like_count').text(new_like); 
                  }

              }
              if(data.is_dislike == 0)
              {
                  $('*[data-post_id="'+ post_id +'_d"]').removeClass('btn-danger').addClass('btn-secondary');

                  var current_dislike= $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text();
                  var new_dislike=parseInt(current_dislike) - 1;
                  $('*[data-post_id="'+ post_id +'_d"]').find('.dislike_count').text(new_dislike);
              }  
         }
     })
  });
  
  