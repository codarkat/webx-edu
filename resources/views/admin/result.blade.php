@extends('layouts.admin-layout')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h5 class="card-title">KẾT QUẢ</h5>
        </div>
        <input type="hidden" id="user_id" value="{{$result->user->id}}">
        <div class="card-body">
            <div class="example-container">
                <div class="example-content">
                    <div class="row p-5">
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">account_circle</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Họ và tên</a>
                                        <span class="file-manager-group-about">{{$result->user->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">description</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Chủ đề</a>
                                        <span class="file-manager-group-about">{{$topic->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">check_circle</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Số câu đúng</a>
                                        <span class="file-manager-group-about">{{$result->num_correct}} câu</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">remove_done</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Số câu sai</a>
                                        <span class="file-manager-group-about">{{$result->num_incorrect}} câu</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">pending_actions</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Thời gian bắt đầu</a>
                                        <span class="file-manager-group-about">{{$result->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="file-manager-group mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons text-success">alarm</i>
                                    <div class="file-manager-group-info flex-fill">
                                        <a href="#" class="file-manager-group-title">Thời gian nộp bài</a>
                                        <span class="file-manager-group-about">{{$result->updated_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="example-code p-5">
                        @foreach($questions as $index=>$q)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Câu {{$index+1}} <span id="text-result-{{$q->id}}"></span></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-description" style="white-space:pre">{!! $q->content !!}</p>
                                    <div class="example-container" id="bd-result-{{$q->id}}">
                                        @if($q->type == 'CHOICE')
                                            <div class="example-code" id="bg-result-{{$q->id}}">
                                                <i>Chọn một đáp án đúng</i>
                                            </div>
                                            <div class="example-content" >
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">Câu trả lời của bạn</label>
                                                        @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                                            @if($loop->last)
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="user-radio-{{$q->id}}-{{$index}}" type="radio" aria-label="Radio button for question" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @else
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="user-radio-{{$q->id}}-{{$index}}" type="radio" aria-label="Radio button for question" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Đáp án</label>
                                                        @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                                            @if($loop->last)
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="radio-{{$q->id}}-{{$index}}" type="radio" aria-label="Radio button for question" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control bg-light" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @else
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="radio-{{$q->id}}-{{$index}}" type="radio" aria-label="Radio button for question" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control bg-light" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($q->type == 'FORM')
                                            <div class="example-code" id="bg-result-{{$q->id}}">
                                                <i>Viết đáp án đúng (viết thường, đúng chính tả)</i>
                                            </div>
                                            <div class="example-content">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="user-answer-{{$q->id}}" class="form-label">Câu trả lời của bạn</label>
                                                        <input type="text" aria-label="Answer of question" id="user-answer-{{$q->id}}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="answer-{{$q->id}}" class="form-label">Đáp án</label>
                                                        <input type="text" aria-label="Answer of question" id="answer-{{$q->id}}" class="form-control bg-light" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($q->type == 'MULTIPLE_CHOICE')
                                            <div class="example-code" id="bg-result-{{$q->id}}">
                                                <i>Chọn những đáp án đúng</i>
                                            </div>
                                            <div class="example-content">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">Câu trả lời của bạn</label>
                                                        @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                                            @if($loop->last)
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="user-checkbox-{{$q->id}}-{{$index}}" type="checkbox" aria-label="Checkbox for following text input" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @else
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="user-checkbox-{{$q->id}}-{{$index}}" type="checkbox" aria-label="Checkbox for following text input" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Đáp án</label>
                                                        @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                                            @if($loop->last)
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="checkbox-{{$q->id}}-{{$index}}" type="checkbox" aria-label="Checkbox for following text input" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control bg-light" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @else
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0" id="checkbox-{{$q->id}}-{{$index}}" type="checkbox" aria-label="Checkbox for following text input" disabled>
                                                                    </div>
                                                                    <input type="text" class="form-control bg-light" aria-label="Answer of question" value="{{$oa}}" readonly>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script>
    $.blockUI({
        message: '<div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span><div>',
        timeout: 2000
    });


    function showAnswerCorrect(id){
        let url = '{{ route("question.get-question", ":id") }}';
        url = url.replace(':id', id );
        $.get(url, function (data) {
            if(data.question.type === 'MULTIPLE_CHOICE'){
                let arrayAnswers = JSON.parse(data.answer.answer);
                $.each(arrayAnswers, function(index, answer) {
                    $('#checkbox-'+id+'-'+answer).prop('checked', true);
                })
            } else if (data.question.type === 'CHOICE'){
                let answer = data.answer.answer;
                $('#radio-'+id+'-'+answer).prop('checked', true);
            } else if (data.question.type === 'FORM') {
                let arrayAnswers = JSON.parse(data.answer.answer);
                let html_answer = "";
                $.each(arrayAnswers, function( index, answer ) {
                    let isLastElement = index == arrayAnswers.length -1;
                    if (isLastElement) {
                        html_answer += answer
                    } else {
                        html_answer += answer + "; ";
                    }
                });
                $('#answer-'+id).val(html_answer);
            }
        })
    }

    function showAnswerUser(id, type, answer, isCorrect){
        if(isCorrect){
            $('#text-result-'+id).html(`
                <span class="badge badge-style-light rounded-pill badge-success">Đúng</span>
            `);
            $('#bg-result-'+id).addClass("bg-correct");
            $('#bd-result-'+id).addClass("bd-correct");
        } else {
            $('#text-result-'+id).html(`
                 <span class="badge badge-style-light rounded-pill badge-danger">Sai</span>
            `);
            $('#bg-result-'+id).addClass("bg-incorrect");
            $('#bd-result-'+id).addClass("bd-incorrect");
        }
        if(type === 'MULTIPLE_CHOICE'){
            $.each(answer, function(index, answer) {
                $('#user-checkbox-'+id+'-'+answer).prop('checked', true);
            })
        } else if (type === 'CHOICE'){
            $('#user-radio-'+id+'-'+answer).prop('checked', true);
        } else if (type === 'FORM') {
            $('#user-answer-'+id).val(answer);
        }
    }

    function showAllAnswer(topic_id){
        let url = '{{ route("result.get-result")}}';
        let user_id = $('#user_id').val();
        $.ajax({
            type:'POST',
            url:url,
            data: {
                user_id: user_id,
                topic_id: topic_id,
                _token: '{{csrf_token()}}',
            },
            success:function(data){
                $.each(JSON.parse(data.result.result), function(index, question) {
                    showAnswerCorrect(question.question_id);
                    showAnswerUser(question.question_id, question.question_type, question.answer, question.isCorrect)
                });
            }
        });
    }

    showAllAnswer({{$topic->id}});
</script>
@endsection
