@extends('layouts.main-layout')

@section('content')
    <div class="page-description">
        <div class="page-description-content">
            <h1>Chủ đề</h1>
            <span>Danh sách các chủ đề giáo dục</span>
        </div>
    </div>
    <div id="list-topics">
        @forelse($topics as $topic)
            @if(in_array($topic->id, $subscribes))
                <div class="card widget widget-popular-blog bg-success" id="card-topic-{{$topic->id}}">
                <div class="card-body">
                    <div class="widget-popular-blog-container">
                        <div class="widget-popular-blog-image">
                            <img src="{{asset('assets/images/mirea.png')}}" alt="">
                        </div>
                        <div class="widget-popular-blog-content ps-4">
                            <div class="row">
                                <div class="col-6">
                                    <span class="text-white h4" id="topic-name-{{$topic->id}}">
                                        {{$topic->name}}
                                    </span>
                                    <span class="widget-popular-blog-text text-light" id="topic-description-{{$topic->id}}">
                                        {{$topic->description}}
                                    </span>
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
                    <div class="float-end" id="footer-button-{{$topic->id}}">
                        <a type="button" class="btn btn-danger js-unsubscribe" data-topic-id="{{$topic->id}}" data-user-id="1"><i class="material-icons">clear</i>Hủy đăng ký</a>
                        <a href="{{route('user.exam', $topic->id )}}" type="button" class="btn btn-info"><i class="material-icons">arrow_forward</i>Bắt đầu làm bài</a>
                    </div>
                </div>
            </div>
            @else
                <div class="card widget widget-popular-blog bg-danger" id="card-topic-{{$topic->id}}">
                    <div class="card-body">
                        <div class="widget-popular-blog-container">
                            <div class="widget-popular-blog-image">
                                <img src="{{asset('assets/images/mirea.png')}}" alt="">
                            </div>
                            <div class="widget-popular-blog-content ps-4">
                                <div class="row">
                                    <div class="col-6">
                                    <span class="text-white h4" id="topic-name-{{$topic->id}}">
                                        {{$topic->name}}
                                    </span>
                                        <span class="widget-popular-blog-text text-light" id="topic-description-{{$topic->id}}">
                                        {{$topic->description}}
                                    </span>
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
                        <div class="float-end" id="footer-button-{{$topic->id}}">
                            <a type="button" class="btn btn-warning js-subscribe" data-topic-id="{{$topic->id}}" data-user-id="1"><i class="material-icons">recommend</i>Đăng ký</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center" id="text-empty">
                <strong>Danh sách chủ đề đang trống.</strong>
            </div>
        @endforelse
    </div>
@endsection
@section('script')
    <script>
        let body = $('body');

        //Listen event onclick from button subscribe
        body.on('click', '.js-subscribe', function () {
            let topic_id = $(this).data("topic-id");
            let user_id = $(this).data("user-id");
            $.ajax({
                type:'POST',
                url: '{{route('subscribe.store')}}',
                data: {
                    topic_id: topic_id,
                    user_id: user_id,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    if(Number(data.code) == 1){

                        let url = '{{ route("user.exam", ":id") }}';
                        url = url.replace(':id', topic_id );

                        let footerButtons = `
                            <a type="button" class="btn btn-danger js-unsubscribe" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">clear</i>Hủy đăng ký</a>
                            <a href="`+ url +`" type="button" class="btn btn-info"><i class="material-icons">arrow_forward</i>Bắt đầu làm bài</a>
                        `;
                        $('#card-topic-'+ topic_id).removeClass('bg-danger');
                        $('#card-topic-'+ topic_id).addClass('bg-success');

                        $('#footer-button-' + topic_id).html(footerButtons);
                        //Alert success
                        Swal.fire(
                            'Thành công!',
                            'Đăng ký thành công.',
                            'success'
                        )

                    } else if (Number(data.code) == 2) {
                        Swal.fire(
                            'Thông báo',
                            'Bạn đã đăng ký.',
                            'warning'
                        )
                    } else {
                        Swal.fire(
                            'Lỗi!',
                            'Đăng ký không thành công.',
                            'error'
                        )
                    }
                }
            });
        })

        body.on('click', '.js-unsubscribe', function () {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Bạn sẽ hủy đăng ký chủ đề này.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Đóng',
                confirmButtonText: 'Okay, xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let topic_id = $(this).data("topic-id");
                    let user_id = $(this).data("user-id");
                    $.ajax({
                        type:'POST',
                        url: '{{route('subscribe.delete')}}',
                        data: {
                            topic_id: topic_id,
                            user_id: user_id,
                            _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            if(Number(data.code) == 1){

                                let footerButtons = `
                                    <a type="button" class="btn btn-warning js-subscribe" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">recommend</i>Đăng ký</a>
                                `;

                                $('#card-topic-'+ topic_id).addClass('bg-danger');
                                $('#card-topic-'+ topic_id).removeClass('bg-success');

                                $('#footer-button-' + topic_id).html(footerButtons);
                                //Alert success
                                Swal.fire(
                                    'Thành công!',
                                    'Hủy đăng ký thành công.',
                                    'success'
                                )

                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Hủy đăng ký không thành công.',
                                    'error'
                                )
                            }
                        }
                    });
                }
            });

        })


    </script>
@endsection
