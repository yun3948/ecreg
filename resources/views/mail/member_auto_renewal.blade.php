@component('mail::message')

# 親愛的 {{ $username }} 

由於您的會籍即將到期，系統現在為您自動更新會籍，隨函已附上新的電子會員證。
如需變更會籍，請登入教評會員系統(www.edconvergence.org.hk)申請。

有關本會舉辦的活動和資訊請瀏覽本會網站。www.edconvergence.org.hk 
(此電郵為系統自動發出，請勿回覆。)

![電子會員證]({{ $card_img }})

@endcomponent