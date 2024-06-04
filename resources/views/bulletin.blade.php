<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-top-right-radius: 20%;
            border-collapse: collapse;
            background-color: #f2f2f2;
            width: 100%;
            margin-bottom: 50px;
            direction: rtl;
            margin-left: auto;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            border-top-right-radius: 20%;
            background-color: #8da4ef;
        }
        .rtl p {
            text-align: right;
        }
        .head {
            text-align: center;
            margin-left: auto;
            width: 100%;
            margin-bottom: 20px;
            height: 50px;
            border-top-right-radius: 20%;
            background-color: #8da4ef;
        }

        .head1 {
            text-align: center;
            margin-left: auto;
            width: 50%;
            margin-bottom: 20px;
            height: 50px;
            border-top-right-radius: 20%;
            background-color: #8da4ef;
        }

        .certificate {
            position: absolute;
            top: 140%;
            left: 20%;
            border-top-right-radius: 20%;
            background-color: rgba(115,129,143,0.48);
            height: 10%;
            width: 10%;
            text-align: center;
        }

        .average-table {
            width: 40%;
            height: 20%;
            position: absolute;
            margin-top: 20%;
            left: 7%;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@php
    $sumModuleAverage = 0;
    $totalModules = 0;
@endphp

<div style="height: 150px;margin-bottom: 20px" class="rtl">
    <p>{{ $etudiantId->nom }} {{ $etudiantId->prenom }}: اسم التلميذ(ة)</p>
    <p>{{ $classEtudiant->title }}: قسم</p>
    <p>{{ $semestre_id }}: ثلاثي </p>
    <img style="width: 200px; margin-top: -10%; border-style: none;" src="https://png.pngtree.com/png-clipart/20211009/original/pngtree-school-logo-design-png-image_6845305.png">
</div>
<div style="display: flex; direction: rtl;">
    <div style="display: flex; justify-content: flex-start; flex-direction: column; width: 50%; direction: rtl;">
        <input name="etudiant_id" id="etudiant_id" type="text" hidden value="{{ $etudiantId->id }}">
        <input type="text" hidden value="{{ $semestre_id }}" name="semestre_id" id="semestre_id">
        @foreach($classes as $classe)
            @if($etudiantId->class_id == $classe->id)
                <input type="text" hidden value="{{ $classe->id }}" name="classe_id" id="classe_id">
                @foreach($module as $m)
                    <div class="head"> {{ $m->name }}</div>
                    <table>
                        <tr>
                            <th>المادة</th>
                            <th>20/</th>
                            <th>ملاحظات</th>
                            <th>أعلى عدد في القسم</th>
                            <th>أدنى عدد في القسم</th>
                        </tr>
                        @php
                            $sumNotes = 0;
                            $matiereCount = 0;
                        @endphp
                        @foreach($matiers as $key)
                            @if($m->id == $key->module_id)
                                @php
                                    $notesForSubject = $notes->where('matier_id', $key->id);
                                    $maxNote = $notesForSubject->max('note');
                                    $minNote = $notesForSubject->min('note');
                                @endphp
                                <tr>
                                    <td>{{ $key->matiername }}</td>
                                    @foreach ($notesForSubject as $note)
                                        <td>{{ $note->note }}</td>
                                        @php
                                            $sumNotes += $note->note * $key->coef; // Somme des notes pondérées
                                            $matiereCount++;
                                        @endphp
                                    @endforeach
                                    <td></td>
                                    <td>{{ $maxNote }}</td>
                                    <td>{{ $minNote }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <table>
                        <tr>
                            <th>معدل المجال</th>
                            <th>{{ $matiereCount > 0 ? $sumNotes / $matiereCount : 0 }}</th>
                        </tr>
                    </table>
                    @php
                        $sumModuleAverage += $matiereCount > 0 ? $sumNotes / $matiereCount : 0;
                        $totalModules++;
                    @endphp
                @endforeach
                @php
                    $averageGeneral = $totalModules > 0 ? $sumModuleAverage / $totalModules : 0;
                @endphp
            @endif
        @endforeach
    </div>
    <div style="display: flex; justify-content: flex-start; flex-direction: column; direction: rtl;">
        <div class="certificate">
            @if ($averageGeneral < 15)
                شهادة تشجيع
            @else
                شهادة شكر
            @endif
        </div>
        <input type="hidden" name="moyenne" value="{{ $averageGeneral }}">
    </div>
    <table class="average-table">
        <tr>
            <th>معدل الثلاثي</th>
            <th> أعلى معدل </th>
            <th> أدنى معدل</th>
        </tr>
        <tr>
            <td>{{ $averageGeneral }}</td>
            <td>{{ $averageGeneral }}</td>
            <td>{{ $averageGeneral }}</td>
        </tr>
    </table>
</div>

{{--<button type="button" class="btn btn-success" onclick="window.print()">طباعة</button>--}}

</body>
</html>
