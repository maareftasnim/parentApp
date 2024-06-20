
    <title>
        {{$title ?? ""}}
    </title>

<body>

<div class="container">
    <div class="row">
        @foreach($convocations as $convocation)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $convocation->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Objet: {{ $convocation->objet }}</h6>
                        <p class="card-text">Raison: {{ $convocation->raison }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



</body>
