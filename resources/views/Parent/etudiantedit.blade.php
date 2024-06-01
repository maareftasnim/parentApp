@extends('layouts.parent')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Modifier un etudiant</h1>

            <hr>

            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif

            <ul>
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>


            <form action="{{ route('etudiant.updateparent', $etudiant->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="text-center">
                    <input type="file" name="avatar" id="avatar"><br>
                    <img type="file" class="rounded"  src="{{ asset('storage/'.$etudiant->avatar) }}"/>

                </div>


                <input type="text" name="id" style="display:none;" value="{{$etudiant->id}}">
                <div class="form-group">
                    <label for="nom" class="form-label">nom</label>
                    <input type="text" class="form-control" id="nom"  placeholder="Enter nom" name="nom" value="{{$etudiant->nom}}">
                </div>

                <div class="form-group">
                    <label for="description">Date de Naissance:</label>
                    <input type="date" class="form-control" name="date_naissance" value="{{$etudiant->date_naissance}}" />

                </div>

                <div class="form-group">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control"  placeholder="Prenom" name="prenom" value="{{$etudiant->prenom}}">
                </div>

{{--                <select name="niveau_id" id="niveau_id" class="form-select form-select-lg mb-3" value="{{$etudiant->niveau_id}}">--}}
{{--                    <option disabled> Select niveau</option>--}}
{{--                    <?php $niveaux = App\Models\Niveau::get(); ?>--}}
{{--                    @foreach($niveaux as $n)--}}
{{--                        <option value="{{ $n->id }}" {{ $n->id == $etudiant->niveau_id ? 'selected' : '' }}>{{ $n->niveauNom }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

                <br>
                <button type="submit" class="btn btn-primary">modifier</button>
                <br>
                <br>
                <a href="" class="btn btn-danger">revenir</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    {{--$(document).ready(function(){--}}
    {{--    $("#niveau_id").change(function(){--}}
    {{--        $.ajax({--}}
    {{--            url: "{{ route('fetch-niveau') }}",--}}
    {{--            method: 'GET',--}}
    {{--            data: {--}}
    {{--                niveau_id: $(this).val()--}}
    {{--            },--}}
    {{--            success: function(data){--}}
    {{--                $("#class_id").empty();--}}
    {{--                $("#class_id").append('<option value="" disabled selected>Select classe</option>');--}}
    {{--                $.each(data, function(key, value) {--}}
    {{--                    $("#class_id").append('<option value="' + key + '">' + value + '</option>');--}}
    {{--                });--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}

    {{--    $("#niveau_id").trigger("change");--}}
    {{--});--}}
</script>

@endsection

</body>
</html>
