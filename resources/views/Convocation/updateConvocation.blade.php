@extends('Dashboard.admin')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title ?? ""}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Modifier convocation</h1>

            <hr>

            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif

{{--            <ul>--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <li class="alert alert-danger">{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}


            <form action="{{ route('convocation.edit', $convocation->id) }}" method="POST">
                @csrf
                @method('PUT')


                <input type="text" name="id" style="display:none;" value="{{$convocation->id}}">
                <div class="form-group">
                    <label for="nom" class="form-label">title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"  placeholder="Enter nom" name="title" value="{{$convocation->title}}">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nom" class="form-label">raison</label>
                    <input type="text" class="form-control @error('raison') is-invalid @enderror" id="raison"  placeholder="Enter raison" name="raison" value="{{$convocation->raison}}">
                    @error('raion')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Objet</label>
                    <select name="objet" type="text" class="form-select {{ $errors->has('objet') ? 'alert alert-danger' : '' }} " id="objet" value="{{$convocation->objet}}">
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
                    <label for="inputPassword4" class="form-label ">Niveaux</label>
                    <select name="niveau_id" id="niveau_id" class="form-select @error('niveau_id') is-invalid @enderror"  aria-label=".form-select-lg example">
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

                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Classe</label>
                    <select name="class_id" id="class_id" class="form-select form-select-lg mb-3 @error('class_id') is-invalid @enderror" aria-label=".form-select-lg example">
                            <?php
                            $class=App\Models\Classe::get();
                            ?>
                        <option  selected disabled>select classe</option>
                        @foreach($class as $c)
                            <option value="{{ $c->id }}" data-niveau="{{ $c->niveau_id }}" style="display: none;" >{{ $c->title}}</option>
                        @endforeach

                    </select>
                    @error('class_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Etudiant</label>

                    <select name="etudiant_id[]" id="etudiant_id" class="selectpicker form-control {{ $errors->has('etudiant_id') ? ' is-invalid' : '' }}" multiple data-live-search="true"  >
                        <option value="" > selecte etudiant(s)</option>
                            <?php $etudiant=App\Models\Etudiant::get() ?>
                        @foreach($etudiant as $e)
                            <option value="{{$e->id}}" data-classe="{{ $e->class_id }}" >{{$e->nom}}  {{$e->prenom}}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('etudiant_id'))
                        <span class="invalid-feedback" role="alert">
             <strong>{{ $errors->first('etudiant_id') }}</strong>
         </span>
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary">modifier</button>
                <br>
                <br>
                <a href="/convocation/liste" class="btn btn-danger">revenir</a>
            </form>
        </div>
    </div>
</div>




    @endsection
    @section('scripts')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
                    $("#class_id").append('<option value="" disabled selected>Select classe</option>');
                    $.each(data, function(key, value) {
                        $("#class_id").append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });

        $("#niveau_id").trigger("change");
    });


</script>
<script>
    $(document).ready(function(){
        $("#class_id").change(function(){
            $.ajax({
                url: "{{ route('fetch-etudiant') }}",
                method: 'GET',
                data: {
                    class_id: $(this).val()
                },
                success: function(data){
                    $("#etudiant_id").empty();

                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    $("#etudiant_id").append('<option value="" disabled selected>Select student</option>');
                    $("#etudiant_id").append('<option value="' + data.id + '">' + data.nom + ' ' + data.prenom + '</option>');
                    $('#etudiant_id').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        });
    });


</script>
@endsection
</body>
</html>
