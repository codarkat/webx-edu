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
                                        <li class="list-group-item" id="clock-{{$topic->id}}">Thời gian làm bài: <span class="badge badge-style-light rounded-pill badge-info" id="topic-duration-{{$topic->id}}">{{$topic->duration}} Phút</span></li>
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
                        @if(in_array($topic->id, $results))
                        <a type="button" class="btn btn-dark js-unsubscribe-disable" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">clear</i>Hủy đăng ký</a>
                        @else
                        <a type="button" class="btn btn-danger js-unsubscribe" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">clear</i>Hủy đăng ký</a>
                        @endif


                            @if(in_array($topic->id, $results_processing))
                                <a type="button" class="btn btn-info js-continue-exam" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">arrow_forward</i>Tiếp tục làm bài</a>
                            @elseif(in_array($topic->id, $results_finished))
                                <a type="button" class="btn btn-info js-result-exam" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">arrow_forward</i>Kết quả</a>
                            @elseif(in_array($topic->id, $results_expired))
                                <a type="button" class="btn btn-danger"><i class="material-icons">report_off</i>Không hoàn thành bài kiểm tra</a>
                            @else
                                <a type="button" class="btn btn-info js-start-exam" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">arrow_forward</i>Bắt đầu làm bài</a>
                            @endif

                    </div>
                </div>
            </div>
            @else
                <div class="card widget widget-popular-blog bg-danger" id="card-topic-{{$topic->id}}">
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
                                            <li class="list-group-item" id="clock-{{$topic->id}}">Thời gian làm bài: <span class="badge badge-style-light rounded-pill badge-info" id="topic-duration-{{$topic->id}}">{{$topic->duration}} Phút</span></li>
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
                            <a type="button" class="btn btn-warning js-subscribe" data-topic-id="{{$topic->id}}" data-user-id="{{Auth::user()->id}}"><i class="material-icons">recommend</i>Đăng ký</a>
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


        body.on('click', '.js-start-exam', function () {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Thời gian làm bài sẽ bắt đầu được tính khi bạn đồng ý!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Đóng',
                confirmButtonText: 'Okay, bắt đầu!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let topic_id = $(this).data("topic-id");
                    let user_id = $(this).data("user-id");
                    $.ajax({
                        type:'POST',
                        url: '{{route('result.store')}}',
                        data: {
                            topic_id: topic_id,
                            user_id: user_id,
                            _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            if(Number(data.code) == 2){
                                let footerButtons = `
                                    <a type="button" class="btn btn-dark js-unsubscribe-disable" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">clear</i>Hủy đăng ký</a>
                                    <a type="button" class="btn btn-info js-continue-exam" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">arrow_forward</i>Tiếp tục làm bài</a>
                                `;
                                $('#footer-button-' + topic_id).html(footerButtons);
                                let url = '{{ route("user.exam", ":id") }}';
                                url = url.replace(':id', topic_id );
                                window.location.replace(url);
                            } else if (Number(data.code) == 1){
                                let footerButtons = `
                                    <a type="button" class="btn btn-dark js-unsubscribe-disable" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">clear</i>Hủy đăng ký</a>
                                    <a type="button" class="btn btn-info js-continue-exam" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">arrow_forward</i>Tiếp tục làm bài</a>
                                `;
                                $('#footer-button-' + topic_id).html(footerButtons);
                                let url = '{{ route("user.exam", ":id") }}';
                                url = url.replace(':id', topic_id );
                                window.location.replace(url);
                            } else if (Number(data.code) == 0) {
                                Swal.fire(
                                    'Lỗi',
                                    'Bài kiểm tra đã không được tạo thành công.',
                                    'error'
                                )
                            }
                        }
                    });
                }
            });
        })

        body.on('click', '.js-continue-exam', function () {
            let topic_id = $(this).data("topic-id");
            let user_id = $(this).data("user-id");
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
                        let url = '{{ route("user.exam", ":id") }}';
                        url = url.replace(':id', topic_id );
                        window.location.replace(url);
                    } else if(data.status === 'FINISHED'){
                        Swal.fire(
                            'Thông báo',
                            'Bài kiểm tra đã hết giờ.',
                            'warning'
                        )
                    }
                }
            });
        })

        body.on('click', '.js-result-exam', function () {
            let topic_id = $(this).data("topic-id");
            let url = '{{ route("user.result", ":id") }}';
            url = url.replace(':id', topic_id );
            window.location.replace(url);
        })

        body.on('click', '.js-unsubscribe-disable', function () {
            Swal.fire(
                'Thông báo',
                'Bạn không thể hủy đăng ký sau khi bài kiểm tra được tạo.',
                'warning'
            )
        })

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

                        let footerButtons = `
                            <a type="button" class="btn btn-danger js-unsubscribe" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">clear</i>Hủy đăng ký</a>
                            <a type="button" class="btn btn-info js-start-exam" data-topic-id="`+ topic_id +`" data-user-id="`+ user_id +`"><i class="material-icons">arrow_forward</i>Bắt đầu làm bài</a>
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

        function clock(topic_id){
            let url = '{{ route("result.get-clock", ":id") }}';
            url = url.replace(':id', topic_id );
            $.get(url, function (data) {
                console.log(data.clock)
                $('#clock-'+topic_id).countdown(data.clock, function(event) {
                    var $this = $(this).html(event.strftime('Thời gian còn lại: <span class="btn btn-warning btn-style-light">'
                        // + '<span>%H</span> giờ '
                        // + '<span>%M</span> phút '
                        // + '<span>%S</span> giây'
                        + '<span>%N</span>:'
                        + '<span>%S</span>'
                        + '</span>'
                    ))
                    if(event.offset.totalSeconds < 11){
                        $('.clock').addClass('bg-countdown-red')
                    };
                }).on('finish.countdown', function (){
                    let footerButtons = `
                                    <a type="button" class="btn btn-dark js-unsubscribe-disable" data-topic-id="`+ topic_id +`" data-user-id="{{Auth::user()->id}}"><i class="material-icons">clear</i>Hủy đăng ký</a>
                                    <a type="button" class="btn btn-danger"><i class="material-icons">report_off</i>Không hoàn thành bài kiểm tra</a>
                                `;
                    $('#footer-button-' + topic_id).html(footerButtons);
                });
            })
        }

        function topicsClock(){
            let url = '{{ route("topic.get-active-topics") }}';
            $.get(url, function (data) {
                $.each(data.topics, function( index, value ) {
                    let topic_id = value.id;
                    $.ajax({
                        type:'POST',
                        url: '{{route('result.check')}}',
                        data: {
                            topic_id: topic_id,
                            _token: '{{csrf_token()}}'
                        },
                        success:function(data){
                            if(data.status === 'PROCESSING'){
                                clock(topic_id);
                            } else if (data.status === 'FINISHED'){
                                $('#clock-'+topic_id).html(`<span class="btn btn-success btn-style-light">Đã hoàn thành</span>`)
                            }
                        }
                    });
                });
            })
        }

        topicsClock();

    </script>
@endsection
