@component('mail::message')
# 會員提醒
點擊按鈕前往官網修改會員信息
@component('mail::button', ['url' => $url,'color' => 'success'])
點擊修改
@endcomponent

感謝,<br>
{{ config('app.name') }}
@endcomponent
