function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var span = document.createElement('span');
                span.innerHTML = ['<img style="width:320px; height:200px; float:left; " class="thumb" src="', e.target.result,
                    '" title="', theFile.name, '"/>'].join('');
                document.getElementById('list').innerHTML = '';
                document.getElementById('list').insertBefore(span, null);
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('filesPic').addEventListener('change', handleFileSelect, false);

var Log = document.getElementById("mess");
if(Log=="авторизуйтесь"){alert("авторизуйтесь!")}

    $(document).ready(function(){
        $(".agaxClose").click(function(){
            var msg = $(this).data('msg_id');
            var users = $(this).data('user_id');
            var louder = $(this).data('louder_id');
            var result = confirm('Удалить сообщение: ' + msg + ' Пользователя: ' + users);
            if(result) {
                $.ajax({
                    url: 'DelPost.php',
                    data: {nameDel: users, textDel: msg},
                    success: function(){
                        alert('Запись успешно удалена');
                    },
                    type: 'GET',
                    beforeSend: function () {
                        $("#"+louder).css("display", "block");
                        $("#"+louder).animate({opacity: 1}, 500);
                    }
                }).done(function (data) {
                    $("#"+louder).animate({opacity: 0}, 500, function () {
                        $("#"+louder).css("display", "none");
                    });
                });
                //после отработки функции, делаю редирект, чтобы увидеть результат.
                window.location.href = 'index.php';
            }});
    });
    $(document).ready(function(){
        $(".agaxEdit").click(function(){
            var msg = $(this).data('msg_id');
            var users = $(this).data('user_id');
            var louder = $(this).data('louder_id');
            var times = $(this).data('msg_time');
            
            var result = prompt('Введите текст для изменения сообщения');
            if(result) {
                $.ajax({
                    url: 'RedactPost.php',
                    data: {nameUpp: users, textUpp: result, oldText: msg, times:times},
                    success: function(){
                        alert('Запись изменена');
                    },
                    type: 'GET',
                    beforeSend: function () {
                        $("#"+louder).css("display", "block");
                        $("#"+louder).animate({opacity: 1}, 500);
                    }
                }).done(function (data) {
                    $("#"+louder).animate({opacity: 0}, 500, function () {
                        $("#"+louder).css("display", "none");
                    });
                });
                //после отработки функции, делаю редирект, чтобы увидеть результат.
                window.location.href = 'index.php';
            }});
    });

var LZW = {
    compress: function(uncompressed) {
        "use strict";

        var i, l,
            dictionary = {},
            w = '', k, wk,
            result = [],
            dictSize = 256;

        // initial dictionary
        for (i = 0; i < dictSize; i++) {
            dictionary[String.fromCharCode(i)] = i;
        }

        for (i = 0, l = uncompressed.length; i < l; i++) {
            k = uncompressed.charAt(i);
            wk = w + k;
            if (dictionary.hasOwnProperty(wk)) {
                w = wk;
            }
            else {
                result.push(dictionary[w]);
                dictionary[wk] = dictSize++;
                w = k;
            }
        }

        if (w !== '') {
            result.push(dictionary[w]);
        }

        result.dictionarySize = dictSize;
        return result;
    }
};