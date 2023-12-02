@component('mail::message')

# 親愛的 {{ $username }} 
 
@if ($member->member_type == 1)
抱歉，您未能成功申請成為資深會員。

以下為申請成為教評資深會員的條件：
1. 繳交$150 教評會費
2. 經執委會審定資格及通過    
    
@endif

@if ($member->member_type == 2)    
抱歉，您暫未符合資格成為教評永久會員。

以下為申請成為教評永久會員的條件：
1. 兩年或以上教評資深會員
2. 繳交$900 教評會費
3. 經執委會審定資格及通過
@endif



有關本會舉辦的活動和資訊請瀏覽本會網站.
www.edconvergence.org.hk
(此電郵為系統自動發出，請勿回覆。)

@endcomponent
