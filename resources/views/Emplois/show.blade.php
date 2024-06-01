{{--@extends('layouts.parent')--}}
    <!DOCTYPE html>
<html>
<head>

    <style>
        table, td {
            border: 1px solid black;
        }
        .lightbox {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid black;
            z-index: 9999;
        }
        .lightbox input {
            width: 100%;
        }
        td:hover {
            background-color: #f5f5f5;
        }
        th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            background-color: #f2f2f2;
        }
        th:hover {
            background-color: #e6e6e6;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
{{--@section('content')--}}
{{--    <?php--}}
{{--    $controller = new App\Http\Controllers\Controller;--}}

{{--    ?>--}}
<form action="{{ route('emploi.show', $classe->id) }}" >
    @csrf


    <div class="form-group">
        <label for="Niveau">classe</label>



                <input  value="{{$classe->title}}">


    </div>

</form>
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered">

        <thead id="tbody">
        <th></th>

        @foreach($days as $day)

            <th id="day_id" name="day_id" >{{$day->days}}</th>

        @endforeach
        </thead>
        <tbody>

        @foreach($calendarData as $time => $days)

            <tr>
                <td>
                    {{ $time }}
                </td>

                @foreach($days as $value)

                    @if (is_array($value))
                        <td data-seance-id="{{ $value['seance_id'] }}" data-toggle="modal" data-target="#updateModal" data-whatever="@getbootstrap" id="emploiTable" rowspan="{{ $value['rowspan'] }}">
                            {{ $value['matier_name'] }}<br>
                            Teacher: {{ $value['teacher_name'] }}
                            Salle:{{$value['salle_name']}}
                            {{--                            <form action="{{ route('seance.delete', ['id' => $value['seance_id']]) }}" method="post">--}}
                            {{--                                @csrf--}}
                            {{--                                @method('DELETE')--}}
                            {{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
                            {{--                            </form>--}}
                        </td>

                    @elseif ($value === 1)
                        <td data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"  ></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



{{--@endsection--}}
{{--@section('scripts')--}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">




{{--@endsection--}}
</body>
</html>


