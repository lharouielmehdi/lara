<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color:#23242f ;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                 background-image: url('./img/trip.jpg');
                 background-repeat: no-repeat;
                 background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .left {
                position: absolute;
                left: 50px;
                top: 30px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 35px;
                text-align: center;
            }

            .links > a {
                color: #bac7ce;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .linkss > a {
                color: #bac7ce;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body style="background-image: url(./img/3.png)">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="col-md-7 mt-text animate-box fadeInUp animated-fast" data-animate-effect="fadeInUp" style="text-align: left " style="100px">
                <div class="title">
                    <div class="left">
                        <h1>Planing Trip To Anywhere in The contryyy?</h1>

                    </div>

                </div>
              </div>
            <div class="content"  >
                <div class="title m-b-md" style="color: bisque">
                    TRAVEL
                </div>

                <div class="linkss" >
                    <a>management</a>
                    <a >offers</a>
                    <a >requests</a>
                    <a >simple to use</a>
                    <a >Nova</a>
                    <a >Forge</a>
                    <a >GitHub</a>
                </div>
            </div>

        </div>
    </body>
</html>
