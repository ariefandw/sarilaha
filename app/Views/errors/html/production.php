<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title>Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
        body {
            margin: 0;
            padding: 0;
            background-color: #223;
            color: #fff;
            font-family: 'Noto Sans', Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding-top: 100px;
        }

        h1 {
            font-size: 5em;
            margin-bottom: 30px;
            animation: color-change 5s infinite;
        }

        p {
            font-size: 24px;
            margin-bottom: 50px;
            animation: color-change 5s infinite;
        }

        #smiley {
            font-size: 120px;
            margin-bottom: 30px;
            animation: rotate 5s linear infinite;
        }

        @keyframes color-change {
            0% {
                color: #fff;
            }

            50% {
                color: #ffcc00;
            }

            100% {
                color: #fff;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="smiley">⚙️</div>
        <h1>Oops...</h1>
    </div>

    <script>
        // var colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet', 'pink', 'brown', 'gray'];
        // var i = 0;
        // setInterval(function () {
        //     document.body.style.backgroundColor = colors[i];
        //     i = (i + 1) % colors.length;
        // }, 100);
    </script>
</body>

</html>



<!-- <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= lang('Errors.whoops') ?></title>

    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

    <div class="container text-center">

        <h1 class="headline"><?= lang('Errors.whoops') ?></h1>

        <p class="lead"><?= lang('Errors.weHitASnag') ?></p>

    </div>

</body>

</html> -->