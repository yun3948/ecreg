@extends('layouts.user_center')

@section('js')
    <script>
        jQuery(function($) {
            $('#work-info').on('change', 'input[name="workerinfo"]', function() {

                let index = $(this).index('input[name="workerinfo"]');

                //显示对应的学校。清空
                let child = $('#school-wraper').children();
                child.hide();
                child.eq(index).show();
            });
            
          
            //根据上次选择 自动修改对应的展示字段
            function change_work(){
                const job_type = {{$member->job_type}} 
                const index = $('#work-info').find('input[name="workerinfo"]:checked').index('input[name="workerinfo"]');
                    let child = $('#school-wraper').children();
                child.hide();
                child.eq(index).show();
            }

              change_work();
        })
    </script>
@endsection

@section('content')
    <div class="m-10">
    @if(session('message') ) 
    <div class="alert alert-success"> {{ session('message') }}</div>
    @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

       
        <form class="row g-4" action="" method="post" id="_form">
            @csrf
             <div>
            <h2>修改會員資料</h2>
        </div>

            <div class="col-md-6">
                <label for="chiname">中文姓名</label>
                <input type="text" class="form-control" value="{{ $member->chiname }}" name="zh_name" id="chiname"
                    placeholder="中文姓名">
            </div>

            <div class="col-md-6">
                <label for="engname">英文姓名</label>
                <input type="text" required class="form-control" value="{{ $member->engname }}" name="en_name"
                    id="engname" placeholder="英文姓名">
            </div>

            <div class="col-md-6">
                <label for="typePhone">手提電話</label>
                <input type="tel" required class="form-control" value="{{ $member->phone }}" name="mobile"
                    id="typePhone" placeholder="手提電話">
            </div>

            <div class="col-md-6">
                <label for="exampleInputEmail1">個人電郵</label>
                <input type="email" required class="form-control" value="{{ $member->email }}" name="email"
                    id="email" aria-describedby="emailHelp" placeholder="個人電郵">
            </div>

            {{-- <div class="form-group pb-3">
                <label for="password">密 碼</label>
                <input type="password" required class="form-control" minlength="8" value="" name="password"
                    id="password" aria-describedby="passwordHelp" placeholder="密 碼">
                <div id="passwordHelp" class="form-text">8位或以上</div>
            </div> --}}


            <div id="work-info">

                <label for="form-check">工作狀況</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" @if ($member->job_type == 1) checked @endif
                        id="exampleRadios1" name="workerinfo" value="1">
                    <label class="form-check-label" for="exampleRadios1">
                        現職教師
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" @if ($member->job_type == 2) checked @endif type="radio"
                        id="exampleRadios2" name="workerinfo" value="2">
                    <label class="form-check-label" for="exampleRadios2">
                        準教師
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" @if ($member->job_type == 3) checked @endif
                        id="exampleRadios3" name="workerinfo" value="3">
                    <label class="form-check-label" for="exampleRadios3">
                        從事與教育相關的工作
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" @if ($member->job_type == 4) checked @endif
                        id="exampleRadios4" name="workerinfo" value="4">
                    <label class="form-check-label" for="exampleRadios4">
                        退休教師
                    </label>
                </div>
            </div>

            <div id="school-wraper">
                <div class="form-group pb-3">
                    <label for="school">任教學校</label>
                    <input type="text" class="form-control" value="{{ $member->company }}" name="teach-school"
                        placeholder="任教學校">
                </div>

                <div class="form-group pb-3">
                    <label for="school">就讀院校</label>
                    <input type="text" class="form-control" value="{{ $member->company }}" name="study-school"
                        placeholder="就讀院校">
                </div>

                <div class="form-group pb-3">
                    <label for="school">工作機構</label>
                    <input type="text" class="form-control" value="{{ $member->company }}" name="work-school"
                        placeholder="工作機構">
                </div>

                <div class="form-group pb-3">
                    <label for="school">前任教學校</label>
                    <input type="text" class="form-control" value="{{ $member->company }}" name="pre-school"
                        placeholder="前任教學校">
                </div>
            </div>


            <div class="col-md-6">
                <label for="post">種 類</label>
                <select name="company_type" class="form-select" aria-label="Default select example">
                    <option value="0" @if ($member->company_type == 0) selected @endif>選擇</option>
                    <option value="1" @if ($member->company_type == 1) selected @endif>幼兒園</option>
                    <option value="2" @if ($member->company_type == 2) selected @endif>小學</option>
                    <option value="3" @if ($member->company_type == 3) selected @endif>中學</option>
                    <option value="4" @if ($member->company_type == 4) selected @endif>大學</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="post">職位</label>
                <input type="text" name="job_name" required class="form-control" value="{{ $member->job_name }}"
                    id="post" placeholder="職位">
            </div>

            <div class="d-grid">
                <button type="submit" id="btn" class="btn btn-primary">提交</button>
            </div>

        </form>

    </div>
@endsection
