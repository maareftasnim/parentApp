
@extends('Dashboard.admin')
    <!DOCTYPE html>
<html>
<head>
    @section('title')
        <title>{{$title ?? ""}}</title>
    @endsection
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('app-assets/js/search.min.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/customizer.min.js')}}"></script>

</head>
<body>
@section('content')
    <div class="container">
        <?php
        $controller = new App\Http\Controllers\Controller;

        ?>
        <h3 class="text-center mt-4 mb-5">liste_convocation</h3>
        <a href="{{route('convocation.index')}}" class="btn btn-primary">ajouter convocation</a>
        <hr>
        @if(Session::has('sucess'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{Session::get('sucess')}}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered table-striped data-table">
            <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>raison</th>
                <th>objet</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($convocations as $c)

                <tr>
                    <td>

                        <a  class="user-link">{{$c->id}}</a>

                    </td>
                    <td>

                        <a  class="user-link">{{$c->title}}</a>

                    </td>
                    <td>

                        <a  class="user-link">{{$c->objet}}</a>

                    </td>
                    <td>

                        <a  class="user-link">{{$c->raison}}</a>

                    </td>


                    <td class="text-center">
                        @if($controller->checkUserPermissionforAdmin('update-convocation','admin','teachers'))

                            <a href="{{ route('convocation.update', $c->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        @endif
                        @if($controller->checkUserPermissionforAdmin('show-convocation','admin','teachers'))

                            <a href="{{ route('convocation.show', $c->id) }}" class="btn btn-primary btn-sm">Show</a>
                        @endif
                        @if($controller->checkUserPermissionforAdmin('delete-convocation','admin','teachers'))

                            <button type="button" class="btn btn-danger btn-flat show-alert-delete-box btn-sm" data-id="{{$c->id}}" data-name="{{$c->title}}" data-toggle="tooltip" title='Delete'>Delete</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('app-assets/js/search.min.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/customizer.min.js')}}"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var id = $(this).data("id");
            var name = $(this).data("name");

            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "/convocation/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function (data) {
                            console.log(data);

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    location.reload();
                }
            });

        });
    </script>
@endsection
</body>
</html>
