$(function () {
    $(".post").on("click", ".addcom", function () {
        var value = $(this).closest("div").find("#pid").val();
      //  alert(value);
        var content = $(this).closest("div").find("#comment").val();
      //  alert(content);

        var new1=$('<br/><textarea readonly="1"  >'+ content +'</textarea>');
        var button=$('<a class="btn btn-danger btn-xs" href="/user/commentdelete/id/"?>delete</a>');
        var user=$(this).parent().closest("div").find("#name").val();
        var uid=$(this).parent().closest("div").find("#usr").val();
        var usrapp=$('<br/><br/><small>'+ user +'</small><br/>');

        $(this).parent().closest("div").next().append(usrapp);
        $(this).parent().closest("div").next().append(new1);
        $(this).parent().closest("div").next().append(button);
        $.ajax({
         url:"/user/commentcreate",
         method:"POST",
         data:{'content':content,'post_id':value,'user_id':uid},
         });
    });
});