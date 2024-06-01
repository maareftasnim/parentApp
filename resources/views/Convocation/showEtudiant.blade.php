
    <title>
        {{$title ?? ""}}
    </title>

<body>

    <div>
        @foreach($convocations as $convocation)
        <h1>Convocation Details</h1>
        <p>Title: {{ $convocation->title }}</p>
        <p>Objet: {{ $convocation->objet }}</p>
        <p>Raison: {{ $convocation->raison }}</p>

        @endforeach
    </div>


</body>
