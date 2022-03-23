@extends('layouts.admin-layout')

@section('content')
    <div class="page-description d-flex align-items-center">
        <div class="page-description-content flex-grow-1">
            <h1>{{$topic->name}}</h1>
            <span>{{$topic->description}}</span>
            <input type="hidden" class="form-control" id="topic-id" value="{{$topic->id}}">
        </div>
        <div class="page-description-actions">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-question"><i class="material-icons">add</i>Tạo câu hỏi mới</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách câu hỏi</h5>
        </div>
        <div class="card-body">
            <table id="questions-datatable" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nội dung</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                {{--JS Datatable--}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-edit-question" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa câu hỏi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="database_operation">
                        {{ csrf_field()}}
                        <input type="hidden" class="form-control" id="e-question-id">
                        <div class="mb-3">
                            <label for="e-question-content" class="form-label">Nội dung câu hỏi</label>
                            <textarea class="form-control" rows="4" placeholder="Gõ nội dung" id="e-question-content"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="visually-hidden" for="e-question-type">Loại câu hỏi</label>
                                <div class="input-group">
                                    <div class="input-group-text">Loại câu hỏi</div>
                                    <input type="text" class="form-control" id="e-question-type" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="visually-hidden" for="e-question-status">Trạng thái</label>
                                <select class="form-select" id="e-question-status">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-light rounded-3 p-4 mt-3 mb-3" id="e-answer">
                            {{--JS_ANWSER--}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="updateQuestion()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-create-question" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm câu hỏi mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="database_operation">
                        {{ csrf_field()}}
                        <div class="mb-3">
                            <label for="question-content" class="form-label">Nội dung câu hỏi</label>
                            <textarea class="form-control" rows="4" placeholder="Gõ nội dung" id="question-content"></textarea>
                        </div>
                        @php
                            $question_types = ['CHOICE', 'FORM', 'MULTIPLE_CHOICE'];
                        @endphp
                        <div class="mb-3">
                            <label for="question-type" class="form-label">Loại câu hỏi</label>
                            <select class="form-select" id="question-type">
                                <option selected>Chọn loại của câu hỏi</option>
                                @foreach($question_types as $qt)
                                    <option value="{{$qt}}">{{$qt}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="bg-light rounded-3 p-4 mt-3 mb-3" id="answer">
                            {{--JS_ANWSER--}}
                            <div class="text-center">
                                Loại của câu hỏi chưa được chọn!
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="createQuestion()">Tạo</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script>

        let table, row_clicked;
        let body = $('body');


        let cContent, eContent;

        ClassicEditor
            .create( document.querySelector( '#question-content' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                    ]
                }
            } )
            .then( newContent => {
                cContent = newContent;
            } )
            .catch( error => {
                console.error( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#e-question-content' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                    ]
                }
            } )
            .then( editContent => {
                eContent = editContent;
            } )
            .catch( error => {
                console.error( error );
            } );

        //Listen event onclick from button edit
        body.on('click', '.ajax-edit-question', function () {
            row_clicked = $(this).parents('tr');
            let id = $(this).data("id");
            let url = '{{ route("question.get-question", ":id") }}';
            url = url.replace(':id', id );
            $.get(url, function (data) {
                // $('#e-question-content').val(atob(data.question.content));
                eContent.setData(data.question.content);
                $('#e-question-type').val(data.question.type);
                $('#e-question-status').val(data.question.status).change();
                $('#e-question-id').val(id);
                if(data.question.type === 'MULTIPLE_CHOICE'){
                    let html = ``;
                    let objectAnswers = JSON.parse(data.answer.option_answer);
                    let arrayAnswers = JSON.parse(data.answer.answer);
                    let objectLength = Object.keys(JSON.parse(data.answer.option_answer)).length;
                    $.each(objectAnswers, function(index, answer) {
                        if(Number(objectLength) === Number(index)){
                            html += `
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-e-checkbox-answer" id="e-checkbox-`+ index +`" name="e-answer" type="checkbox" value="`+ index +`" aria-label="Checkbox button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="e-option-answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        } else {
                            html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-e-checkbox-answer" id="e-checkbox-`+ index +`" name="e-answer" type="checkbox" value="`+ index +`" aria-label="Checkbox button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="e-option-answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        }
                    })
                    $('#e-answer').html(html)
                    $.each(arrayAnswers, function(index, answer) {
                        $('#e-checkbox-'+answer).prop('checked', true);
                    })
                } else if (data.question.type === 'CHOICE'){
                    let html = ``;
                    let objectAnswers = JSON.parse(data.answer.option_answer);
                    let answer = data.answer.answer;
                    let objectLength = Object.keys(JSON.parse(data.answer.option_answer)).length;
                    $.each(objectAnswers, function(index, answer) {
                        if(Number(objectLength) === Number(index)){
                            html += `
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-e-radio-answer" id="e-radio-`+ index +`" name="e-answer" type="radio" value="`+ index +`" aria-label="Radio button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="e-option-answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        } else {
                            html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-e-radio-answer" id="e-radio-`+ index +`" name="e-answer" type="radio" value="`+ index +`" aria-label="Radio button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="e-option-answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        }
                    })
                    $('#e-answer').html(html)
                    $('#e-radio-'+answer).prop('checked', true);
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
                    $('#e-answer').html(`
                        <div class="mb-3">
                            <label for="e-answer_text" class="form-label">Answer</label>
                            <input type="text" class="form-control" id="e-answer_text" name="e-answer_text" value="`+ html_answer +`">
                        </div>
                    `)
                }
            })
        });
        //Listen event onclick from button delete
        body.on('click', '.ajax-delete-question', function () {
            row_clicked = $(this).parents('tr');
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Câu hỏi sẽ bị xóa.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Đóng',
                confirmButtonText: 'Okay, xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data("id");
                    let url = '{{route("question.delete")}}';
                    $.ajax({
                        type:'POST',
                        url:url,
                        data: {
                            id: id,
                            _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            if(Boolean(data.code)){
                                table
                                    .row(row_clicked)
                                    .remove()
                                    .draw();
                                Swal.fire(
                                    'Đã xóa!',
                                    'Câu hỏi đã được xóa.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Câu hỏi xóa không thành công.',
                                    'error'
                                )
                            }
                        }
                    });
                }
            })
        });

        //Get data for table
        $(function () {
            let id = $('#topic-id').val();
            let url = '{{ route("topic.get-topic-details", ":id") }}';
            url = url.replace(':id', id );
            table = $('#questions-datatable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json'
                },
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'content', name: 'content'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function updateQuestion(){
            // if($('#e-question-content').val() == ""){
            if(eContent.getData() == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng điền nội dung câu hỏi!'
                })
            } else {
                let id = $('#e-question-id').val();
                // let content = $('#e-question-content').val();
                let content = eContent.getData()
                let type = $('#e-question-type').val();
                let status = $('#e-question-status option:selected').val();
                if($('#e-question-type').val() == 'FORM'){
                    if($('#e-answer_text').val() == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Vui lòng điền đáp án!'
                        })
                    } else {
                        let array_answer = $('#e-answer_text').val().split(";").map(answer => answer.trim());
                        let data = {
                            id: id,
                            content: content,
                            type: type,
                            status: status,
                            answer: array_answer
                        }
                        ajaxUpdateQuestion(data)
                    }
                } else if ($('#e-question-type').val() == 'CHOICE') {
                    let answer1 = $("#e-option-answer-"+1).val()
                    let answer2 = $("#e-option-answer-"+2).val()
                    let answer3 = $("#e-option-answer-"+3).val()
                    let answer4 = $("#e-option-answer-"+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Các đáp án không được trống!'
                        })
                    } else {
                        if(answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Các đáp án không được trùng lặp!'
                            })
                        } else {
                            if(!$(".js-e-radio-answer").is(':checked')){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Bạn cần chọn đáp án cho câu hỏi!'
                                })
                            } else {
                                let data = {
                                    id: id,
                                    content: content,
                                    type: type,
                                    status: status,
                                    answer: $("input[name='e-answer']:checked").val()
                                }
                                const index = [1, 2, 3, 4]
                                let optionAnswer = {};
                                for (const i of index) {
                                    optionAnswer[i] = $('#e-option-answer-'+i).val()
                                }
                                data['option_answer'] = optionAnswer;
                                ajaxUpdateQuestion(data)
                            }
                        }
                    }
                } else if ($('#e-question-type').val() == 'MULTIPLE_CHOICE') {
                    let answer1 = $('#e-option-answer-'+1).val()
                    let answer2 = $('#e-option-answer-'+2).val()
                    let answer3 = $('#e-option-answer-'+3).val()
                    let answer4 = $('#e-option-answer-'+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Các đáp án không được trống!'
                        })
                    } else {
                        if (answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Các đáp án không được trùng lặp!'
                            })
                        } else {
                            if (!$('.js-e-checkbox-answer').is(':checked')) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Bạn cần chọn đáp án cho câu hỏi!'
                                })
                            } else {
                                let data = {
                                    id: id,
                                    content: content,
                                    type: type,
                                    status: status
                                }
                                let arrayAnswer = [];
                                let optionAnswer = {};
                                const index = [1, 2, 3, 4];
                                //Store correct answer
                                $("input:checkbox[name=e-answer]:checked").each(function () {
                                    arrayAnswer.push($(this).val());
                                });
                                //Store answer option
                                for (const i of index) {
                                    optionAnswer[i] = $('#e-option-answer-'+i).val()
                                }
                                data['answer'] = arrayAnswer;
                                data['option_answer'] = optionAnswer;
                                ajaxUpdateQuestion(data);
                            }
                        }
                    }
                }
            }
        }
        function ajaxUpdateQuestion(data) {
            let url = '{{route("question.update")}}';
            data['_token'] = '{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url:url,
                data: data,
                success:function(data){
                    if(Boolean(data.code)){
                        //Get old data
                        let rowData = table.row(row_clicked).data();
                        //Update new data
                        rowData[1] = data.content;
                        rowData[2] = data.type;
                        rowData[3] = data.status;
                        //Update row
                        table
                            .row(row_clicked)
                            .data(rowData)
                            .draw();
                        //Alert success
                        Swal.fire(
                            'Thành công!',
                            'Câu hỏi đã được cập nhật.',
                            'success'
                        )
                        //Hide modal
                        let modalUpdateQuestion = document.getElementById('modal-edit-question');
                        let modalUQ = bootstrap.Modal.getInstance(modalUpdateQuestion);
                        modalUQ.hide();

                    } else {
                        Swal.fire(
                            'Lỗi!',
                            'Câu hỏi xóa không thành công.',
                            'error'
                        )
                    }
                }
            });
        }


        //CREATE QUESTION
        function createQuestion(){
            if(
                // $('#question-content').val() == ""
                cContent.getData() == ""
                || $('#question-type option:selected').val() == "Select type of question"
            ){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng điền nội dung câu hỏi!'
                })
            } else {
                // let content = $('#question-content').val();
                let content = cContent.getData();
                let type = $('#question-type').val();
                let topic_id = $('#topic-id').val();
                if($('#question-type option:selected').val() == 'FORM'){
                    if($('#answer_text').val() == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Vui lòng điền đáp án!'
                        })
                    } else {
                        let array_answer = $('#answer_text').val().split(";").map(answer => answer.trim());
                        let data = {
                            content: content,
                            type: type,
                            topic_id: topic_id,
                            answer: array_answer
                        }
                        ajaxCreateQuestion(data)
                    }
                } else if ($('#question-type option:selected').val() == 'CHOICE') {
                    let answer1 = $("#option-answer-"+1).val()
                    let answer2 = $("#option-answer-"+2).val()
                    let answer3 = $("#option-answer-"+3).val()
                    let answer4 = $("#option-answer-"+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Các đáp án không được trống!'
                        })
                    } else {
                        if(answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Các đáp án không được trùng lặp!'
                            })
                        } else {
                            if(!$(".js-radio-answer").is(':checked')){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Bạn cần chọn đáp án cho câu hỏi!'
                                })
                            } else {
                                let data = {
                                    content: content,
                                    type: type,
                                    topic_id: topic_id,
                                    answer: $("input[name='answer']:checked").val()
                                }
                                const index = [1, 2, 3, 4]
                                let optionAnswer = {};
                                for (const i of index) {
                                    optionAnswer[i] = $("#option-answer-"+i).val()
                                }
                                data['option_answer'] = optionAnswer;
                                ajaxCreateQuestion(data)
                            }
                        }
                    }
                } else if ($('#question-type option:selected').val() == 'MULTIPLE_CHOICE') {
                    let answer1 = $("#option-answer-"+1).val()
                    let answer2 = $("#option-answer-"+2).val()
                    let answer3 = $("#option-answer-"+3).val()
                    let answer4 = $("#option-answer-"+4).val()
                    if(answer1 == ""
                        || answer2 == ""
                        || answer3 == ""
                        || answer4 == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Các đáp án không được trống!'
                        })
                    } else {
                        if (answer1 === answer2
                            || answer1 === answer3
                            || answer1 === answer4
                            || answer2 === answer3
                            || answer2 === answer4
                            || answer3 === answer4) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Các đáp án không được trùng lặp!'
                            })
                        } else {
                            if (!$(".js-checkbox-answer").is(':checked')) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Bạn cần chọn đáp án cho câu hỏi!'
                                })
                            } else {
                                let data = {
                                    content: content,
                                    type: type,
                                    topic_id: topic_id,
                                }
                                let arrayAnswer = [];
                                let optionAnswer = {};
                                const index = [1, 2, 3, 4];
                                $("input:checkbox[name=answer]:checked").each(function () {
                                    arrayAnswer.push($(this).val());
                                });
                                for (const i of index) {
                                    optionAnswer[i] = $("#option-answer-"+i).val()
                                }
                                data['answer'] = arrayAnswer;
                                data['option_answer'] = optionAnswer;
                                ajaxCreateQuestion(data);
                            }
                        }
                    }
                }
            }
        }

        function ajaxCreateQuestion(data) {
            let url = '{{route("question.store")}}';
            data['_token'] = '{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url:url,
                data: data,
                success:function(data){
                    if(Boolean(data.code)){
                        if(table.row( ':last').data()){
                            let rowData = table.row( ':last').data();
                            rowData[0] = rowData.DT_RowIndex + 1;
                            rowData[1] = data.content;
                            rowData[2] = data.type;
                            rowData[3] = data.status;
                            rowData[4] = data.action;
                            table.row.add(rowData).draw();
                        } else {
                            table.row.add({
                                'DT_RowIndex': 1,
                                'content': data.content,
                                'type': data.type,
                                'status': data.status,
                                'action': data.action,
                            }).draw();
                        }
                        Swal.fire(
                            'Thành công!',
                            'Câu hỏi đã được tạo.',
                            'success'
                        )

                        //Hide modal
                        let modalCreateQuestion = document.getElementById('modal-create-question');
                        let modalCQ = bootstrap.Modal.getInstance(modalCreateQuestion);
                        modalCQ.hide();

                    } else {
                        Swal.fire(
                            'Lỗi!',
                            'Câu hỏi không được tạo.',
                            'error'
                        )
                    }
                }
            });
        }

        $('#question-type').change(function (){
            let index = [1, 2, 3, 4];
            if($('#question-type option:selected').val() == 'MULTIPLE_CHOICE'){
                let html = ``;
                $.each(index, function(index, value) {
                    if(Number(value) === Number(index.length)){
                        html += `
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="`+ value +`" aria-label="Checkbox button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="option-answer-`+ value +`" placeholder="Đáp án `+ value +`">
                                    </div>
                        `;
                    } else {
                        html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" name="answer" type="checkbox" value="`+ value +`" aria-label="Checkbox button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="option-answer-`+ value +`" placeholder="Đáp án `+ value +`">
                                    </div>
                        `;
                    }
                });
                $('#answer').html(html);
            } else if ($('#question-type option:selected').text() == 'CHOICE'){
                let html = ``;
                $.each(index, function(index, value) {
                    if(Number(value) === Number(index.length)){
                        html += `
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="`+ value +`" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="option-answer-`+ value +`" placeholder="Đáp án `+ value +`">
                                    </div>
                        `;
                    } else {
                        html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" name="answer" type="radio" value="`+ value +`" aria-label="Radio button for following text input">
                                        </div>
                                        <input type="text" class="form-control" id="option-answer-`+ value +`" placeholder="Đáp án `+ value +`">
                                    </div>
                        `;
                    }
                });
                $('#answer').html(html);
            } else if ($('#question-type option:selected').text() == 'FORM') {
                $('#answer').html(`
                    <div class="mb-3">
                        <label for="answer_text" class="form-label">Đáp án</label>
                        <input type="text" class="form-control" id="answer_text" name="answer_text" placeholder="Chỉ viết thường, đúng chính tả">
                    </div>
                `)
            } else {
                $('#answer').html(`
                            <div class="text-center">
                                Loại của câu hỏi chưa được chọn!
                            </div>
                `)
            }
        })
    </script>
@endsection
