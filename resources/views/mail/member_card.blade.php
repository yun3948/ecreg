<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>會員提醒</title>
</head>
<body>

<div>
    <div>這是您的會員卡，請自行保存！</div>
    <div>
        <img src="{{ $message->embed($member->card_img) }}">
    </div>
</div>

</body>
</html>
