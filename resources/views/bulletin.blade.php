

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
            text-align: left;
        }

        th {

            border-top-right-radius: 20%;
            background-color: #8da4ef;
        }
        .head{
            text-align:center;
            margin-left: auto;
            width: 100%;
            margin-bottom: 20px ;
            height: 50px;
            border-top-right-radius: 20%;
            background-color: #8da4ef;
        }
        .head1{
             text-align:center;
             margin-left: auto;
             width: 50%;
             margin-bottom: 20px ;
             height: 50px;
             border-top-right-radius: 20%;
             background-color: #8da4ef;
         }


    </style>
</head>

<body>
@php
    $sumModuleAverage = 0;
    $totalModules = 0;
@endphp


<div style="border: solid black;height: 100px;margin-bottom: 20px"></div>
<div style=" display: flex;
 direction: rtl;
    /* width: 100%;

     flex-direction: row;
     flex-wrap: nowrap;
     align-items: center;*/">
<div style="    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    width: 50%;
    direction: rtl;">


    @foreach($classes as $classe)
        @if($etudiantId->class_id == $classe->id)
@foreach($module as $m)
    <div class="head"> {{$m->name}}</div>

    <table>
        <tr>
            <th >   المادة</th>
            <th>20/</th>
            <th>ملاحضات</th>
            <th>أعلى عدد في القسم </th>
            <th>ادنى عدد في القسم </th>

        </tr>
        @php
            $rowCount = count($matiers);
            $sumNotes = 0;
            $matiereCount = 0;
        @endphp
        @foreach($matiers as $mat=>$key)
            @if($m->id == $key->module_id)
                <tr>
                    <td>{{$key->matiername}}</td>
                    @foreach ($notes as $note)
                        @if($note->matier_id == $key->id)
                            <td>{{$note->note}}</td>
                            @php
                                $sumNotes += $note->note * $key->coef; // Somme des notes pondérées
                                $matiereCount++;
                            @endphp
                        @endif
                    @endforeach

{{--                    @if($mat==0)--}}
{{--                        <td rowspan="{{$rowCount}}"></td>--}}
{{--                    @endif--}}
                    <td></td>
                    <td>0</td>
                    <td>0</td>

                </tr>
            @endif
        @endforeach

    </table>
    <table>
        <tr>
            <th> معدل المجال </th>
            <th> {{ $matiereCount > 0 ? $sumNotes / $matiereCount : 0 }} </th>

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

</div>


<div style="display: flex;justify-content: flex-start;flex-direction: column;direction: rtl;">


<div style="position: absolute; margin-top: 20%; left: 20%; border-top-right-radius: 20%;background-color:slategrey; height: 20%;width: 20%;text-align: center" >معدل الثلاثي :    {{ $averageGeneral }}</div>
<div style="position: absolute;  left: 20%; border-top-right-radius: 20%;background-color:slategrey; height: 20%;width: 20%;text-align: center"> شهادة: </div>
</div>

</div>
@endif
@endforeach


</body>

</html>

