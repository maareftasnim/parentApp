    <!DOCTYPE html>
<html>
<head>
    <title> travail</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">


        <table class="table table-bordered table-striped data-table">
            <thead>
            <tr>
                <th><span>Travail</span></th>
                <th class="text-center"><span>lien</span></th>
                <th><span>document</span></th>



            </tr>
            </thead>
            <tbody>
            @forelse($travail as $cour)


                <tr>
                    <td>
                        <a  class="user-link">{{$cour->title}}</a>

                    </td>
                    <td>


                        <iframe width="160" height="160" src="{{$cour->lien}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </td>
                    <td>

                        @foreach($cour->documents as $document)
                            <a href="{{ Storage::url('files/pdf/' . $document) }}" target="_blank">{{ $document }}</a><br>
                        @endforeach

                    </td>




                </tr>

            @empty

                no data base
            @endforelse


            </tbody>
        </table>
    </div>

</body>
</html>
