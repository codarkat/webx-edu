@extends('layouts.main-layout')

@section('content')
    <div class="page-description text-center">
        <div class="page-description-content">
            <h1>Danh sách kết quả</h1>
            <span>MIREA EDUCATION SYSTEM</span>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách kết quả</h5>
        </div>
        <div class="card-body">
            <table id="results-datatable" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Chủ đề</th>
                    <th>Số câu đúng</th>
                    <th>Số câu sai</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                {{--JS Datatable--}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>

        let body = $('body');

        body.on('click', '.ajax-view-result', function () {
            let topic_id = $(this).data("topic-id");
            let url = '{{ route("user.result", ":id") }}';
            url = url.replace(':id', topic_id );
            window.location.replace(url);
        });

        //Get data for table
        $(function () {
            let url = '{{ route("result.get-user-results", ":user_id") }}';
            let user_id = {{Auth::user()->id}};
            url = url.replace(':user_id', user_id );
            let table = $('#results-datatable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json'
                },
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'topic', name: 'topic'},
                    {data: 'num_correct', name: 'num_correct'},
                    {data: 'num_incorrect', name: 'num_incorrect'},
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
