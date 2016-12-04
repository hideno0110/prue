/**
 * Created by hidenori on 2016/09/04.
 */

(function(documet){

    $(document).ready(function(){

        console.log('function start:',this);
        //デフォルトのパターン
//			$("#edit-table > tbody > tr > td.edit-table2").click(edit_toggle());
        //teratailのパターン
        if($("#edit-table").find(".shop .shop_prefecture").length) {
            console.log('shop_prefecture start');
            $target_type = 'shop_prefecture';
            console.log('shop_prefecture this:',this);
            $("#edit-table").find(".shop .shop_prefecture").click(edit_toggle());
        }
        else if($("#edit-table").find(".inventory ").length) {
            console.log('invenotry start');

            $("#edit-table").find(".inventory .free").click(
                // function () {
                //     console.log('free start');
                //     $target_type = 'free';
                //     edit_toggle();
                //     console.log('edit_toggle end');
                // }
            edit_toggle()
            );

            $("#edit-table").find(".inventory .memo").click(
                // function () {
                //     console.log('memo start');
                //     $target_type = 'memo';
                //     edit_toggle();
                //     console.log('edit_toggle end');
                // }
            edit_toggle()
            );
        }

    });

    function edit_toggle(){
        console.log('this1 : ',this);

        var edit_flag = false;
        console.log(edit_flag);
        return function(){
            console.log('test2');
            if(edit_flag) return;
            //デフォルトのパターン

            console.log('this2 : ',this);
            var $input = $("<input>").attr("type","text").val($(this).text());


            $target_id =  $(this).parent().find(".id").text();

            $target_type = $(this).attr("class");
            console.log('$target_type : ',$target_type);
            console.log('$target_id出力 : ',$target_id);
            console.log('$target_type出力 : ',$target_type);

            //CSRF取得
            $csrf = $('meta[name=csrf-token]').attr('content');
            console.log('$csrf : ',$csrf);

            $(this).html($input);

            $("input", this).focus().blur(function(){
                save(this);
                $(this).after($(this).val()).unbind().remove();
                edit_flag = false;
            });
            edit_flag = true;

        }
    }

    function save(elm){
        $target_text = $(elm).val();
        console.log('saveメソッド : ','id:',$target_id,'target_text:',$target_text,'target_type:',$target_type,'csrf:',$csrf);

        $.ajax(
            {
                type: "POST", //POSTで渡す
                url: "jquerypost", //POST先
                data:
                {
                    "target_id":$target_id, //id
                    "target_text":$target_text, //
                    "target_type":$target_type, //
                    "_token":$csrf
                },
                // async: false,
                success: function(hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
                {
                    if(hoge==0) //返り値が0→成功
                    {
                        console.log('正常終了しました');
                    }
                    else if(hoge==1) //返り値が1→失敗
                    {
                        console.log('失敗しました');
                    }
                },
                error: function(XMLHttpRequest,textStatus,errorThrown) //通信失敗
                {
                    console.log('処理できませんでした');
                }
            });


    }
})(document);





//Javascript AUTO COMPLEMENT
// $(function()
// {
//     console.log('HELLO!');
//     $( "#q" ).autocomplete({
//         source: "autocomplete",
//         minLength: 3,
//         select: function(event, ui) {
//             $('#q').val(ui.item.value);
//         }
//     });
//     console.log('bye!');
// });

$(document).ready(function(){
    $('#q').keyup(function () {
        var q=$(this).val();
        if(q.length>1) {

            $.ajax
            ({
                type: "GET",
                url: "http://hack.dev/admin/autocomplete",
                data: {q:q},
                contentType: "json",
                // cache: false,
                success: function(data)
                {
                    // $('#q').val(data[0].value);

                        response(data);

                }
            });
        }
    });

});