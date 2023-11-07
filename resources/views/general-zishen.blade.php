@extends('layouts.general')

@if ($code)
    @section('title', '會員资料更新')
@else
    @section('title', '加入資深會員')
@endif

@section('css')
    <style>
        #school-wraper div:not(:first-child) {
            display: none
        }
    </style>
@endsection

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

            $('#_form').on('submit', function() {
                update_modal();
                $("#myModal").modal('show');
                return false;
            });


            //提交表单信息到后台
            $('#submit-btn').click(function() {
                $('#error-wrap').hide();
                //通过ajax提交信息
                let url = window.location.href;
                let data = $('#_form').serialize();
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json'
                }).done(function(res) {
                    //显示错误信息
                    $('#error-wrap').hide();
                    $('#succ-wrap').hide();
                    if (res.error - 0) {
                        $('#error-msg').html(res.msg);
                        $('#error-wrap').show();
                    } else {
                        $('#succ-wrap').show();
                        $('#_form')[0].reset();
                        if (res.msg) {
                            $('#succ-msg').html(res.msg);
                        }
                        $('#after-submit').show();
                    }
                    $("#myModal").modal('hide');

                });

            });



            // 更新相应的值到弹窗
            function update_modal() {
                let zh_name = $('#chiname').val();
                let en_name = $('#engname').val();
                let mobile = $('#typePhone').val();
                let email = $('#email').val();

                //根据当前选择的工作 更新对应的信息
                let radios = $('#work-info input[name="workerinfo"]');

                let selIndex = radios.index(radios.filter(':checked'));


                let worker_par = $('#school-wraper').children().eq(selIndex);
                let woker_info_name = worker_par.find('input').val();
                let worker_info_label = worker_par.find('label').html();

                $('#zh_name').text(zh_name);
                $('#en_name').text(en_name);
                $('#mobile_copy').text(mobile);
                $('#email_copy').text(email);
                $('#woker_info_label').text(worker_info_label + ':');
                $('#woker_info_name').text(woker_info_name);

            }
        });
    </script>
@endsection




@section('tip')
    @if ($code)
        <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
            <h1 class="display-4 fw-normal">會員資料更新</h1>
        </div>
    @else
        <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
            <h1 class="display-4 fw-normal">加入資深會員</h1>
        </div>
        <div>
            <p class="fs-5 ">「資深會員」細則</p>
            <p class="fs-5 pb-5">填寫入會申請表，遞交後經執委會審定資格及通過，可獲推薦成為資深會員，申請者在繳交$150會費後，將獲電郵電子會員證。
                <br>
                資深會員每年須繳交$150會費，除可參與本會活動，享有會員福利及購物優惠外，在周年大會具投票權及參選權。
            </p>
        </div>
    @endif



@endsection


@section('main')

    <div id="succ-wrap" class="mt-4 mb-4" style="display:none;">
        <div class="alert alert-success alert-dismissible" role="alert">
            <div id="succ-msg">
                <div class="mt-4 mb-4 mx-auto text-center">
                    <h1 class="display-4 fw-normal">提交完成</h1>
                </div>
                <p class="fs-5 text-center display-4 fw-normal" id="succ-msg">
                    感謝您登記成為資深/永久會員
                    <br />
                    我們將安排專人聯絡您辦理入會手續，請留意電郵和手提電話。
                </p>

            </div>
        </div>
    </div>


    <div id="error-wrap" class="mt-4 mb-4" style="display:none;">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <div id="error-msg"></div>
            {{--            <button type="button" class="btn-close"   aria-label="Close"></button> --}}
        </div>
    </div>


    <form action="" id="_form">
        @csrf
        <input type="hidden" name="code" value="{{ $code }}">

        <div class="form-group pb-3">
            <label for="chiname">中文姓名</label>
            <input type="text" class="form-control" value="{{ $member->chiname }}" name="zh_name" id="chiname"
                placeholder="中文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="engname">英文姓名</label>
            <input type="text" required class="form-control" value="{{ $member->engname }}" name="en_name" id="engname"
                placeholder="英文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="typePhone">手提電話</label>
            <input type="tel" required class="form-control" value="{{ $member->phone }}" name="mobile" id="typePhone"
                placeholder="手提電話">
        </div>

        <div class="form-group pb-3">
            <label for="exampleInputEmail1">個人電郵</label>
            <input type="email" required class="form-control" value="{{ $member->email }}" name="email" id="email"
                aria-describedby="emailHelp" placeholder="個人電郵">
        </div>

         <div class="form-group pb-3">
            <label for="password">密 碼</label>
            <input type="password" required class="form-control" minlength="8" value="" name="password" id="password" aria-describedby="passwordHelp" placeholder="密 碼">
            <div id="passwordHelp" class="form-text">8位或以上</div>
        </div>


        <div id="work-info" class="mt-3 mb-3">

            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" @if ($member->job_type == 4) checked @endif
                    id="exampleRadios4" name="workerinfo" value="4">
                <label class="form-check-label" for="exampleRadios4">
                    退休教師
                </label>
            </div>


            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" @if ($member->job_type == 3) checked @endif
                    id="exampleRadios3" name="workerinfo" value="3">
                <label class="form-check-label" for="exampleRadios3">
                    從事與教育相關的工作
                </label>
            </div>

        </div>

        <div id="school-wraper">
            <div class="form-group pb-3">
                <label for="school">前任教學校</label>
                <input type="text" class="form-control" value="{{ $member->company }}" name="pre-school"
                    placeholder="前任教學校">
            </div>

            <div class="form-group pb-3">
                <label for="school">工作機構</label>
                <input type="text" class="form-control" value="{{ $member->company }}" name="work-school"
                    placeholder="工作機構">
            </div>
        </div>


        <div class="form-group pb-5">
            <label for="post">種 類</label>
            <select name="company_type" class="form-select" aria-label="Default select example">
                <option value="0" @if ($member->company_type == 0) selected @endif>選擇</option>
                <option value="1" @if ($member->company_type == 1) selected @endif>幼兒園</option>
                <option value="2" @if ($member->company_type == 2) selected @endif>小學</option>
                <option value="3" @if ($member->company_type == 3) selected @endif>中學</option>
                <option value="4" @if ($member->company_type == 4) selected @endif>大學</option>
            </select>
        </div>

        <div class="form-group pb-5">
            <label for="post">職位</label>
            <input type="text" required class="form-control" name="job_name" value="{{ $member->job_name }}"
                id="post" placeholder="職位">
        </div>

        <div class="form-group pb-3">
            <label for="exampleInputEmail1">推薦人</label>
            <input type="text" class="form-control" value="{{ $member->recommender }}" name="recommender"
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="推薦人">
        </div>

        <div class="d-grid">
            <button type="submit" id="btn" class="btn btn-primary">提交</button>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        資深會員申請
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row g-3">

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">姓　　名:</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    <span id="zh_name"></span>
                                    (<span id="en_name"></span>)
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">手提電話:</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    <span id="mobile_copy"></span>(或用作日後通訊之用)
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">個人電郵:</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    <span id="email_copy"></span>(用作日後通訊之用)
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label" id="woker_info_label">任教學校:</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    <span id="woker_info_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            本人謹此證明以上資料均屬真實無誤。
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit-btn">確 認 </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">修改</button>
                </div>
            </div>
        </div>
    </div>

@endsection
