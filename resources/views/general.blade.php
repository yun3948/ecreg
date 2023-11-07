@extends('layouts.general')
@section('title', '加入普通會員')

@section('tip')
    <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
        <h1 class="display-4 fw-normal">加入普通會員</h1>

    </div>

    <p class="fs-5 ">「會員」細則</p>
    <p class="fs-5 pb-5">填寫申請表，遞交後獲電郵電子會員證，無須繳付會費。
        <br>普通會員可參與本會舉辦的活動，享有會員福利，在本會周年大會中沒有投票權及參選權。
    </p>

@endsection


@section('main')
    <form>
        <div class="form-group pb-3">
            <label for="chiname">中文姓名</label>
            <input type="text" class="form-control" id="chiname" placeholder="中文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="engname">英文姓名</label>
            <input type="text" class="form-control" id="engname" placeholder="英文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="typePhone">手提電話</label>
            <input type="tel" class="form-control" id="typePhone" for="typePhone" placeholder="手提電話">
        </div>

        <div class="form-group pb-3">
            <label for="exampleInputEmail1">個人電郵</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="個人電郵">
        </div>

        <label for="form-check">工作狀況</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                現職教師
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                準教師
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
            <label class="form-check-label" for="exampleRadios3">
                從事與教育相關的工作

            </label>
        </div>
        <div class="form-check pb-3">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
            <label class="form-check-label" for="exampleRadios4">
                退休教師


            </label>
        </div>


        <div class="form-group pb-3">
            <label for="school">任教學校</label>
            <input type="text" class="form-control" id="school" placeholder="任教學校">
        </div>

        <div class="form-group pb-5">
            <label for="post">職位</label>
            <input type="text" class="form-control" id="post" placeholder="職位">
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>
@endsection
