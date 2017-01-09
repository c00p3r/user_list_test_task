@extends('main')


@section('styles')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.css"/>
@stop

@section('content')
    <table class="table table-bordered table-responsive table-hover table-striped" id="users-table">
        <thead>
        <tr>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Телефон</th>
            <th>Адреса</th>
            <th>Дата створення</th>
            <th>Відгуків</th>
            <th>Останній відгук</th>
        </tr>
        </thead>
        <tfoot>
        <tr class="filters">
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Телефон</th>
            <th>Адреса</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
@stop

@section('scripts')
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>

    <script>
        $(function () {
            // add input to each footer cell
            $('#users-table').find('.filters th').each(function (i) {
                var title = $(this).text();
                if(title) {
                    $(this).html('<input type="text" class="form-control" style="width:100%" placeholder="Шукати ' + title + '" data-index="' + i + '" />');
                }
            });

            var table = $('#users-table').DataTable({
                processing : true,
                serverSide : true,
                //                searching  : false,
                ajax       : '{!! route('users_data') !!}',
                columns    : [
                    {data : 'first_name'},
                    {data : 'last_name'},
                    {data : 'phone', orderable : false},
                    {data : 'address', orderable : false},
                    {data : 'created_at'},
                    {data : 'count'},
                    {data : 'last_comment', orderable : false}
                ]
            });

            // Filter event handler
            $(table.table().container()).on('change', '.filters input', function () {
                table
                .column($(this).data('index'))
                .search(this.value)
                .draw();
            });
        });
    </script>
@stop