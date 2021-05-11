<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
    *{
        padding:0px;
        margin:0px;
    }
    #wrapper{
        width:1000px;
        margin:10px auto;
        background: #f1f1f1;
        padding:20px; 
    }
    .chat_wrapper{
        width:70%;
        margin:10px auto;
        background:#ffff;
    }
    #chat{
        min-height:500px;
        height:500px;
        overflow:auto;
        border:1px solid #b3b3b3;
        padding:10px;
    }
    .textarea{
        width:97%;
        border:1px solid #b3b3b3;
        outline:none;
        padding:10px;
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
<?php
    session_start();
    $_SESSION['username']='shivam';
    ?>
    <div id="wrapper">
    <div class="chat_wrapper">
    <div id="chat"></div>
    <form method= "POST" id="messageFrm">
    <textarea name="message" class="textarea" rows="2" cols="3"></textarea>
    </form>
    <div>
    </div>
    <script>
    
    LoadChat();

    setInterval(function(){
        LoadChat();

    },1000);

    function LoadChat(){
        $.post('handlers/messages.php?action=getMessages',function(response){
            $('#chat').html(response);
            $('#chat').scrollTop($('#chat').prop('scrollHeight'));
        });
    }
    $('.textarea').keyup(function(e){
        if(e.which == 13){
            $('form').submit();
            LoadChat();
        }
    });
    
    $('form').submit(function(){
        var message = $('.textarea').val();
        $.post('handlers/messages.php?action=sendMessage&message='+message,function(response){
            if(response == 1){
                LoadChat();
                document.getElementById('messageFrm').reset();
            }
        })
        return false;
    })
    </script>
</body>
</html>