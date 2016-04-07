$(function () {
    $(".post").on("click", ".addcom", function () {
        var value = $(this).closest("div").find("#pid").val();
      //  alert(value);
        var content = $(this).closest("div").find("#comment").val();
      //  alert(content);

        var new1=$('<br/><textarea id="new_comment" readonly="1"  >'+ content +'</textarea>');
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
              var button=$('<a class="btn delete_button btn-danger btn-xs" href="/user/commentdelete/id/'+id+'">delete</a>');
              $("#new_comment").parent().append(button);
            }
         });
    });
});