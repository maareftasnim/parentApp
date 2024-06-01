{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Login</title>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div>--}}
{{--    <button id="teacher">Teacher</button>--}}
{{--    <button id="admin">Admin</button>--}}

{{--</div>--}}


{{--<div id="adminLoginForm">--}}
{{--    <h2>Admin Login</h2>--}}
{{--    <form id="adminForm" action="{{ route('admin.login') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <label for="adminEmail">Email:</label>--}}
{{--        <input   name="identify" >--}}
{{--        <label for="adminPassword">Password:</label>--}}
{{--        <input type="password" id="password" name="password" required>--}}
{{--        <button type="submit" >Login</button>--}}
{{--    </form>--}}
{{--</div>--}}
{{--<div id="teacherLoginForm" style="display:none;">--}}
{{--    <h2>Teacher Login</h2>--}}
{{--    <form id="teacherForm" action="{{ route('teacher.login') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <label for="teacherEmail">Email:</label>--}}
{{--        <input   name="identify" >--}}
{{--        <label for="teacherPassword">Password:</label>--}}
{{--        <input type="password" id="password" name="password" >--}}
{{--        <button type="submit" >Login</button>--}}
{{--    </form>--}}
{{--</div>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,
                         initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet"
          href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
{{--<header>--}}
{{--    <h1 class="heading">Login</h1>--}}
{{--    <h3 class="title">admin Login & Teacher Login</h3>--}}
{{--</header>--}}


<div class="container">

    <div class="slider"></div>
    <div class="btn">
        <button id="admin" class="login">Admin</button>
        <button id="teacher" class="teacher">Teacher</button>
    </div>
    @if(Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    <!-- Form section that contains the
         login and the signup form -->
    <div class="form-section">

        <!-- Admin form -->
        <form id="adminForm" action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="login-box">
                <input name="identify"
                       class="email ele"
                       placeholder="youremail@email.com">
                <input type="password" id="password" name="password"
                       class="password ele"
                       placeholder="password">
                <button type="submit" class="clkbtn">Login</button>
            </div>

        </form>

        <!-- Teacher form -->
        <form id="teacherForm" action="{{ route('teacher.login') }}" method="POST">
            @csrf
            <div class="login-box">
                <input name="identify"
                       class=" form-control @error('password') is-invalid @enderror email ele "
                       placeholder="youremail@email.com">
                @error('identify')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                <input type="password" name="password"
                       class="password ele @error('password') is-invalid @enderror"
                       placeholder="password">
                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                <button type="submit" class="clkbtn">Login</button>
            </div>

        </form>
    </div>
</div>
<script>
    // $('#admin').click(function (){
    //     $('#teacherLoginForm').hide();
    //     $('#adminLoginForm').show();
    // });
    //
    // $('#teacher').click(function (){
    //     $('#adminLoginForm').hide();
    //     $('#teacherLoginForm').show();
    // });
</script>
<script>

    let signup = document.querySelector(".teacher");
    let login = document.querySelector(".login");
    let slider = document.querySelector(".slider");
    let formSection = document.querySelector(".form-section");

    signup.addEventListener("click", () => {
        slider.classList.add("moveslider");
        formSection.classList.add("form-section-move");
    });

    login.addEventListener("click", () => {
        slider.classList.remove("moveslider");
        formSection.classList.remove("form-section-move");
    });
</script>
</body>
</html>
