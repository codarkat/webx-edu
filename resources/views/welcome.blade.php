<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
{{--        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">--}}
{{--            @if (Route::has('login'))--}}
{{--                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add questions</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add questions</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Title</h3>

                                        <div class="card-tools">
                                            <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">Add new</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered table-hover datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>ans</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--                                                    @foreach ($questions as $key=>$question)--}}
                                            {{--                                                        <tr>--}}
                                            {{--                                                            <td>{{ $key+1}}</td>--}}
                                            {{--                                                            <td>{{ $question['questions']}}</td>--}}
                                            {{--                                                            <td>{{ $question['ans']}}</td>--}}
                                            {{--                                                            <td><input class="question_status" data-id="{{ $question['id']}}" <?php if($question['status']==1){ echo "checked";} ?> type="checkbox" name="status"></td>--}}
                                            {{--                                                            <td>--}}
                                            {{--                                                                <a href="{{ url('admin/update_question/'. $question['id'])}}" class="btn btn-primary btn-sm">Update</a>--}}
                                            {{--                                                                <a href="{{ url('admin/delete_question/'. $question['id'])}}" class="btn btn-danger btn-sm">Delete</a>--}}
                                            {{--                                                            </td>--}}
                                            {{--                                                        </tr>--}}
                                            {{--                                                    @endforeach--}}
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>ans</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/admin/add_new_question')}}" class="database_operation">

                                        {{ csrf_field()}}


                                <div class="form-floating mb-3">
                                    <textarea class="form-control" rows="4" placeholder="Add content" id="question-content"></textarea>
                                    <label for="question-content">Question</label>
                                </div>
                                @php
                                    $question_types = ['CHOICE', 'FORM', 'MULTIPLE_CHOICE'];
                                @endphp
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="js-question-type">
                                        <option selected>Select type of question</option>
                                        @foreach($question_types as $qt)
                                            <option value="{{$qt}}">{{$qt}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Type</label>
                                </div>
                                <div class="bg-light rounded-3 p-4 mt-3 mb-3" id="js-answer">
                                    {{--JS_ANWSER--}}
                                    <div class="text-center">
                                        Please select a question type
                                    </div>
                                </div>
                            <a class="btn btn-primary" onclick="check()">CHECK</a>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>



        function check(){
            if($('#question-content').val() == ""
                || $('#js-question-type option:selected').val() == "Select type of question"
            ){
                alert('Vui lòng điền đầy đủ thông tin')
            } else {
                let formData = new FormData();
                formData.append('content', $('#question-content').val())
                formData.append('type', $('#js-question-type option:selected').val())
                if($('#js-question-type option:selected').val() == 'FORM'){
                    if($('#answer_text').val() == ""){
                        alert('Vui lòng điền đáp án')
                    } else {
                        // formData.append('answer', $('#answer_text').val())
                        // for (var value of formData.values()) {
                        //     console.log(value);
                        // }
                        let data = {
                            content: $('#question-content').val(),
                            type: $('#js-question-type option:selected').val(),
                            answer: $('#answer_text').val()
                        }
                        // const index = [1, 2, 3, 4]
                        // let optionAnswer = {};
                        // for (const i of index) {
                        //     optionAnswer['option'+i] = $("#answer-"+i).val()
                        // }
                        // data['option_answer'] = optionAnswer;
                        ajaxAddQuestion(data)
                    }
                } else if ($('#js-question-type option:selected').val() == 'CHOICE') {
                    let answer1 = $("#answer-"+1).val()
                    let answer2 = $("#answer-"+2).val()
                    let answer3 = $("#answer-"+3).val()
                    let answer4 = $("#answer-"+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        alert('Các đáp án không được trống')
                    } else {
                        if(answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4){
                            alert('Các đáp án không được trùng lặp')
                        } else {
                            if(!$(".js-radio-answer").is(':checked')){
                                alert('Bạn cần chọn đáp án cho câu hỏi')
                            } else {
                                let data = {
                                    content: $('#question-content').val(),
                                    type: $('#js-question-type option:selected').val(),
                                    answer: $("input[name='answer']:checked").val()
                                }
                                const index = [1, 2, 3, 4]
                                let optionAnswer = {};
                                for (const i of index) {
                                    optionAnswer[i] = $("#answer-"+i).val()
                                }
                                data['option_answer'] = optionAnswer;
                                ajaxAddQuestion(data)
                            }
                        }
                    }
                } else {
                    let answer1 = $("#answer-"+1).val()
                    let answer2 = $("#answer-"+2).val()
                    let answer3 = $("#answer-"+3).val()
                    let answer4 = $("#answer-"+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        alert('Các đáp án không được trống')
                    } else {
                        if (answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4) {
                            alert('Các đáp án không được trùng lặp')
                        } else {
                            if (!$(".js-checkbox-answer").is(':checked')) {
                                alert('Bạn cần chọn đáp án cho câu hỏi')
                            } else {
                                let data = {
                                    content: $('#question-content').val(),
                                    type: $('#js-question-type option:selected').val(),
                                    answer: $("#answer-"+$("input[name='answer']:checked").val()).val()
                                }
                                let arrayAnswer = [];
                                $("input:checkbox[name=answer]:checked").each(function () {
                                    arrayAnswer.push($(this).val());
                                });
                                data['answer'] = arrayAnswer;
                                const index = [1, 2, 3, 4]
                                let optionAnswer = {};
                                for (const i of index) {
                                    optionAnswer[i] = $("#answer-"+i).val()
                                }
                                data['option_answer'] = optionAnswer;
                                ajaxAddQuestion(data);
                            }
                        }
                    }
                }
            }
        }

        function ajaxAddQuestion(data) {
            let url = '{{route("question.create")}}';
            data['_token'] = '{{csrf_token()}}';
            console.log(data);
            $.ajax({
                type:'POST',
                url:url,
                data: data,
                success:function(data){
                    console.log('ABC');
                }
            });
        }



        //Get option anwser via DOM -> id js-answer
        $('#js-question-type').change(function (){
            if($('#js-question-type option:selected').val() == 'MULTIPLE_CHOICE'){
                $('#js-answer').html(`
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="1" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-1" placeholder="Answer 1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="2" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-2" placeholder="Answer 2">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="3" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-3" placeholder="Answer 3">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="4" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-4" placeholder="Answer 4">
                                    </div>
                `)
            } else if ($('#js-question-type option:selected').text() == 'CHOICE'){
                $('#js-answer').html(`
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="1" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-1" placeholder="Answer 1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="2" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-2" placeholder="Answer 2">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="3" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-3" placeholder="Answer 3">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="4" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="answer-4" placeholder="Answer 4">
                                    </div>
                `)
            } else if ($('#js-question-type option:selected').text() == 'FORM') {
                $('#js-answer').html(`
                    <div class="mb-3">
                        <label for="answer_text" class="form-label">Answer</label>
                        <input type="text" class="form-control" id="answer_text" name="answer_text" placeholder="Only type in lowercase">
                    </div>
                `)
            } else {
                $('#js-answer').html(`
                    <div class="text-center">
                        Please select a question type
                    </div>
                `)
            }

            //Check answer radio checked
            $(".js-radio-answer").change(function (){
                if($(this).is(':checked')){
                    $(".js-radio-answer").parent().css({
                        "backgroundColor": "#e9ecef"
                    })
                    $(this).parent().css({
                        "backgroundColor": "green"
                    })
                }
            })
        })


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
