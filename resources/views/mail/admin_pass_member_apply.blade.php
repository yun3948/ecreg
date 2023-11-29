@component('mail::message')

# 親愛的 {{ $username }}

您已成功申請成為教評{{ $member_level }}!
以下為您的電子會員證：

![電子會員證]({{ $card_img }})

有關本會舉辦的活動和資訊請瀏覽本會網站。
www.edconvergence.org.hk
(此電郵為系統自動發出，請勿回覆。) 


@endcomponent
