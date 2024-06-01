
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    html, body {
        height: 100%;
    }
    body {
        font-family: 'Roboto', sans-serif;
        background-image: linear-gradient(to top, #7028e4 0%, #e5b2ca 100%);
    }
    .demo-container {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .btn-lg {
        padding: 12px 26px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    ::placeholder {
        font-size:14px;
        letter-spacing:0.5px;
    }
    .form-control-lg {
        font-size: 16px;
        padding: 25px 20px;
    }
    .font-500{
        font-weight:500;
    }
    .image-size-small{
        width:140px;
        margin:0 auto;
    }
    .image-size-small img{
        width:140px;
        margin-bottom:-70px;
    }
    .icon-camera{
        position: absolute;
        right: -1px;
        top: 21px;
        width: 30px;
        height: 30px;
        background-color: #FFF;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
<div class="demo-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mx-auto">
                <div class="text-center image-size-small position-relative">
                    <img src="https://annedece.sirv.com/Images/user-vector.jpg" class="rounded-circle p-2 bg-white">
                    <div class="icon-camera">
                        <a href="" class="text-primary"><i class="lni lni-camera"></i></a>
                    </div>
                </div>
                <div class="p-5 bg-white rounded shadow-lg">
                    <h3 class="mb-2 text-center pt-5">Sign In</h3>
                    <p class="text-center lead">Sign In to manage all your devices</p>
                    <form method="POST" action="{{ route('parents.login') }}">
                        @if(Session::get('fail'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="text-bg-danger">@error('email'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}" required autocomplete="current-password">
                            <span class="text-bg-danger">@error('password'){{$message}}@enderror</span>
                        </div>
                        <p class="m-0 py-4"><a href="" class="text-muted">Forget password?</a></p>
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-lg">SIGN IN</button>
                    </form>
                    <div class="text-center pt-4">
                        <p class="m-0">Do not have an account? <a href="{{route('parents.wizard')}}" class="text-dark font-weight-bold">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
