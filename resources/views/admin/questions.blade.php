@extends('layouts.main-layout')

@section('content')
    <div class="page-description">
        <h1>{{$topic->name}}</h1>
        <span>{{$topic->description}}</span>
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
{{--                @foreach($questions as $index=>$q)--}}
{{--                    <tr>--}}
{{--                        <td>{{$q->content}}</td>--}}
{{--                        <td>System Architect</td>--}}
{{--                        <td>Edinburgh</td>--}}
{{--                        <td>61</td>--}}
{{--                        <td>2011/04/25</td>--}}
{{--                        <td>$320,800</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-edit-question" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa câu hỏi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="database_operation">

                        {{ csrf_field()}}

                        <div class="mb-3">
                            <label for="question-content" class="form-label">Question</label>
                            <textarea class="form-control" rows="4" placeholder="Add content" id="question-content"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="visually-hidden" for="js-question-type">Type</label>
                                <div class="input-group">
                                    <div class="input-group-text">Type</div>
                                    <input type="text" class="form-control" id="js-question-type" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="visually-hidden" for="question-status">Status</label>
                                <select class="form-select" id="question-status">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-light rounded-3 p-4 mt-3 mb-3" id="js-answer">
                            {{--JS_ANWSER--}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        let table;
        let body = $('body');

        //Listen event onclick from button edit
        body.on('click', '.ajax-edit-question', function () {
            let id = $(this).data("id");
            let url = '{{ route("question.ajax-get-a-question", ":id") }}';
            url = url.replace(':id', id );
            $.get(url, function (data) {
                $("#question-content").val(data.question.content);
                $('#js-question-type').val(data.question.type);
                $("#question-status").val(data.question.status).change();
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
                                            <input class="form-check-input mt-0 js-checkbox-answer" id="checkbox-`+ index +`" name="answer" type="checkbox" value="`+ index +`" aria-label="Checkbox button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        } else {
                            html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-checkbox-answer" id="checkbox-`+ index +`" name="answer" type="checkbox" value="`+ index +`" aria-label="Checkbox button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        }
                    })
                    $('#js-answer').html(html)
                    $.each(arrayAnswers, function(index, answer) {
                        $('#checkbox-'+answer).prop('checked', true);
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
                                            <input class="form-check-input mt-0 js-radio-answer" id="radio-`+ index +`" name="answer" type="radio" value="`+ index +`" aria-label="Radio button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        } else {
                            html += `
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 js-radio-answer" id="radio-`+ index +`" name="answer" type="radio" value="`+ index +`" aria-label="Radio button for answer">
                                        </div>
                                        <input type="text" class="form-control" id="answer-`+ index +`" value="`+ answer +`">
                                    </div>
                            `;
                        }
                    })
                    $('#js-answer').html(html)
                    $('#radio-'+answer).prop('checked', true);
                } else if (data.question.type === 'FORM') {
                    $('#js-answer').html(`
                        <div class="mb-3">
                            <label for="answer_text" class="form-label">Answer</label>
                            <input type="text" class="form-control" id="answer_text" name="answer_text" value="`+ data.answer.answer +`">
                        </div>
                    `)
                }
            })
        });
        //Listen event onclick from button delete
        body.on('click', '.ajax-delete-question', function () {
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
                    let url = '{{route("question.ajax-delete-question")}}';
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
                                    .row($(this).parents('tr'))
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
            table = $('#questions-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('question.ajax-get-list-questions')}}",
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
    </script>
@endsection
