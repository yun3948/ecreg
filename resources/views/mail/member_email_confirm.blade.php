@component('mail::message')

# 教育評議會 歡迎您

感謝您登記成為普通會員/附屬會員！
請按下確認按鈕以驗證電郵地址和確認註冊成為本會會員。

(此電郵為系統自動發出，請勿回覆。)

@component('mail::button', ['url' => $url])
    確認
@endcomponent

@endcomponent