$(function () {
    $(".post").on("click", ".addcom", function () {
        var value = $(this).closest("div").find("#pid").val();
      //  alert(value);
        var content = $(this).closest("div").find("#comment").val();
      //  alert(content);
        $(this).parent().closest("div").next().append("<div>");
        var new1=$('<br/><textarea cols="100%" id="new_comment" readonly="1"  >'+ content +'</textarea>');
        var user=$(this).parent().closest("div").find("#name").val();
        var uid=$(this).parent().closest("div").find("#usr").val();
        var usrapp=$('<br/><br/><small>'+ user +'</small><br/>');

        $(this).parent().closest("div").next().append(usrapp);
        $(this).parent().closest("div").next().append(new1);
        $.ajax({
         url:"/user/commentcreate",
         method:"POST",
         data:{'content':content,'post_id':value,'user_id':uid},
          success:function(data){
              alert(data);
              var id = data;
              var button=$('<a class="btn delete_button btn-danger btn-xs" href="/user/commentdelete/id/'+id+'/cid/'+1+'">delete</a>');
              var but=$('<a class="btn delete_button btn-warning btn-xs update" id="'+id+'">update</a>');
              $("#new_comment").parent().append(button);
              $("#new_comment").parent().append(but);
          }
         });
        $(this).parent().closest("div").next().append("<div>");
    });

    $(".maincomment").on("click",".update",function(){
        var comment_id=$(this).attr('id');
        if ($(this).closest("div").find("#comarea").attr('readonly')!=null)
        {
            $(this).closest("div").find("#comarea").removeAttr('readonly');
        }else {
            $(this).closest("div").find("#comarea").prop('readonly', true);

        var content = $(this).closest("div").find("#comarea").val();
        alert(content);
        $.ajax({
            url:"/user/editcomment",
            method:"POST",
            data:{'comment_id':comment_id,'content':content},
            });
        }
    });

});