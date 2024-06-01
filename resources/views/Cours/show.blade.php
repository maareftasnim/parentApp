
    <!DOCTYPE html>
<html>
<head>
    <title>cours</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

    <?php
    $controller = new App\Http\Controllers\Controller;

    ?>
    <div class="container">



        <table class="table table-bordered table-striped data-table">
            <thead>
            <tr>
                <th><span>Cours</span></th>
                <th class="text-center"><span>videos</span></th>
                <th><span>lien</span></th>
                <th><span>matiers</span></th>


            </tr>
            </thead>
            <tbody>

            @forelse($cours as $cour)

                <tr>
                    <td>

                        <a href="#" class="user-link">{{$cour->title}}</a>

                    </td>
                    <td>
                        {{--<a href="{{$cour->lien}}" class="user-link"></a>
                         <a href="{{$cour->lien}}"
                           media="screen, handheld, only screen and (max-width: 480px)">
                            {{$cour->lien}}
                        </a>
                        --}}

                        <iframe width="160" height="160" src="{{$cour->lien}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </td>
                    <td>

                        @foreach($cour->documents as $document)
                            <a href="{{ Storage::url('public/filesCours/pdf/' . $document) }}" target="_blank">{{ $document }}</a><br>
                        @endforeach

                    </td>

                    <td>

                        @foreach($matiers as $matier)
                            @if($matier->id == $cour->matier_id)
                                <a >{{$matier->matiername}}</a>
                            @endif
                        @endforeach
                    </td>


                </tr>

            @empty

                no data base
            @endforelse


            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>

</body>
</html>
