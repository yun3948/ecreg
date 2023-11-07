@extends('layouts.general')
@if($code)
    @section('title','會員资料更新')
@else
    @section('title','加入普通會員')
@endif

@section('js')
    <script>
        jQuery(function($){
            $('#work-info').on('change','input[name="workerinfo"]',function(){

                let index = $(this).index('input[name="workerinfo"]');

                //显示对应的学校。清空
                let child = $('#school-wraper').children();
                child.hide();
                child.eq(index).show();
            });

            $('#_form').on('submit',function(){
                update_modal();
                $("#myModal").modal('show');
                return false;
            });

            //發送再次認證郵件
            $('#error-wrap').on('click','#need_check_btn',function(){

                console.log('click---')
                let url = '{{ $check_email_url }}'
                let data = {
                    '_token':'{{csrf_token()}}'
                };
                $.ajax({
                    method:'post',
                    url:url,
                    data:data,
                    dataType:'json'
                }).done(function(res){
                    $('#error-wrap').hide();
                    $('#succ-wrap').hide();

                    //展示發送成功
                    $('#succ-msg').html(res.msg);
                    $('#succ-wrap').show();

                });
                return false;
            })
            //提交表单信息到后台
            $('#submit-btn').click(function(){
                $('#error-wrap').hide();
                //通过ajax提交信息
                let url =  window.location.href;
                let data = $('#_form').serialize();
                $.ajax({
                    method:'POST',
                    url:url,
                    data:data,
                    dataType:'json'
                }).done(function(res){
                    //显示错误信息
                    $('#error-wrap').hide();
                    $('#succ-wrap').hide();
                    if(res.error -0) {
                        if(res.need_check) {
                            res.msg  += '<a id="need_check_btn" href="javascript:;" class="btn btn-primary">重新發送驗證郵件</a>';
                        }

                        $('#error-msg').html(res.msg);
                        $('#error-wrap').show();
                    }else{
                        $('#succ-wrap').show();
                        $('#_form')[0].reset();
                        if(res.msg) {
                            $('#succ-msg').html(res.msg);
                        }
                        $('#after-submit').show();
                    }
                    $("#myModal").modal('hide');

                });

            });



            // 更新相应的值到弹窗
            function update_modal(){
                let zh_name = $('#chiname').val();
                let en_name = $('#engname').val();
                let mobile = $('#typePhone').val();
                let email = $('#email').val();

                //根据当前选择的工作 更新对应的信息
                // let radios = $('#work-info input[name="workerinfo"]');
                //
                // let selIndex = radios.index(radios.filter(':checked'));


                // let worker_par = $('#school-wraper').children().eq(selIndex);
                // let woker_info_name = worker_par.find('input').val();
                // let worker_info_label = worker_par.find('label').html();

                $('#zh_name').text(zh_name);
                $('#en_name').text(en_name);
                $('#mobile_copy').text(mobile);
                $('#email_copy').text(email);
                // $('#woker_info_label').text(worker_info_label);
                // $('#woker_info_name').text(woker_info_name);

            }
        });

    </script>
@endsection




@section('tip')
    @if($code)
        <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
            <h1 class="display-4 fw-normal">會員資料更新</h1>
        </div>
    @else
        <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
            <h1 class="display-4 fw-normal">加入附屬會員</h1>
        </div>
        <div>
            <p class="fs-5 ">「附屬會員」細則</p>
            <p class="fs-5 pb-5">所有會員的家屬或非業界的人士，認同本會理念者，可填寫申請表成為附屬會員，遞交後獲電郵電子會員證。
                <br>無須繳付會費，可參與本會活動，享有會員福利，在周年大會中沒有投票權及參選權。
            </p>
        </div>
    @endif



@endsection


@section('main')

    <div id="succ-wrap" class="mt-4 mb-4" style="display:none;">
        <div   class="alert alert-success alert-dismissible" role="alert">
            <div id="succ-msg">
                <div class="mt-4 mb-4 mx-auto text-center">
                    <h1 class="display-4 fw-normal">提交完成</h1>
                </div>
                <p class="fs-5 text-center display-4 fw-normal" id="succ-msg">
                    為確保電郵地址正確，一封驗證郵件已傳送，請細閱郵件以完成註冊手續。
                </p>

            </div>
        </div>
    </div>


    <div id="error-wrap" class="mt-4 mb-4"  style="display:none;">
        <div   class="alert alert-danger alert-dismissible" role="alert">
            <div id="error-msg"></div>
            {{--            <button type="button" class="btn-close"   aria-label="Close"></button>--}}
        </div>
    </div>




    <form action="" id="_form">
        @csrf
        <input type="hidden" name="code" value="{{ $code }}">
        <div class="form-group pb-3">
            <label for="chiname">中文姓名</label>
            <input type="text" class="form-control" value="{{ $member->chiname }}" name="zh_name" id="chiname" placeholder="中文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="engname">英文姓名</label>
            <input type="text" required class="form-control" value="{{ $member->engname }}" name="en_name" id="engname" placeholder="英文姓名">
        </div>

        <div class="form-group pb-3">
            <label for="typePhone">手提電話</label>
            <input type="tel" required class="form-control" value="{{ $member->phone }}"  name="mobile" id="typePhone" for="typePhone" placeholder="手提電話">
        </div>

        <div class="form-group pb-3">
            <label for="password">密 碼</label>
            <input type="password" required class="form-control" minlength="8" value="" name="password" id="password" aria-describedby="passwordHelp" placeholder="密 碼">
            <div id="passwordHelp" class="form-text">8位或以上</div>
        </div>

  <div class="form-group pb-3">
            <label for="exampleInputEmail1">密 碼</label>
            <input type="password" required class="form-control" value="" name="password" id="password" aria-describedby="emailHelp" placeholder="密 碼">
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        附屬會員申請
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-3 col-form-label">姓　　名:</label>
                            <div class="col-sm-9">
                                <div class="form-control-plaintext">
                                    <span id="zh_name"></span>
                                    (<span id="en_name"></span>)
                                </div>

                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-3 col-form-label">手提電話:</label>
                            <div class="col-sm-9">
                                <div class="form-control-plaintext">
                                    <span id="mobile_copy"></span>(或用作日後通訊之用)
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-3 col-form-label">個人電郵:</label>
                            <div class="col-sm-9">
                                <div class="form-control-plaintext">
                                    <span id="email_copy"></span>(用作日後通訊之用)
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-12">
                                本人謹此證明以上資料均屬真實無誤。
                            </div>

                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit-btn">確  認 </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">修改</button>
                </div>
            </div>
        </div>
    </div>

@endsection
