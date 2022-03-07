<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
    <main>
        @foreach($questions as $q)

            <strong>{{$q->content}}</strong>
            @if($q->type == 'CHOICE')
                @foreach(json_decode($q->answer->option_answer) as $oa)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Default radio
                        </label>
                    </div>
                @endforeach
            @elseif ($q->type == 'FORM')
            <p>{{$q->answer->answer}}</p>
            @elseif ($q->type == 'MULTIPLE_CHOICE')
                @foreach(json_decode($q->answer->option_answer) as $oa)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Default radio
                        </label>
                    </div>
                @endforeach
            @endif

        @endforeach
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
    </main>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
