@component('mail::message')

# 親愛的 {{ $username }} 

點擊按鈕前往官網修改會員信息
@component('mail::button', ['url' => $url,'color' => 'success'])
點擊修改
@endcomponent

有關本會舉辦的活動和資訊請瀏覽本會網站。
www.edconvergence.org.hk
(此電郵為系統自動發出，請勿回覆。)


@endcomponent
