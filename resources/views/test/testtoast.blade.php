<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('toast/dist/toast.min.css')}}">

    <title>Toast</title>
</head>

<body>


    <div class="container-fluid text-center">
        <button class="toast-btn btn btn-primary">Toast</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('toast/dist/toast.min.js')}}"></script>


    <script>
        const TYPES = ['info', 'warning', 'success', 'error'],
            TITLES = {
                'info': 'Notice!',
                'success': 'Awesome!',
                'warning': 'Watch Out!',
                'error': 'Doh!'
            },
            CONTENT = {
                'info': 'Hello, world! This is a toast message.',
                'success': 'The action has been completed.',
                'warning': 'It\'s all about to go wrong',
                'error': 'It all went wrong.'
            },
            POSITION = ['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'];

        $.toastDefaults.position = 'bottom-center';
        $.toastDefaults.dismissible = true;
        $.toastDefaults.stackable = true;
        $.toastDefaults.pauseDelayOnHover = true;

        $('.snack').click(function() {
            var type = TYPES[Math.floor(Math.random() * TYPES.length)],
                content = CONTENT[type];

            $.snack(type, content);
        });

        $('.toast-btn').click(function() {
            var rng = Math.floor(Math.random() * 2) + 1,
                type = TYPES[Math.floor(Math.random() * TYPES.length)],
                title = TITLES[type],
                content = CONTENT[type];

            if (rng === 1) {
                $.toast({
                    type: type,
                    title: title,
                    subtitle: '11 mins ago',
                    content: content,
                    delay: 5000
                });
            } else {
                $.toast({
                    type: type,
                    title: title,
                    subtitle: '11 mins ago',
                    content: content,
                    delay: 5000,
                    img: {
                        src: 'https://via.placeholder.com/20',
                        alt: 'Image'
                    }
                });
            }
        });
    </script>
</body>

</html>