<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thong bao RealTime</title>
</head>

<body>
    <h1 id="thongbao"></h1>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        //Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
        var pusher = new Pusher('e4b77d349747386ed7bb', {
            encrypted: true,
            cluster: "ap1"
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('mychanel');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('myevent', function(data) {
            alert(data.message);
            $("#thongbao").html(data.message);
        });
    </script>
</body>



</html>