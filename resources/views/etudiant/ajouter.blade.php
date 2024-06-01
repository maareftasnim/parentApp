
@extends('layouts.parent')
    <!DOCTYPE html>
<html>
<head>
    <title>ajout etudiant</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

</head>
<body>
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add Etudiant</h3>
                <form id="niveauForm1" action="{{ route('etudiant.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nom" class="form-label">nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus id="nom" placeholder="Enter nom">
                        @error('nom')
                        <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus  placeholder="Prenom"name="prenom">
                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_naissance" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance" value="{{ old('date_naissance') }}" required autocomplete="date_naissance" autofocus id="date_naissance">
                        @error('date_naissance')
                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                        @enderror
                    </div>

                        <input name="parent_id" id="parent_id" class="form-label" value="{{$parents}}" hidden>


                    <div class="form-group">
                        <select name="niveau_id" id="niveau_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <?php
                                $niveau=App\Models\Niveau::get();
                                ?>
                            <option value="">select niveau</option>
                            @foreach($niveau as $n)
                                <option value="{{ $n->id }}">{{ $n->niveauNom }}</option>
                            @endforeach
                        </select>
{{--                        <select name="class_id" id="class_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">--}}
{{--                                <?php--}}
{{--                                $class=App\Models\Classe::get();--}}
{{--                                ?>--}}
{{--                            <option  selected disabled>select classe</option>--}}
{{--                            @foreach($class as $c)--}}
{{--                                <option value="{{ $c->id }}" data-niveau="{{ $c->niveau_id }}" style="display: none;" >{{ $c->title}}</option>--}}
{{--                            @endforeach--}}

{{--                        </select>--}}
                    </div>


                    <br>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Create class</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function submitForm() {
            var formData = $('#niveauForm1').serialize();

            $.ajax({
                type: 'POST',
                url: $('#niveauForm1').attr('action'),
                data: formData,
                success: function(response) {

                    window.location.href = "{{ route('etudiant.create') }}";
                },

            });
        }
    </script>
    <script>
        document.getElementById('niveau_id').addEventListener('change', function () {
            var niveauId = this.value;
            var classOptions = document.getElementById('class_id').options;

            for (var i = 0; i < classOptions.length; i++) {
                classOptions[i].style.display = 'none';
            }

            for (var i = 0; i < classOptions.length; i++) {
                if (classOptions[i].getAttribute('data-niveau') === niveauId) {
                    classOptions[i].style.display = '';
                }
            }
        });
    </script>
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>

@endsection
</body>
</html>
