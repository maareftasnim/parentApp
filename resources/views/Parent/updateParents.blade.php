@extends('layouts.parent')
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<head>
    <title> parent</title>
    @notifyCss
</head>
@section('content')

<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <h3>Update Parents</h3>

             <form action="{{ route('parents.update', $parents->id) }}" method="post">
                @csrf
                @method('PUT')
                 @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                         <p>{{ Session::get('success') }}</p>
                     </div>
                 @endif
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nomP">Nom de père</label>
                        <input type="text" class="form-control @error('nomP') is-invalid @enderror" name="nomP" value="{{ $parents->nomP }}" >
                   @error('nomP')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenomP">Prénom de père</label>
                        <input type="text" class="form-control @error('prenomP') is-invalid @enderror" name="prenomP" value="{{ $parents->prenomP }}" >
                        @error('prenomP')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror</div>
                    <div class="form-group">
                        <label for="metierP">Métier de père</label>
                        <input type="text" class="form-control @error('metierP') is-invalid @enderror" name="metierP" value="{{ $parents->metierP }}" >
                        @error('metierP')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">num tel de père</label>
                        <input type="text" class="form-control @error('numtelP') is-invalid @enderror" name="numtelP" value="{{ $parents->numtelP }}" >

                        @error('numtelP')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomM">Nom de mère</label>
                        <input type="text" class="form-control @error('nomM') is-invalid @enderror" name="nomM" value="{{ $parents->nomM }}" >
                        @error('nomM')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenomM">Prénom de mère</label>
                        <input type="text" class="form-control @error('prenomM') is-invalid @enderror" name="prenomM" value="{{ $parents->prenomM }}" >
                        @error('prenomM')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">Métier de mère</label>
                        <input type="text" class="form-control @error('metierM') is-invalid @enderror " name="metierM" value="{{ $parents->metierM }}" >
                        @error('metierM')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">num tel de mère</label>
                        <input type="text" class="form-control @error('numtelM') is-invalid @enderror" name="numtelM" value="{{ $parents->numtelM }}" >
                        @error('numtelM')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">num tel de frère</label>
                        <input type="text" class="form-control @error('numtelF') is-invalid @enderror" name="numtelF" value="{{ $parents->numtelF }}" >
                        @error('numtelF')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">num tel de seure</label>
                        <input type="text" class="form-control @error('numtelS') is-invalid @enderror" name="numtelS" value="{{ $parents->numtelS }}">
                        @error('numtelS')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metierM">email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $parents->email }}">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">password:</label>
                        <input type="password" name="password" class="form-control" id="password" value="{{ $parents->password }}"/>
                        @error('password')
                        <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">password:</label>
                        <input type="password" name="confirme_password"  class="form-control" id="confirme_password" value="{{ $parents->password }}"/>
                        @error('confirme_password') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>

                </div>

                <button type="submit" class="btn mt-3 btn-primary">Mettre à jour </button>
            </form>

            <x-notify::notify />
            @notifyJs

        </div>
    </div>
</div>
@endsection
