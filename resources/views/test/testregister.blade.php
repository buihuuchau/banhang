<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Register</title>
</head>

<body>
    <form action="" method="post">
        <label>Account</label>
        <input type="text" name="acc" id="acc">
        <div id="ok"></div>
        <label>Password</label>
        <input type="password" name="pwd" id="pwd">
        <button type="submit">Gửi</button>
    </form>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#acc', function() {
            var acc = $(this).val();
            $.ajax({
                url: "checkacc",
                type: "get",
                data: {
                    "acc": acc,
                },
                success: function(data) {
                    $("#ok").html(data);
                    $('.auto-load').hide();
                },
            });
        });
    });
</script>

</html>