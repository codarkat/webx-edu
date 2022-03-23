@extends('layouts.main-layout')

@section('content')
    <div class="page-description">
        <h1>{{$topic->name}}</h1>
        <span>{{$topic->description}}</span>
    </div>
    <form action="{{route('result.update')}}" method="POST" id="form-answer">
        {{ csrf_field()}}
        <input type="hidden" id="topic_id" name="topic_id" value="{{$topic->id}}">
        <input type="hidden" id="num_question" name="num_question" value="{{$topic->num_question}}">
        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    @foreach($questions as $index=>$q)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Câu {{$index+1}}</h5>
                <input type="hidden" name="question_id_{{$index+1}}" value="{{$q->id}}">
                <input type="hidden" name="question_type_{{$index+1}}" value="{{$q->type}}">
            </div>
            <div class="card-body">
                <p class="card-description" style="white-space:pre">{!! $q->content !!}</p>
                <div class="example-container">
        @if($q->type == 'CHOICE')
                        <div class="example-code">
                            <i>Chọn một đáp án đúng</i>
                        </div>
                        <div class="example-content">
            @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                @if($loop->last)
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" name="option_answer_{{$q->id}}" type="radio" value="{{$index}}" aria-label="Radio button for question">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                    </div>
                                @else
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" name="option_answer_{{$q->id}}" type="radio" value="{{$index}}" aria-label="Radio button for question">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                    </div>
                                @endif
            @endforeach
                        </div>
        @elseif ($q->type == 'FORM')
                        <div class="example-code">
                            <i>Viết đáp án đúng (viết thường, đúng chính tả)</i>
                        </div>
                        <div class="example-content">
                            <input type="text" aria-label="Answer of question" name="answer_{{$q->id}}" class="form-control">
                        </div>
        @elseif ($q->type == 'MULTIPLE_CHOICE')
                        <div class="example-code">
                            <i>Chọn những đáp án đúng</i>
                        </div>
                        <div class="example-content">
                            @foreach(json_decode(json_decode(json_encode($q->answer->option_answer)),true) as $index=>$oa)
                                @if($loop->last)
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" name="option_answer_{{$q->id}}[]" type="checkbox" value="{{$index}}" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                    </div>
                                @else
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" name="option_answer_{{$q->id}}[]" type="checkbox" value="{{$index}}" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Answer of question" value="{{$oa}}" readonly>
                                    </div>
                                @endif
                            @endforeach
                        </div>
        @endif
                </div>
            </div>
        </div>
    @endforeach
    </form>
    <button class="btn btn-primary btn-rounded full-width btn-lg mt-3 mt-3 js-finish-exam">Nộp bài</button>

@endsection
@section('script')
<script>
    $('.app-menu').append(`
        <div class="clock text-dark text-center">
            <h1 id="clock" class="mt-3"></h1>
            <p class="">Thời gian làm bài</p>
        </div>
    `);
    function clock(){
        let topic_id = $('#topic_id').val();
        let url = '{{ route("result.get-clock", ":id") }}';
        url = url.replace(':id', topic_id );
        $.get(url, function (data) {
            console.log(data.clock)
            $('#clock').countdown(data.clock, function(event) {
                var $this = $(this).html(event.strftime(''
                    // + '<span>%H</span> giờ '
                    // + '<span>%M</span> phút '
                    // + '<span>%S</span> giây'
                    + '<span>%N</span>:'
                    + '<span>%S</span>'
                ))
                if(event.offset.totalSeconds < 11){
                    $('.clock').addClass('bg-countdown-red')
                };
            }).on('finish.countdown', function (){
                sendSubmit();
            });
        })
    }

    clock();


    let body = $('body');
    body.on('click', '.js-finish-exam', function () {
        Swal.fire({
            title: 'Nộp bài?',
            text: "Bài kiểm tra sẽ kết thúc!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Đóng',
            confirmButtonText: 'Okay, nộp bài!'
        }).then((result) => {
            if (result.isConfirmed) {
                sendSubmit();
            }
        });
    })

    function sendSubmit(){
        let topic_id = $('#topic_id').val();
        let user_id = $('#user_id').val();
        $.ajax({
            type:'POST',
            url: '{{route('result.check')}}',
            data: {
                topic_id: topic_id,
                user_id: user_id,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                if(data.status === 'PROCESSING'){
                    $('#form-answer').submit();
                } else if(data.status === 'FINISHED'){
                    Swal.fire(
                        'Lỗi',
                        'Bạn đã nộp bài.',
                        'error'
                    )
                }
            }
        });
    }
</script>
@endsection
