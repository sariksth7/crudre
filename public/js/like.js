    //var postId = 0;

      $(document).ready(function (){

          $('.like').on('click', function (event){
              event.preventDefault();
              let postId =$("input[id = post_id]").val();
              var isLike= event.target.previousElementSibling == null;
              //let islike = $("input[like = islike]").val();
            //  alert(postId);

              $.ajax({
                  url: "/like",
                  type: "POST",
                  data:{
                      _token: token,
                      //like: ,
                       //user_id: Auth::user()->id,
                      post_id: postId
                  },
                  success:function (response){
                      if(response.status == true){
                          $('#getLike').html(`<strong>`+response.data+`</strong>`)
                          if(response.like.like == 0){
                              $('#icon-color').css('color','black');
                          }else{
                              $('#icon-color').css('color','blue');

                          }
                      }
                  }
              });


          });



      });

