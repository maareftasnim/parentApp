@extends('layouts.parent')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{$etudiant->nom}} {{$etudiant->prenom}}</h4>
                                    <p class="mb-1">{{$etudiant->date_naissance}}</p>
                                    <p class="text-muted font-size-sm">{{$etudiant->class_id}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{$etudiant->nom}} {{$etudiant->prenom}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date naissance</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{$etudiant->date_naissance}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Niveau</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    @if($etudiant->niveau_id)
                                        @foreach($niveaux as $niveau)
                                            @if($niveau->id == $etudiant->niveau_id)
                                                {{$niveau->niveauNom}}
                                            @endif
                                        @endforeach
                                    @else
                                        without niveau
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">classe</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    @if($etudiant->class_id)
                                        @foreach($classe as $class)
                                            @if($class->id == $etudiant->class_id)
                                                {{$class->title}}
                                            @endif
                                        @endforeach
                                    @else
                                        without classe
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#emploi">Emploi <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#convocation">Convocation</a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bulletin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $semestre=\Illuminate\Support\Facades\DB::table('trimester')->whereNull('deleted_at')->get()
                        ?>
                        @foreach($semestre as $s)
                            <a class="dropdown-item" href="#semestre{{$s->id}}" data-id="{{$s->id}}" name="semester_id" id="semester_id">{{$s->title}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#cours" tabindex="-1" aria-disabled="true">Cours</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#travail" tabindex="-1" aria-disabled="true">Travail a faire</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#quiz" tabindex="-1" aria-disabled="true">Quiz</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="contenu-carte"></div>
    <button id="printButton" class="btn btn-primary">Print</button>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function afficherContenu(contenu) {
                document.getElementById("contenu-carte").innerHTML = contenu;
            }

            document.querySelectorAll('a.dropdown-item').forEach(function(item) {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    var semesterId = this.getAttribute('data-id');
                    fetchSemesterNotes(semesterId);
                });
            });

            function fetchSemesterNotes(semesterId) {
                var etudiantId = "<?php echo $etudiant->id; ?>";
                if (etudiantId !== "") {
                    var semestre = new XMLHttpRequest();
                    semestre.onreadystatechange = function() {
                        if (semestre.readyState === XMLHttpRequest.DONE) {
                            if (semestre.status === 200) {
                                afficherContenu(semestre.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    semestre.open('GET', '/etudiants/shownote/' + etudiantId + '/' + semesterId, true);
                    semestre.send();
                } else {
                    afficherContenu("La classe n'existe pas");
                }
            }

            document.querySelector('a[href="#emploi"]').addEventListener("click", function(event) {
                event.preventDefault();
                var classId = "<?php echo $etudiant->class_id; ?>";
                if (classId !== "") {
                    var emploi = new XMLHttpRequest();
                    emploi.onreadystatechange = function() {
                        if (emploi.readyState === XMLHttpRequest.DONE) {
                            if (emploi.status === 200) {
                                afficherContenu(emploi.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    emploi.open('GET', '/emploi/emploi/' + classId + '/show', true);
                    emploi.send();
                } else {
                    afficherContenu("La classe n'existe pas");
                }
            });

            document.querySelector('a[href="#quiz"]').addEventListener("click", function(event) {
                event.preventDefault();
                var etudiantId = "<?php echo $etudiant->id; ?>";
                if (etudiantId !== "") {
                    var quiz = new XMLHttpRequest();
                    quiz.onreadystatechange = function() {
                        if (quiz.readyState === XMLHttpRequest.DONE) {
                            if (quiz.status === 200) {
                                afficherContenu(quiz.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    quiz.open('GET', '/quiz/test/' + etudiantId, true);
                    quiz.send();
                } else {
                    afficherContenu("La classe n'existe pas");
                }
            });

            document.querySelector('a[href="#cours"]').addEventListener("click", function(event) {
                event.preventDefault();
                var classId = "<?php echo $etudiant->class_id; ?>";
                if (classId !== "") {
                    var cours = new XMLHttpRequest();
                    cours.onreadystatechange = function() {
                        if (cours.readyState === XMLHttpRequest.DONE) {
                            if (cours.status === 200) {
                                afficherContenu(cours.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    cours.open('GET', '/etudiants/showCours/' + classId, true);
                    cours.send();
                } else {
                    afficherContenu("La classe n'existe pas");
                }
            });

            document.querySelector('a[href="#convocation"]').addEventListener("click", function(event) {
                event.preventDefault();
                var etudiantId = "<?php echo $etudiant->id; ?>";
                if (etudiantId !== "") {
                    var convocation = new XMLHttpRequest();
                    convocation.onreadystatechange = function() {
                        if (convocation.readyState === XMLHttpRequest.DONE) {
                            if (convocation.status === 200) {
                                afficherContenu(convocation.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    convocation.open('GET', '/etudiants/showConvocation/' + etudiantId, true);
                    convocation.send();
                } else {
                    afficherContenu("La classe n'existe pas");
                }
            });

            document.querySelector('a[href="#travail"]').addEventListener("click", function(event) {
                event.preventDefault();
                var etudiantId = "<?php echo $etudiant->id; ?>";
                var classId = "<?php echo $etudiant->class_id; ?>";
                if (classId !== "") {
                    var travail = new XMLHttpRequest();
                    travail.onreadystatechange = function() {
                        if (travail.readyState === XMLHttpRequest.DONE) {
                            if (travail.status === 200) {
                                afficherContenu(travail.responseText);
                            } else {
                                console.error('Erreur lors du chargement de la vue');
                            }
                        }
                    };
                    travail.open('GET', '/etudiants/showTravail/' + etudiantId, true);
                    travail.send();
                } else {
                    afficherContenu("Le travail a faire n'existe pas");
                }
            });

            // Print functionality
            document.getElementById('printButton').addEventListener('click', function() {
                var printContents = document.getElementById('contenu-carte').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload(); // reload the page to reset the content
            });
        });
    </script>
@endsection
