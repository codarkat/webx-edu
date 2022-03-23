@extends('layouts.admin-layout')

@section('content')
    <div class="page-description d-flex align-items-center">
        <div class="page-description-content flex-grow-1">
            <h1>Chủ đề</h1>
            <span>Danh sách các chủ đề giáo dục</span>
        </div>
        <div class="page-description-actions">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-topic"><i class="material-icons">add</i>Tạo chủ đề mới</button>
        </div>
    </div>
    <div id="list-topics">
        @forelse($topics as $topic)
            <div class="card widget widget-popular-blog @if($topic->status == \App\Enums\StatusEnum::ACTIVE) bg-success @else bg-danger @endif" id="card-topic-{{$topic->id}}">
                <div class="card-body">
                    <div class="widget-popular-blog-container">
                        <div class="widget-popular-blog-image">
                            <img src="{{asset('public/assets/images/mirea.png')}}" alt="">
                        </div>
                        <div class="widget-popular-blog-content ps-4">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <span class="text-white h4" id="topic-name-{{$topic->id}}">
                                            {{$topic->name}}
                                        </span>
                                        <span class="widget-popular-blog-text text-light" id="topic-description-{{$topic->id}}">
                                            {{$topic->description}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Trạng thái: <span class="badge badge-style-light rounded-pill @if($topic->status == \App\Enums\StatusEnum::ACTIVE) badge-success @else badge-danger @endif" id="topic-status-{{$topic->id}}">{{$topic->status}}</span></li>
                                        <li class="list-group-item">Số lượng câu hỏi: <span class="badge badge-style-light rounded-pill badge-info" id="topic-num-question-{{$topic->id}}">{{$topic->num_question}}</span></li>
                                        <li class="list-group-item">Thời gian làm bài: <span class="badge badge-style-light rounded-pill badge-info" id="topic-duration-{{$topic->id}}">{{$topic->duration}} Phút</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                                        <span class="widget-popular-blog-date">
                                            DEADLINE: <strong id="topic-deadline-{{$topic->id}}">{{$topic->deadline}}</strong>
                                        </span>
                    <div class="float-end">
                        <a href="{{route('admin.topic-details', $topic->id )}}" type="button" class="btn btn-info"><i class="material-icons">summarize</i>Danh sách câu hỏi</a>
                        <a type="button" class="btn btn-warning ajax-edit-topic" data-bs-toggle="modal" data-bs-target="#modal-edit-topic" data-id="{{$topic->id}}"><i class="material-icons">edit</i>Sửa</a>
                        <a type="button" class="btn btn-danger ajax-delete-topic" data-id="{{$topic->id}}"><i class="material-icons">delete_outline</i>Xóa</a>
                    </div>
                </div>
            </div>
        @empty
                <div class="text-center" id="text-empty">
                    <strong>Danh sách chủ đề đang trống.</strong>
                </div>
        @endforelse
    </div>


    <div class="modal fade" id="modal-create-topic" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm chủ đề mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="database_operation">
                        {{ csrf_field()}}
                        <div class="mb-3">
                            <label for="topic-name" class="form-label">Tiêu đề</label>
                            <input class="form-control" placeholder="Gõ tiêu đề" id="topic-name" pattern="[A-Za-z]{3,}"></input>
                        </div>
                        <div class="mb-3">
                            <label for="topic-description" class="form-label">Mô tả</label>
                            <textarea class="form-control" rows="4" placeholder="Gõ mô tả" id="topic-description"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="topic-deadline" class="form-label">Hạn chót</label>
                                <input class="form-control flatpickr2" type="text" id="topic-deadline" placeholder="Chọn thời gian">
                            </div>
                            <div class="col-6">
                                <label for="topic-duration" class="form-label">Thời gian làm bài</label>
                                <input class="form-control" type="number" id="topic-duration" placeholder="Đơn vị: Phút">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="createTopic()">Tạo</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-topic" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa chủ đề</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="database_operation">
                        {{ csrf_field()}}
                        <input type="hidden" id="e-topic-id">
                        <div class="mb-3">
                            <label for="e-topic-name" class="form-label">Tiêu đề</label>
                            <input class="form-control" placeholder="Gõ tiêu đề" id="e-topic-name" pattern="[A-Za-z]{3,}"></input>
                        </div>
                        <div class="mb-3">
                            <label for="e-topic-description" class="form-label">Mô tả</label>
                            <textarea class="form-control" rows="4" placeholder="Gõ mô tả" id="e-topic-description"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="e-topic-deadline" class="form-label">Hạn chót</label>
                                <input class="form-control flatpickr2" type="text" id="e-topic-deadline" placeholder="Chọn thời gian">
                            </div>
                            <div class="col-4">
                                <label for="e-topic-duration" class="form-label">Thời gian làm bài</label>
                                <input class="form-control" type="number" id="e-topic-duration" placeholder="Đơn vị: Phút">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="e-topic-status">Trạng thái</label>
                                <select class="form-select" id="e-topic-status">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="updateTopic()">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('public/assets/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('public/assets/js/pages/datepickers.js')}}"></script>
    <script>
        let body = $('body');

        //Listen event onclick from button edit
        body.on('click', '.ajax-edit-topic', function () {
            let id = $(this).data("id");
            let url = '{{ route("topic.get-topic", ":id") }}';
            url = url.replace(':id', id );
            $.get(url, function (data) {
                $('#e-topic-id').val(data.topic.id);
                $('#e-topic-name').val(data.topic.name);
                $('#e-topic-description').val(data.topic.description);
                $('#e-topic-deadline').val(data.topic.deadline);
                $('#e-topic-duration').val(data.topic.duration);
                $('#e-topic-status').val(data.topic.status).change();
            })
        });
        //Listen event onclick from button delete
        body.on('click', '.ajax-delete-topic', function () {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Chủ đề sẽ bị xóa. Đồng thời tất cả các câu hỏi trong chủ đề cũng sẽ bị xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Đóng',
                confirmButtonText: 'Okay, xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data("id");
                    let url = '{{route("topic.delete")}}';
                    $.ajax({
                        type:'POST',
                        url:url,
                        data: {
                            id: id,
                            _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            if(Boolean(data.code)){
                                $('#card-topic-'+id).remove()
                                //If count of topics = 0, show view text empty
                                if(Number(data.count) == 0){
                                    let textEmpty = `
                                        <div class="text-center" id="text-empty">
                                            <strong>Danh sách chủ đề đang trống.</strong>
                                        </div>
                                    `;
                                    $('#list-topics').prepend(textEmpty);
                                };
                                Swal.fire(
                                    'Đã xóa!',
                                    'Chủ đề đã được xóa.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Chủ đề xóa không thành công.',
                                    'error'
                                )
                            }
                        }
                    });

                }
            })
        });

        function createTopic(){
            let name = $('#topic-name').val(),
                description = $('#topic-description').val(),
                deadline = $('#topic-deadline').val(),
                duration = $('#topic-duration').val();

            //Handle input need have characters
            if(name.replace(/\s/g,'') === ""
                || description.replace(/\s/g,'') === ""
                || deadline.replace(/\s/g,'') === ""
                || duration.replace(/\s/g,'') === ""
            ){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng điền đầy đủ thông tin!'
                })
            } else {
                if(Number.isInteger(Number(duration)) && Number(duration) > 0){
                    let data = {
                        name: name,
                        description: description,
                        deadline: deadline,
                        duration: duration
                    }
                    let url = '{{route("topic.store")}}';
                    data['_token'] = '{{csrf_token()}}';
                    $.ajax({
                        type:'POST',
                        url:url,
                        data: data,
                        success:function(data){
                            if(Boolean(data.code)){

                                let url = '{{ route("admin.topic-details", ":id") }}';
                                url = url.replace(':id', data.data.id );
                                let newTopicHTML = `
                                <div class="card widget widget-popular-blog bg-success" id="card-topic-`+ data.data.id +`">
                                    <div class="card-body">
                                        <div class="widget-popular-blog-container">
                                            <div class="widget-popular-blog-image">
                                                <img src="{{asset('public/assets/images/mirea.png')}}" alt="">
                                            </div>
                                            <div class="widget-popular-blog-content ps-4">
                                                            <div class="row">
                                                                <div class="col-6 d-flex align-items-center justify-content-center">
                                                                    <div class="text-center">
                                                                        <span class="text-white h4" id="topic-name-`+ data.data.id +`">
                                                                                `+ data.data.name +`
                                                                        </span>
                                                                        <span class="widget-popular-blog-text text-light" id="topic-description-`+ data.data.id +`">
                                                                                `+ data.data.description +`
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">Trạng thái: <span class="badge badge-style-light rounded-pill badge-success" id="topic-status-`+ data.data.id +`">`+ data.data.status +`</span></li>
                                                                        <li class="list-group-item">Số lượng câu hỏi: <span class="badge badge-style-light rounded-pill badge-info" id="topic-num-question-`+ data.data.id +`">`+ data.data.num_question +`</span></li>
                                                                        <li class="list-group-item">Thời gian làm bài: <span class="badge badge-style-light rounded-pill badge-info" id="topic-duration-`+ data.data.id +`">`+ data.data.duration +` Phút</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <span class="widget-popular-blog-date">
                                            DEADLINE: <strong id="topic-deadline-`+ data.data.id +`">`+ data.data.deadline +`</strong>
                                        </span>
                                        <div class="float-end">
                                            <a href="`+ url +`" type="button" class="btn btn-info"><i class="material-icons">summarize</i>Danh sách câu hỏi</a>
                                            <a type="button" class="btn btn-warning ajax-edit-topic" data-bs-toggle="modal" data-bs-target="#modal-edit-topic" data-id="`+ data.data.id +`"><i class="material-icons">edit</i>Sửa</a>
                                            <a type="button" class="btn btn-danger ajax-delete-topic" data-id="`+ data.data.id +`"><i class="material-icons">delete_outline</i>Xóa</a>
                                        </div>
                                    </div>
                                </div>
                                `;
                                if($('#text-empty').length){
                                    $('#text-empty').remove();
                                }
                                $('#list-topics').prepend(newTopicHTML);
                                //Alert success
                                Swal.fire(
                                    'Thành công!',
                                    'Chủ đề được tạo thành công.',
                                    'success'
                                )
                                //Hide modal
                                let modalCreateTopic = document.getElementById('modal-create-topic');
                                let modalCT = bootstrap.Modal.getInstance(modalCreateTopic);
                                modalCT.hide();

                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Chủ đề không được tạo thành công.',
                                    'error'
                                )
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Thời gian làm bài là một số nguyên lớn hơn 0!'
                    })
                }
            }
        }
        function updateTopic(){
            let id = $('#e-topic-id').val(),
                name = $('#e-topic-name').val(),
                description = $('#e-topic-description').val(),
                deadline = $('#e-topic-deadline').val(),
                duration = $('#e-topic-duration').val(),
                status = $('#e-topic-status').val();

            //Handle input need have characters
            if(name.replace(/\s/g,'') === ""
                || description.replace(/\s/g,'') === ""
                || deadline.replace(/\s/g,'') === ""
                || duration.replace(/\s/g,'') === ""
            ){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng điền đầy đủ thông tin!'
                })
            } else {
                if(Number.isInteger(Number(duration)) && Number(duration) > 0){
                    let data = {
                        id: id,
                        name: name,
                        description: description,
                        deadline: deadline,
                        duration: duration,
                        status: status
                    }
                    let url = '{{route("topic.update")}}';
                    data['_token'] = '{{csrf_token()}}';
                    $.ajax({
                        type:'POST',
                        url:url,
                        data: data,
                        success:function(data){
                            if(Boolean(data.code)){


                                $('#topic-name-'+ data.data.id).html(data.data.name);
                                $('#topic-description-'+ data.data.id).html(data.data.description);
                                $('#topic-deadline-'+ data.data.id).html(data.data.deadline);
                                $('#topic-status-'+ data.data.id).html(data.data.status);
                                $('#topic-num-question-'+ data.data.id).html(data.data.num_question + ` Phút`);
                                $('#topic-duration-'+ data.data.id).html(data.data.duration);

                                if(data.data.status == 'ACTIVE'){
                                    $('#card-topic-'+ data.data.id).removeClass('bg-danger');
                                    $('#card-topic-'+ data.data.id).addClass('bg-success');
                                    $('#topic-status-'+ data.data.id).removeClass('badge-danger');
                                    $('#topic-status-'+ data.data.id).addClass('badge-success');
                                } else {
                                    $('#card-topic-'+ data.data.id).addClass('bg-danger');
                                    $('#card-topic-'+ data.data.id).removeClass('bg-success');
                                    $('#topic-status-'+ data.data.id).addClass('badge-danger');
                                    $('#topic-status-'+ data.data.id).removeClass('badge-success');
                                }


                                //Alert success
                                Swal.fire(
                                    'Thành công!',
                                    'Chủ đề được tạo thành công.',
                                    'success'
                                )
                                //Hide modal
                                let modalEditTopic = document.getElementById('modal-edit-topic');
                                let modalET = bootstrap.Modal.getInstance(modalEditTopic);
                                modalET.hide();

                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Chủ đề không được tạo thành công.',
                                    'error'
                                )
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Thời gian làm bài là một số nguyên lớn hơn 0!'
                    })
                }
            }
        }



    </script>
@endsection
