<!DOCTYPE html>
<html xmlns:livewire="">
<head>
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
    <title>espace parents</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="{{asset('css/wizard.css')}}" rel="stylesheet" type="text/css"> </head>
<style>

    body{
        margin-top:40px;
    }
    /*progressbar*/
    .progressbar {
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
        width: 60%;
        margin: 0 auto 30px;
    }
    .progressbar li {
        list-style-type: none;
        color: white;
        text-transform: uppercase;
        font-size: 18px;
        width: 33.33%;
        float: left;
        position: relative;
        text-decoration: none;
    }
    .progressbar li a:hover{
        text-decoration: none;
    }
    .progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 50px;
        line-height: 50px;
        display: block;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        background: #eeeeee;
        border-radius: 50%;
        margin: 0 auto 5px auto;
    }
    /*progressbar connectors*/
    .progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1; /*put it behind the numbers*/
    }
    .progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none;
    }
    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    .progressbar li.active:before, .progressbar li.active:after {
        background: rgb(255,99,71);
        color: white;
    }
    .displayNone{
        display: none;
    }

</style>
<body>
<div class="container">

    <div class="card">
        <div class="card-header">
            espace parents
        </div>
        <div class="card-body">
            <livewire:wizard />
        </div>
    </div>
</div>

</body>
</html>
