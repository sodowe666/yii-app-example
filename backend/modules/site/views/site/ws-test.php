<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/7/13
 * Time: 11:03
 */
?>

aldkfjalsdkjflasdf
<html>
<head>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>

<body>
<h3>WebSocket Go</h3>
<pre id="output"></pre>

<script>
    url = 'ws://localhost:8080/v1/ws';
    c = new WebSocket(url);

    send = function(data){
        $("#output").append((new Date())+ " ==> "+data+"\n");
        c.send(data)
    };

    c.onmessage = function(msg){
        $("#output").append((new Date())+ " <== "+msg.data+"\n");
        console.log(msg)
    };

    c.onopen = function(){
        setInterval(
            function(){
                send("aaaaasdfasdfkljasldfkjasldfjlasdjflasdjflasjdflasjdflaskjdflaskdjfalksdjflskdjf111")
            }
            , 1000 )
    };
    c.onclose = function (msg) {
        console.log(msg)

    }
</script>

</body>
</html>