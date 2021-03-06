$(document).ready(function(){
    var $newsTable=$('#newstable tbody');
    var token=null;

    refreshNews();
    getToken();
    //添加新闻
    $("#btnsubmit").click(function(e){
        e.preventDefault();
        //输入判断
        if($('#newstitle').val()===""||$('#newstype').val()===""||$('#newsimg').val()===""||$('#newstime').val()===""||$('#newssrc').val()===""){
            if($('#newstitle').val()===""){
                $('#newstitle').parent().addClass('has-error');
            }else{
                $('#newstitle').parent().removeClass('has-error');
            }
            if($('#newstype').val()===""){
                $('#newstype').parent().addClass('has-error');
            }else{
                $('#newstype').parent().removeClass('has-error');
            }
            if($('#newstime').val()===""){
                $('#newstime').parent().addClass('has-error');
            }else{
                $('#newstime').parent().removeClass('has-error');
            }
            if($('#newsimg').val()===""){
                $('#newsimg').parent().addClass('has-error');
            }else{
                $('#newsimg').parent().removeClass('has-error');
            }
            if($('#newssrc').val()===""){
                $('#newssrc').parent().addClass('has-error');
            }else{
                $('#newssrc').parent().removeClass('has-error');
            }
        }else{
            var jsonNews={
                newstitle:$("#newstitle").val(),
                newstype:$("#newstype").val(),
                newsimg:$("#newsimg").val(),
                newssrc:$("#newssrc").val(),
                newstime:moment($("#newstime").val()).format(),
                newstoken:token
            };
            //提交添加
            $.ajax({
                url:'server/insert.php',
                type:'post',
                data:jsonNews,
                datatype:'json',
                success:function(data){
                    refreshNews();
                    $("#newstitle").val('');
                    $("#newsimg").val('');
                    $("#newssrc").val('');
                    $("#newstime").val('');
                    getToken();
                }
            });
        }
    });
    //删除新闻的功能
    var deleteId=null;
    $newsTable.on('click','.btn-danger',function(e){
        $("#deleteModal").modal('show');
        deleteId=$(this).parent().prevAll().eq(5).html();
    });
    $("#deleteModal #confirmDelete").click(function(e){
        if(deleteId){
            $.ajax({
                url:'server/delete.php',
                type:'post',
                data:{newsid:deleteId},
                success:function(data){
                    console.log('删除成功');
                    $("#deleteModal").modal('hide');
                    refreshNews();
                }
            });
        }
    });
    //修改新闻的功能
    var updateId=null;
    $newsTable.on('click','.btn-primary',function(e){
        $("#updateModal").modal('show');
        updateId=$(this).parent().prevAll().eq(5).html();
        $.ajax({
            url:'server/curnews.php',
            type:'get',
            datatype:'json',
            data:{newsid:updateId},
            success:function(data){
               $('#unewstitle').val(data[0].newstitle);
               $('#unewstype').val(data[0].newstype);
               $('#unewsimg').val(data[0].newsimg);
               $('#unewssrc').val(data[0].newssrc);
               var utime=data[0].newstime.split(' ')[0];
               $('#unewstime').val(utime);
            }
        });
    });
    $("#updateModal #confirmUpdate").click(function(e){
       $.ajax({
           url:'server/update.php',
           type:'post',
           data:{
                newstitle:$('#unewstitle').val(),
                newstype:$('#unewstype').val(),
                newsimg:$('#unewsimg').val(),
                newssrc:$('#unewssrc').val(),
                newstime:$('#unewstime').val(),
                id:updateId,
                newstoken:token         
           },
           success:function(data){
                $('#updateModal').modal('hide');
                refreshNews();
                getToken();
           }
       });
    });



    function refreshNews(){
        //清空表
        $newsTable.empty();

        $.ajax({
            url:'server/getnews.php',
            type:'get',
            datatype:'json',
            success:function(data){
                /*console.log(data);*/
                data.forEach(function(item,index,array){
                    var $tdid=$('<td>').html(item.id);
                    var $tdtitle=$('<td>').html(item.newstitle);
                    var $tdtype=$('<td>').html(item.newstype);
                    var $tdimg=$('<td>').html(item.newsimg);
                    var $tdsrc=$('<td>').html(item.newssrc);
                    var $tdtime=$('<td>').html(item.newstime);
                    var $tdctrl=$('<td>');
                    var $btnupdate=$('<button>').addClass('btn btn-primary btn-xs').html('修改');
                    var $btndelete=$('<button>').addClass('btn btn-danger btn-xs').html('删除');
                    $tdctrl.append($btnupdate,$btndelete);
                    var $tRow=$('<tr>');
                    $tRow.append($tdid,$tdtitle,$tdtype,$tdimg,$tdsrc,$tdtime,$tdctrl);
                    $newsTable.append($tRow);
                })
            }
        });

    }

    function getToken(){
        $.ajax({
            url:'server/token.php',
            type:'get',
            datatype:'json',
            success:function(data){
               token=JSON.parse(data).success;
            }
        });
    }
})

