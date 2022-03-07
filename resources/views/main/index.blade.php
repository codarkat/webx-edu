@extends('layouts.main-layout')

@section('content')
    <div class="page-description">
        <h1>{{$topic->name}}</h1>
        <span>{{$topic->description}}</span>
    </div>
    <form action="{{route('result.create')}}" method="POST">
        {{ csrf_field()}}
        <input type="hidden" name="topic_id" value="{{$topic->id}}">
        <input type="hidden" name="num_question" value="{{$topic->num_question}}">
        <input type="hidden" name="user_id" value="1">
    @foreach($questions as $index=>$q)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Câu {{$index+1}}</h5>
                <input type="hidden" name="question_id_{{$index+1}}" value="{{$q->id}}">
                <input type="hidden" name="question_type_{{$index+1}}" value="{{$q->type}}">
            </div>
            <div class="card-body">
                <p class="card-description">{{$q->content}}</p>
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
        <button type="submit">abc</button>
    </form>
@endsection
@section('script')
<script>
    function check(){

    }
</script>
@endsection
