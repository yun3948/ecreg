<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div>
        <div>
            请点击以下连接修改您的会员信息！
            @component('mail::button', ['url' => $link, 'color' => 'primary'])
                点击修改
            @endcomponent
            <div>
                如果无法点击，请手动复制连接到浏览器进行访问！
                <div>
                {{ $link }}
                </div>
            </div>

        </div>
    </div>
</body>
</html>
