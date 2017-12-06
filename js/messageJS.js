$(document).ready(function(){
    $(".close").click(function(){
        var msg = $(this).data('msg_text');
        var usersTo = $(this).data('user_to');
        var usersFrom = $(this).data('user_from');
        var times = $(this).data('time');
        var idBlock = $(this).data('id_block');
        var result = confirm('Удалить?');
        if(result) {
            $.ajax({
                url: 'ViewMessage.php',
                data: {msg: msg, usersTo: usersTo, usersFrom: usersFrom, times:times},
                success: function(){
                    //скрытие блока
                    $("#"+idBlock).hide();
                    alert('Сообщение удалено');},
                type: 'GET',
                beforeSend: function () {
                    //скрытие блока
                    $("#"+idBlock).hide();
                }
            })}
    })});

$(document).ready(function(){
    $(".otvet").click(function(){
        var msg = prompt('Введите сообщение');
        var usersTo = $(this).data('user_to');
        var usersFrom = $(this).data('user_from');
        if(msg) {
            $.ajax({
                type: 'POST',
                url: 'Message.php',
                data: {usersTo: usersTo, msg: msg, UserFrom: usersFrom},
                success: function(res){
                    //res это ответ от пхп - в данном случае это ответ из класса Message -> pushToBase
                    alert(res);
                }
            });
        }});
});