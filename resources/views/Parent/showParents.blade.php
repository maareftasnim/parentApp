
@extends('layouts.parent')
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
<meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
<link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
<link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/favicon/favicon-32x32.png')}}">
<link href="../../../../icon.css?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-dark-menu-template/materialize.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-dark-menu-template/style.min.css')}}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/custom/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

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
@section('content')
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> view</h3>
                <table data-toggle="table">
                    <tr>
                        <td>nom :</td>
                        <td><strong>{{ $parents->nomP }}</strong></td>
                    </tr>
                    <tr>
                        <td>prenom :</td>
                        <td><strong>{{ $parents->prenomP }}</strong></td>
                    </tr>
                    <tr>
                        <td>metier :</td>
                        <td><strong>{{ $parents->metierP }}</strong></td>
                    </tr>
                    <tr>
                        <td>numero de tel:</td>
                        <td><strong>{{ $parents->numtelP }}</strong></td>
                    </tr>
                    <tr>
                        <td>nom de mere :</td>
                        <td><strong>{{ $parents->nomM }}</strong></td>
                    </tr>
                    <tr>
                        <td>prenom de mere :</td>
                        <td><strong>{{ $parents->prenomM }}</strong></td>
                    </tr>
                    <tr>
                        <td>metier :</td>
                        <td><strong>{{ $parents->metierM }}</strong></td>
                    </tr>
                    <tr>
                        <td>numero de tel:</td>
                        <td><strong>{{ $parents->numtelM }}</strong></td>
                    </tr>
                    <tr>
                        <td>numero de tel (seure):</td>
                        <td><strong>{{ $parents->numtelS }}</strong></td>
                    </tr>
                    <tr>
                        <td>numero de tel(frère):</td>
                        <td><strong>{{ $parents->numtelF }}</strong></td>
                    </tr>

                </table>
                <a href="{{ route('parents.edit', $parents->id) }}" class="btn btn-info">update</a>
                <hr>
                <h3>Liste des enfants</h3>
{{--                <?php--}}
{{--                $etudiants = App\Models\Etudiant::get();--}}
{{--                ?>--}}
{{--                @foreach($etudiants as $etudiant)--}}
{{--                    @if($etudiant->parent_id == $parents->id)--}}

{{--                    @endif--}}
{{--                @endforeach--}}
                <table class="table table-bordered table-striped data-table">
                    <thead>
                    <tr>
                        <th><span>nom</span></th>
                        <th class="text-center"><span>avatar</span></th>
                        <th><span>prenom</span></th>
                        <th><span>date_naissance</span></th>
                        <th><span>niveau</span></th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($etudiants as $etudiant)

                        <tr>
                            <td><strong>{{ $etudiant->nom }}</strong></td>

                            <td><img src="{{ asset('storage/'.$etudiant->avatar) }}" class="img-responsive"></td>

                            <td><strong>{{ $etudiant->prenom }}</strong></td>

                            <td><strong>{{ $etudiant->date_naissance }}</strong></td>

                            <td><strong>{{ $etudiant->niveau_id }}</strong></td>
                            <td><a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-info">show enfants</a>
                                <a href="{{ route('etudiant.editparent', $etudiant->id) }}" class="btn btn-info">update enfants</a>

                            </td>

                        </tr>

                    @empty

                        no data base
                    @endforelse


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection




