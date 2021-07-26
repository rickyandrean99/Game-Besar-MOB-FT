<!doctype html>
<html lang="en">
  <head>
    <title>Gambes - MOB FT 2021</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ url ('website/css/style.css')}}">
        <style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

            * {
                scroll-behavior: smooth;
            }

            body {
                /* background-color: #33334D; */
                /* background-image: url('./img/bg.png'); */
                /* background-position: center; */
                /* background-repeat: no-repeat; */
                /* background-size: cover; */
                font-family: 'Poppins', sans-serif;
                /* background-position-y: bottom ; */
                /* height: 1080px; */
            }

            /* Scrollbar Styling */
            ::-webkit-scrollbar {
                width: 10px;
                left: -100px;
            }

            ::-webkit-scrollbar-track {
                /* background-color: transparent; */

                background-color: rgba(0, 0, 0, 0.141);
                /* box-shadow: 0px 0px 20px #70e8c675; */
                backdrop-filter: blur(2px);
                -webkit-border-radius: 10px;
                border-radius: 10px;
                margin-left: 10px;
            }

            ::-webkit-scrollbar-thumb {
                -webkit-border-radius: 10px;
                border-radius: 10px;
                background: #c6f6e8;
            }
        </style>
    </head>

    <body class="img js-fullheight" style="background-image: url(img/bg3.png);">
        @yield('content')

        <script src="{{ url ('website/js/jquery.min.js')}}"></script>
        <script src="{{ url ('website/js/popper.js')}}"></script>
        <script src="{{ url ('website/js/bootstrap.min.js')}}"></script>
        <script src="{{ url ('website/js/main.js')}}"></script>

	</body>
</html>


