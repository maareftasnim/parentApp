{{--@extends('Dashboard.admin')--}}
@extends('layouts.admin')
<!DOCTYPE html>
<html xmlns:x-notify="" xmlns="http://www.w3.org/1999/html">

<head>
{{--    @section('title')--}}
    <title>{{$title ?? ""}}</title>
{{--    @endsection--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
        @notifyCss


</head>

<style>

</style>
<body>
@section('content')
@if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
<form class="row g-3" id="convocationForm" action="{{ route('convocation.store') }}" method="post">
    @csrf

    <div class="col-md-8">
        <label for="inputEmail4" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  >
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="inputPassword4" class="form-label ">Niveaux</label>
        <select name="niveau_id" id="niveau_id" class="form-select @error('niveau_id') is-invalid @enderror"   >
                <?php
                $niveau=App\Models\Niveau::get();
                ?>
            <option value="">select niveau</option>
            @foreach($niveau as $n)
                <option value="{{ $n->id }}">{{ $n->niveauNom }}</option>
            @endforeach
        </select>
        @error('niveau_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="col-md-8">
        <label for="inputEmail4" class="form-label">Objet</label>
        <select name="objet" type="text" class="form-select {{ $errors->has('objet') ? 'alert alert-danger' : '' }} " id="objet">
            <option disabled> select un objet</option>
            <option value="bonjour"> dfsg</option>
            <option value="tesnim"> ggsdyhyyu </option>
            <option value="maaref"> ggsdyhyyu</option>

        </select>
        @if ($errors->has('objet'))
            <span class="alert alert-danger" role="alert">
               <strong>{{ $errors->first('objet') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-4">
        <label for="inputPassword4" class="form-label">Classe</label>
        <select name="class_id" id="class_id" class="form-select form-select-lg mb-3 @error('class_id') is-invalid @enderror" >
                <?php
                $class=App\Models\Classe::get();
                ?>
            <option   >select classe</option>
            @foreach($class as $c)
                <option value="{{ $c->id }}" data-niveau="{{ $c->niveau_id }}" style="display: none;" >{{ $c->title}}</option>
            @endforeach

        </select>
        @error('class_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="col-md-8">
        <label for="floatingTextarea2">Comments</label>
        <textarea name="raison" class="form-control @error('raison') is-invalid @enderror" placeholder="raison" id="floatingTextarea2" style="height: 100px" {{ old('raison') }} ></textarea>
    @error('raison')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="inputPassword4" class="form-label">Etudiant</label>

        <select name="etudiant_id[]" id="etudiant_id" class="form-control selectpicker  {{ $errors->has('etudiant_id') ? ' is-invalid' : '' }}"  multiple  >
            <option > selecte etudiant(s)</option>

{{--                <?php $etudiant=App\Models\Etudiant::get() ?>--}}
{{--            @foreach($etudiant as $e)--}}
{{--                <option value="{{$e->id}}" data-classe="{{ $e->class_id }}" style="display: none;">{{$e->nom}}  {{$e->prenom}}</option>--}}
{{--            @endforeach--}}

        </select>
        @if ($errors->has('etudiant_id'))
            <span class="invalid-feedback" role="alert">
             <strong>{{ $errors->first('etudiant_id') }}</strong>
         </span>
        @endif
    </div>



    <div class="col-12">
        <button type="submit" class="btn btn-primary">envoyer</button>
        <x-notify::notify />
        @notifyJs
    </div>
</form>
@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />


<script>
        $(document).ready(function(){
            $("#niveau_id").change(function(){
                var  niveau_id= $(this).val()
                $.ajax({
                    url: "{{ route('fetch-niveau') }}",
                    method: 'GET',
                    data: {
                        niveau_id:niveau_id
                    },
                    success: function(data){
                        $("#class_id").empty();
                        $("#class_id").append('<option value="" >Select classe</option>');
                        $.each(data, function(key, value) {
                            $("#class_id").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            });

            $("#niveau_id").trigger("change");
        });



        $(document).ready(function() {
            $("#class_id").change(function () {
                $.ajax({
                    url: "{{ route('fetch-students') }}",
                    method: 'GET',
                    data: {
                        class_id: $(this).val()
                    },
                    success: function (data) {
                        $("#etudiant_id").empty();

                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        $("#etudiant_id").append('<option value=""  >Select student</option>');

                        $.each(data, function (index, student) {
                            $("#etudiant_id").append('<option value="' + student.id + '">' + student.nom + ' ' + student.prenom + '</option>');
                        });

                        $('#etudiant_id').selectpicker('refresh');
                    },
                    error: function (xhr, status, error) {
                        alert("An error occurred: " + error);
                    }

                });

            });
        })

    </script>
@endsection
{{--@section('footer')--}}

    <x-notify::notify />
    @notifyJs
{{--@endsection--}}
</body>


</html>

