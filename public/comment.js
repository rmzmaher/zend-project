$(function () {
var uid=1;
    $(".post").on("click", ".addcom", function () {
        alert("hna");
        var value = $(this).closest("div").find("#pid").val();
        alert(value);
        var content = $(this).closest("div").find("#comment").val();
        alert(content);
        var new1=$('<h5>'+ content +'</h5>');
        //var button=$('<a class="btn btn-danger" href="commentdelete/id/' '">delete</a>');
        //<input type="checkbox" class="chek" checked>
       // console.log($this);
        $(this).parent().closest("div").next().append(new1);
       // $(this).parent().closest("div").next().append(button);
        $.ajax({
         url:"/user/commentcreate",
         method:"POST",
         data:{'content':content,'post_id':value,'user_id':uid},
         });
    });
});