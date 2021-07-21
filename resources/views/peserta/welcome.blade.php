<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gambes - MOB FT 2021</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Tailwind -->
    <!-- <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/app.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            scroll-behavior: smooth;
        }

        body {
            /* background-color: #33334D; */
            background-image: url('./img/bg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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


        /* ::-webkit-scrollbar-button {
            display: none
        }

        ::-webkit-scrollbar-thumb {
            background-color: #babac0;
            border-radius: 16px;
            border: 5px solid #fff
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a0a0a5;
            border: 4px solid #f4f4f4
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-track:hover {
            background-color: #transparent
        } */


        .round-group {
            /* position: absolute; */
            width: 300px;
            height: 38px;
            /* left: 650px;
            top: 35px; */
            text-align: center;
            margin: 20px auto 0 auto;
            font-style: normal;
            font-weight: 500;
            font-size: 32px;
            line-height: 38px;

            /* identical to box height */

            color: #fff;
        }

        .container-profile {
            /* position: absolute; */
            width: 370px;
            height: 100px;
            /* left: 24px; */
            /* top: 20px; */
            background: transparent;
            border-radius: 10px;
            float: left;
        }

        .avatar {
            position: absolute;
            border-radius: 50%;
            /* width: 116px;
            height: 116px; */
            /* left: 38px;
            top: 30px; */

            /* margin: auto 0 auto 0; */


            background: transparent;

            width: 85px;
            height: 85px;
            top: 8px;
            left: 15px;
        }

        .right-menu {

            width: 400px;
            position: absolute;
            min-height: 100px;
            height: 300px;
            /* background-color: red; */
            text-align: right;
            right: 20px;

            /* left: 1175px; */
            top: 25px;
            color: white;
        }

        .log {
            background-color: transparent;

            text-align: justify;
            padding-RIGHT: 30PX;
            max-height: 350px;
            overflow: auto;
        }

        .darah-maharu {
            position: absolute;
            text-align: center;
            width: 220px;
            /* height: 38px;
            left: 184px;
            top: 30px; */
            /* background: #C4C4C4; */
            height: 20px;
            left: 125px;
            top: 15px;
        }

        .status {
            margin-top: 5px;
            position: absolute;
            width: 60%;
            height: 66px;
            top: 40px;
            left: 125px;
            display: grid;
            grid-template-columns: auto auto;
            color: #fff;
            font-size: 13px;
        }

        .status span {
            margin-bottom: 0;
        }


        .container-left {
            position: absolute;
            width: 370px;
            height: 105px;
            left: 24px;
            top: 20px;
            background: transparent;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, .15);
            box-shadow: 0px 0px 20px #70e8c675;
            backdrop-filter: blur(2px);
        }

        .item {
            width: 50px;
            height: 50px;
            /* background-color: red; */
            float: left;
            margin: 20px 20px 0 0;
            border-radius: 10px;
            box-shadow: 0px 0px 15px #70E8C6;
        }

        .item2 {
            border-radius: 10px;
            width: 50px;
            height: 50px;
        }

        .img-boss {
            /* position: absolute; */
            text-align: center;
            border-radius: 50%;
            width: 400px;
            height: 400px;
            margin: 0 auto;
            /* left: 610px;
            top: 120px; */
            background-color: rgba(255, 255, 255, .15);
            box-shadow: 0px 0px 20px #70e8c675;
            backdrop-filter: blur(2px);
            /* box-shadow: 0 0 8px #ea4c89, inset 0 0 8px #ea4c89; */
            -webkit-animation: pulse 2s linear 1s infinite;
        }

        .container-boss {
            /* margin: 75px auto 0 auto; */
            margin: 15vh auto 0 auto;
            width: 500px;
            /* background-color: rgba(255, 255, 255, .15);
            box-shadow: 0px 0px 20px #70e8c675;
            backdrop-filter: blur(2px); */

        }

        .darah-boss {
            /* position: absolute; */
            /* width: 329px; */
            margin-top: 20px;
            /* left: 500px;
            top: 500px; */
        }

        .progress-boss {
            /* position: absolute; */
            /* width: 329px; */
            margin-top: 15px;
            /* left: 500px;
            top: 540px; */
        }

        .btn-craft {
            position: fixed;
            text-align: center;
            border-radius: 50%;
            height: 75px;
            width: 75px;
            left: 24px;
            bottom: 115px;
        }

        .btn-inventory {
            position: fixed;
            text-align: center;
            border-radius: 50%;
            height: 75px;
            width: 75px;
            left: 24px;
            bottom: 20px;
        }

        .btn-gift {
            position: fixed;
            text-align: center;
            border-radius: 50%;
            height: 75px;
            width: 75px;
            bottom: 20px;
            left: 120px;
        }

        .userActions {
            position: fixed;
            bottom: 20px;
            right: 24px;
        }

        .userButton {
            height: 75px;
            width: 75px;
            background-color: rgba(67, 83, 143, .8);
            border-radius: 50%;
            display: block;
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .userButton i {
            font-size: 22px;
        }

        .userButtons {
            position: absolute;
            width: 100%;
            bottom: 120%;
            text-align: center;
        }

        .userButtons a {
            display: block;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            text-decoration: none;
            margin: 10px auto 0;
            line-height: 1.15;
            color: #fff;
            opacity: 0;
            visibility: hidden;
            position: relative;
            box-shadow: 0 0 5px 1px rgba(51, 51, 51, .3);
        }

        .userButtons a:hover {
            transform: scale(1.05);
        }

        .userButtons a:nth-child(1) {
            background-color: #ff5722;
            transition: opacity .2s ease-in-out .3s, transform .15s ease-in-out;
        }

        .userButtons a:nth-child(2) {
            background-color: #03a9f4;
            transition: opacity .2s ease-in-out .25s, transform .15s ease-in-out;
        }

        /* .userButtons a:nth-child(3) {
            background-color: #f44336;
            transition: opacity .2s ease-in-out .2s, transform .15s ease-in-out;
        }

        .userButtons a:nth-child(4) {
            background-color: #4CAF50;
            transition: opacity .2s ease-in-out .15s, transform .15s ease-in-out;
        } */

        .userActions a i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .text-glow2 {
            color: #ffffff;
            text-shadow: 1px 0px 7px #70E8C6;
        }

        .text-glow3 {
            color: #33334D;
            text-shadow: 1px 0px 7px #70E8C6;
        }

        .userToggle {
            -webkit-appearance: none;
            position: absolute;
            border-radius: 50%;
            top: 0;
            left: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            background-color: transparent;
            border: none;
            outline: none;
            z-index: 2;
            transition: box-shadow .2s ease-in-out;
            box-shadow: 0 3px 5px 1px rgba(51, 51, 51, .3);
        }

        .userToggle:hover {
            box-shadow: 0 3px 6px 2px rgba(51, 51, 51, .3);
        }

        .userToggle:checked~.userButtons a {
            opacity: 1;
            visibility: visible;
        }

        .jumlahItem {
            margin-top: 6rem;
        }

        .modal-body::-webkit-scrollbar {
            display: none;
        }

        .left-menu a:hover {
            transform: scale(1.05);
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }

        .text-glow {
            /* color: #4fda91;  */
            color: #7df5d0;
            text-shadow: 2px 0px 20px #70E8C6;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            /* background-color: #33334d; */
            background-image: linear-gradient(to right, #1F9C8C, #70E8C6);
            border-radius: 1.5rem;
        }

        .nav-pills .nav-link {
            background-color: #fff;
            border-radius: 1.5rem;
            color: #303030;
        }

        .nav-link:hover {
            color: #7c7c7c;
        }

        .border-gradient {
            border: double 10px transparent;
            border-radius: 30px;
            background-image: linear-gradient(#ADE9DB, #ADE9DB), radial-gradient(circle at top left, #1F9C8C, #70E8C6);
            background-origin: border-box;
            background-clip: content-box, border-box;
        }


        .border-gradient2 {
            border: 0;
            border-radius: 20px;
            background-image: radial-gradient(circle at top left, #1F9C8C, #70E8C6);
        }

        .color-1 {
            background-image: linear-gradient(#1F9C8C, #1F9C8C);
            border: 0px;
        }

        @-webkit-keyframes pulse {
            0% {
                box-shadow: 0 0 8px #70E8C6, inset 0 0 8px #70E8C6;
            }

            50% {
                box-shadow: 0 0 16px #70E8C6, inset 0 0 14px #70E8C6;
            }

            100% {
                box-shadow: 0 0 8px #70E8C6, inset 0 0 8px #70E8C6;
            }
        }

        .terbang {
            margin-top: -50px;
            margin-left: 0px;
            animation-name: floating;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }

        @keyframes floating {
            0% {
                transform: translate(0, 0px);
            }

            50% {
                transform: translate(0, 30px);
            }

            100% {
                transform: translate(0, -0px);
            }
        }

        :focus {
            outline: 0 !important;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0) !important;
        }

    </style>
</head>

<body>
    <div class="content">

        <div class="container-left">
            <div class="container-profile">
                <div class="avatar">
                    <!-- masukin nomor kelompok disini -->
                    <p style="text-align: center; margin-top:17px; font-weight:bold; font-size:35px;" class="text-glow">{{ Auth::user()->name }}</p>
                </div>
                <div class="darah-maharu">
                    @php $hp_amount = $team->hp_amount * 100 / 1000; @endphp
                    <div class="progress" style="height: 1.5rem; border-radius: 25px; background: rgba(255,255,255,0.4);">
                        <div class="text-white fw-bold" style="position: absolute; text-align: center; width: 100%; padding-top: 3px" id="hp-team">{{ $team->hp_amount }}/1000</div>
                        <div class="progress-bar bg-danger" id="team-hp-bar" role="progressbar" style="width: {{ $hp_amount }}%;background-image: linear-gradient(to right, #b80f0a, #dc1c13)" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
                <div class="status">
                    <div class="label">
                        <span class="text-glow2" style="font-size: larger;">Coin</span><br>
                        <span class="text-glow2" style="font-size: larger;">Weapon</span>
                    </div>
                    <div class="label-content">
                        <span class="text-glow2" style="font-size: larger;"> : {{ $team->coin }}</span><br>
                        <span class="text-glow2" id="weapon-name" style="font-size: larger;"> : 
                            @if ($team->weapon_level == 0)
                                -
                            @elseif($team->weapon_level == 1)
                                Loops Hammer
                            @elseif($team->weapon_level == 2)
                                Master Sword
                            @elseif($team->weapon_level == 3)
                                Quantum Gun
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div style="margin-top: 120px; font-size:14px;" class="text-glow2">Item yang sedang dipakai </div>
            <div class="container-item">
                <!-- foreach item yang dipake -->
                <div class="item">
                    <img class="item2" src="./img/item/Alabaster.jpg">
                </div>

            </div>

        </div>


        <div class="round-group">
            <div>
                <span class="round"></span>
                <span class="round-session"></span>
            </div>
            <div>
                <span class="timer" style="text-shadow: 0px 0px 20px #70E8C6;"></span>
            </div>
        </div>

        <div class="container-boss">
            <div class="img-boss">
                <img src="{{ asset('img/KOCHENK.png')}}" class="terbang" alt="Boss" style="width: 400px;">
            </div>
            <!--darah bos  -->
            <div class="darah-boss">
                <div class="progress" style="height: 1.7rem; border-radius: 25px; width:500px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%;  background-image: linear-gradient(to right, #b80f0a, #dc1c13);" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        100/100
                    </div>
                </div>
            </div>
            <!--weapon  -->
            <div class="progress-boss">
                <div class="progress" style="height: 1.7rem; border-radius: 25px; width:500px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(to right, #5ec3ee , #70E8C6);color:#44443d;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Secret Weapon</div>

                </div>
            </div>
            <!-- quest -->
            <div class="progress-boss">
                <div class="progress" style="height: 1.7rem; border-radius: 25px; width:500px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(to right, #5ec3ee , #70E8C6);color:#44443d;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">7/10 Quest</div>

                </div>
            </div>
        </div>

        <div class="left-menu">
            <a class="btn btn-craft text-center" href="#!" role="button" data-bs-toggle="modal" data-bs-target="#modalCraft" style="background-color:#48e2b6;box-shadow: 0px 0px 15px #48e2b6;border:0px;">
                <img style="margin-top:5px;" src="https://img.icons8.com/ios/50/000000/hammer.png" data-bs-toggle="tooltip" data-bs-placement="right" title="Craft" />
            </a>
            <a class="btn btn-inventory" href="#!" role="button" data-bs-toggle="modal" data-bs-target="#modalInventory" style="background-color:#48e2b6;box-shadow: 0px 0px 15px #48e2b6;border:0px;">
                <img style="margin-top:5px;" src="https://img.icons8.com/ios/50/000000/backpack.png" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventory" />
            </a>
            <a class="btn btn-gift" href="#!" role="button" data-bs-toggle="modal" data-bs-target="#modalGift" style="background-color:#48e2b6;box-shadow: 0px 0px 15px #48e2b6;border:0px;">
                <img style="width:42px; height:42px; margin-top:10px;" src="https://img.icons8.com/ios/50/000000/gift--v1.png" data-bs-toggle="tooltip" data-bs-placement="right" title="Gift" />
            </a>
        </div>

        <div class="right-menu">
            <!-- Tempat logout -->
            <div class="logout">
                <button type="button" class="btn btn-danger" style="border-radius:20px;width:100px;background-color:#dc1c13">Logout</button>
            </div>
            <br>
            <!-- Tempat log history -->
            <div class="log" id="logHistory">
                <table id="logTable">
                    @foreach ($histories as $history)
                        <tr>
                            <td>
                                <p>
                                    <b>[{{ $history->type }}]</b>
                                    <small>{{ $history->time }}</small>
                                    <br>
                                    <span>{{ $history->name }}</span>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tr>
            </div>
        </div>

        <div class="userActions">
            <input type="checkbox" name="userToggle" class="userToggle" />
            <a class="userButton" href="#!" style="background-color:#48e2b6;box-shadow: 0px 0px 15px #48e2b6;font-size:30px;"><img style="transform: rotate(315deg); height:40px;width:40px; margin-top:17px;" src="https://img.icons8.com/ios/50/000000/sword.png" /></a>
            <div class="userButtons">
                @if ($team->weapon_level == 0)
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Attack" id="btn-weapon-attack" class="text-center" style="background-color:#808080;box-shadow: 0px 0px 15px #808080;font-size:30px;" disabled="disabled">
                        <!-- <img src="{{ asset('img/attack.png')}}" style="height:50px;width:50px;" alt="attack"> -->
                        <img style="margin-top:10px; height:40px;width:40px;" src="https://img.icons8.com/ios/50/000000/battle.png" />
                    </a>           
                @else
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Attack" id="btn-weapon-attack" class="text-center" style="background-color:#dc1c13;box-shadow: 0px 0px 15px #dc1c13;font-size:30px;">
                        <!-- <img src="{{ asset('img/attack.png')}}" style="height:50px;width:50px;" alt="attack"> -->
                        <img style="margin-top:10px; height:40px;width:40px;" src="https://img.icons8.com/ios/50/000000/battle.png" />
                    </a>    
                @endif
                
                @if ($team->weapon_level == 3)
                    <a data-bs-toggle="tooltip" data-bs-placement="left" title="Upgrade Weapon" id="btn-upgrade" style="background-color:#808080;box-shadow: 0px 0px 15px #808080;font-size:30px;" disabled="disabled">
                        <!-- <img src="{{ asset('img/upgrade.png')}}" style="height:50px;width:50px;" alt="upgrade"> -->
                        <img style="height:35px;width:35px; margin-top:13px; margin-left:1px" src="https://img.icons8.com/ios/50/000000/sword.png" />
                        <p style="font-size:20px; margin-top:-20px; margin-left:20px; font-weight:bold; color:#000">↑</p>
                    </a>
                @else
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Upgrade Weapon" id="btn-upgrade" style="background-color:#5ec3ee;box-shadow: 0px 0px 15px #5ec3ee;font-size:30px;">
                        <!-- <img src="{{ asset('img/upgrade.png')}}" style="height:50px;width:50px;" alt="upgrade"> -->
                        <img style="height:35px;width:35px; margin-top:13px; margin-left:1px" src="https://img.icons8.com/ios/50/000000/sword.png" />
                        <p style="font-size:20px; margin-top:-20px; margin-left:20px; font-weight:bold; color:#000">↑</p>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal Craft -->
    <div class="modal fade" id="modalCraft" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content  border-gradient " style="background-color:#ADE9DB;  box-shadow:1px 0px 40px #70E8C6;">
                <div class="modal-header" style="border-bottom: none;">
                    <img style="margin-left:105px; width:30%;" src="./img/kiri.svg">
                    <h5 class="modal-title text-center ms-3 fw-bold" style="color:#33334D ;">CRAFT</h5>
                    <img style="margin-left:16px; margin-right:20px; width:30%;" src="./img/kanan.svg">
                    <button style="margin-right:3px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <br>
                <div class="modal-body" style="margin-left:10px; margin-right:10px;">
                    <div>
                        <!-- Foreach Crafting di sini -->
                        @foreach($equipments as $e)
                        <div style="margin-bottom: 20px;">
                            <div class="card h-100 border-gradient2">
                                <div class="row g-0">
                                    <div class="col-md-3 position-relative">
                                        <img style="margin-left:30px; border-radius:10px; border:0px;width:130px;" src="./img/item/{{ $e->nama_equipment }}.jpg" class="img-fluid m-4" alt="...">
                                    </div>
                                    <div class="col-md-8 mr-10" style="margin-right:-20px;margin-top:10px;">
                                        <div class="card-body">
                                            <h5 class="card-title text-glow2" style="font-weight: bold; font-size:large;">{{ $e->nama_equipment }}</h5>
                                            <p style="font-weight: bold; font-size:14px; text-align:justify; text-justify: inter-word;" class="text-glow3 card-text">
                                                {{ $e->deskripsi_equipment }}
                                            </p>
                                            <div class="d-grid gap-1 d-md-flex justify-content-md-start mb-2">
                                                <input style="background-color:transparent; border:0px;border-bottom: 3px solid #1F9C8C; border-radius:0px; text-align:center; 
                                                font-size:20px; font-weight:bold" type="number" class="form-control form-control-sm w-25 craft-amount" id="exampleCheck1" value="1">
                                                <button class="btn btn-primary me-2 btn-sm color-1 btn-crafting-equipment" style="border-radius:25px;width:90px;" type="button" value="{{ $e->id_equipment }}">Craft</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item" style="background-color:transparent; border:0px;">
                                        <!-- jangan lupa id diganti -->
                                            <h2 style="margin-left:10px;margin-right:10px;" class="accordion-header" id="flush-heading-{{ $e->id_equipment }}">
                                                <button style="color:#33334D;background-color:transparent; font-weight: bold; " class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $e->id_equipment }}" aria-expanded="false" aria-controls="flush-collapse-{{ $e->id_equipment }}">
                                                    Requirement
                                                </button>
                                            </h2>
                                            <!-- jangan lupa id sama aria-labelledby juga diganti -->
                                            <div id="flush-collapse-{{ $e->id_equipment }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $e->id_equipment }}" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="mb-3 col-md-12">
                                                        <div class="row g-0">
                                                            <!-- Foreach requirement di sini -->
                                                            @foreach ($e->requirement as $er)
                                                            <div class="col-md-2 mx-auto">
                                                                <div class="position-relative">
                                                                    <img style="margin-left:30px; border-radius:10px; border:0px; width:80px;" src="./img/item/{{ $er->nama_material }}.jpg" class="img-fluid m-3" alt="...">
                                                                    <h4 class="position-absolute top-0 text-white" style="margin-top:4.2rem; margin-left:5rem;">{{ $er->jumlah_material }}</h4>
                                                                </div>
                                                                <p style="color:#fff;text-align:center; font-size:14px">{{ $er->nama_material }}</p>
                                                            </div>
                                                            @endforeach
                                                            <!-- End Foreach Requirement di sini -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- End Foreach Di Sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Craft -->

    <!-- Modal Inventory -->
    <div class="modal fade" id="modalInventory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content  border-gradient " style="background-color:#ADE9DB;  box-shadow:1px 0px 40px #70E8C6;">
                <div class="modal-header" style="border-bottom: none;">
                    <img style="margin-left:80px; width:30%;" src="./img/kiri.svg">
                    <h5 class="modal-title text-center ms-3 fw-bold" style="color:#33334D ;">INVENTORY</h5>
                    <img style="margin-left:16px; margin-right:20px; width:30%;" src="./img/kanan.svg">
                    <button style="margin-right:3px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <br>
                <ul class="nav nav-pills nav-justified mx-3 mb-3 " id="pills-tab" role="tablist">
                    <li style="margin-left:10px; margin-right:10px;" class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="pills-resource-tab" data-bs-toggle="pill" data-bs-target="#pills-resource" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Resource</button>
                    </li>
                    <li style="margin-left:10px; margin-right:10px;" class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="pills-equipment-tab" data-bs-toggle="pill" data-bs-target="#pills-equipment" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Equipment</button>
                    </li>
                </ul>
                <div class="modal-body" style="margin-left:10px; margin-right:10px;">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-resource" role="tabpanel" aria-labelledby="pills-resource-tab">
                            <div class="row">
                                <!-- Foreach Resource di sini -->
                                @foreach ($material as $m)
                                <div class="col-md-6 mt-2" style="margin-bottom: 10px;">
                                    <div class="card h-100 border-gradient2">
                                        <div class="row g-0">
                                            <div class="col-md-4 position-relative">
                                                <img style="margin-left:30px; border-radius:10px; border:0px;" src="./img/item/{{ $m->nama_material }}.jpg" class="img-fluid m-2" alt="...">
                                                <h4 class="position-absolute top-0 end-0 text-white text-glow2 jumlahItem jumlah-material-{{ $m->materials_id }}">{{ $m->jumlah }}</h4>
                                            </div>
                                            <div class="col-md-8 mr-10">
                                                <div class="card-body">
                                                    <h5 class="card-title text-glow2" style="font-weight: bold; font-size:large;">{{ $m->nama_material }}</h5>
                                                    <p style="font-weight: bold; font-size:12px; text-align:justify; text-justify: inter-word;" class="text-glow3 card-text">
                                                        
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- End Foreach -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-equipment" role="tabpanel" aria-labelledby="pills-equipment-tab">
                            <div class="row">
                                @foreach ($equipments as $e)
                                <!-- Foreach equipment di sini -->
                                <div class="col-md-6 mt-2" style="margin-bottom: 10px;">
                                    <div class="card h-100 border-gradient2">
                                        <div class="row g-0">
                                            <div class="col-md-4 position-relative">
                                                <img style="margin-left:30px; border-radius:10px; border:0px; " src="./img/item/{{ $e->nama_equipment }}.jpg" class="img-fluid m-2" alt="...">
                                                <h4 class="position-absolute top-0 end-0 text-white text-glow2 jumlahItem" id="jumlah-equipment-{{ $e->id_equipment }}">{{ $e->jumlah_equipment }}</h4>
                                            </div>
                                            <div class="col-md-8 mr-10">
                                                <div class="card-body">
                                                    <h5 class="card-title text-glow2" style="font-weight: bold; font-size:large;">{{ $e->nama_equipment }}</h5>
                                                    <p style="font-weight: bold; font-size:12px; text-align:justify; text-justify: inter-word;" class="text-glow3 card-text">
                                                        {{ $e->deskripsi_equipment }}
                                                    </p>
                                                </div>
                                                <div class="position-absolute bottom-0 end-0 me-2 mb-2">
                                                    <button type="button" class="btn btn-primary btn-sm color-1 btn-using-equipment" style="border-radius:15px;width:90px;" value="{{ $e->id_equipment }}">Use</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- End Foreach -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Inventory -->

    <!-- Modal Gift -->
    <div class="modal fade" id="modalGift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content  border-gradient " style="background-color:#ADE9DB;  box-shadow:1px 0px 40px #70E8C6;">
                <div class="modal-header" style="border-bottom: none;">
                    <img style="margin-left:120px; width:30%;" src="./img/kiri.svg">
                    <h5 class="modal-title text-center ms-3 fw-bold" style="color:#33334D ;">GIFT</h5>
                    <img style="margin-left:16px; margin-right:20px; width:30%;" src="./img/kanan.svg">
                    <button style="margin-right:3px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-left:10px; margin-right:10px;">
                    <div class="row mt-2">
                        <!-- Mulai foreach Gift di sini -->
                       @foreach($material as $m)
                        <div class="col-md-6 mt-2" style="margin-bottom: 10px;">
                            <div class="card h-100 border-gradient2">
                                <div class="row g-0">
                                    <div class="col-md-4 position-relative">
                                        <img style="margin-left:30px; border-radius:10px; border:0px;" src="./img/item/{{$m->nama_material}}.jpg" class="img-fluid m-2" alt="...">
                                        <h4 class="position-absolute top-0 end-0 text-white text-glow2 jumlahItem jumlah-material-{{ $m->materials_id }}">{{$m->jumlah    }}</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-glow2" style="font-weight: bold; font-size:large;">{{$m->nama_material}}</h5>
                                            <div>
                                                <select style="font-weight:bold; background:transparent; border-radius:0px; border:0px; border-bottom: 3px solid #1F9C8C;" id="select-{{$m->materials_id}}" class="form-select form-select-sm w-100" aria-label=".form-select-sm example">
                                                    <option selected >--Pilih Kelompok--</option>
                                                    @foreach ($friend as $f)
                                                        <option value="{{ $f->id }}">{{ $f->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 me-2 mb-2">
                                            <button type="button" class="btn btn-primary btn-sm color-1 btn-gift-Kirim" material="{{$m->materials_id}}" style="border-radius:15px;width:70px;" >Gift</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- End Foreach di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Gift -->

    <!-- Modal hasil (berhasil/gagal) -->
    <div class="modal fade" id="result-modal" tabindex="-1" role="dialog" aria-labelledby="resultModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <span id="modal-result-message" class="text-dark" style="display:inline-block; width: 90%"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Alpine.js -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        var ronde = parseInt("{{ $round->round }}");
        var aksi = {{ $round->action }};
        var time = {{ $times }};
        var teamStatus = ({{ $team->hp_amount }} > 0) ? true : false;
        var weaponLevel = {{ $team->weapon_level }};
        var partStatus = {{ $round->reminder }};
        var questAmount = ({{ $team->quest_amount }} >= 10) ? 10 : {{ $team->quest_amount }};
        var shopping = ({{ $team->material_shopping }} == 0) ? true : false;

        // EQUIPMENT STATUS CHECK
        if (!{{ $team->debuff_disable }}) { $('#wt').hide(); }
        if ({{ $team->debuff_decreased }} <= 0) { $('#ac').hide(); }
        if (!{{ $team->debuff_overtime }}) { $('#ps').hide(); }
        if ({{ $team->buff_increased }} <= 0) { $('#sp').hide(); }
        if (!{{ $team->buff_immortal }}) { $('#ia').hide(); }
        if ({{ $team->buff_regeneration }} <= 0) { $('#r').hide(); }
        if (!{{ $team->shield }}) { $('#ms').hide(); }
        if (!{{ $team->attack_status }}) { $('#atk').hide(); }
        if (!partStatus) {
            $('#secret-weapon-progress-bar').hide();
            $('#quest-team-progress-bar').hide();
        }

        // DISABLE BUTTON UPGRADE
        function disableUpgrade() {
            $('#btn-upgrade').attr('disabled', 'disabled');
            $('#btn-upgrade').removeAttr('href');
            $('#btn-upgrade').css('background', '#808080');
            $('#btn-upgrade').css('box-shadow', '0px 0px 15px #808080');
        }

        // ENABLE BUTTON UPGRADE
        function enableUpgrade() {
            $('#btn-upgrade').removeAttr('disabled');
            $('#btn-upgrade').attr('href', '#');
            $('#btn-upgrade').css('background', '#5ec3ee');
            $('#btn-upgrade').css('box-shadow', '0px 0px 15px #5ec3ee');
        }

        // DISABLE BUTTON ATTACK
        function disableAttack() {
            $('#btn-weapon-attack').attr('disabled', 'disabled');
            $('#btn-weapon-attack').removeAttr('href', '#');
            $('#btn-weapon-attack').css('background', '#808080');
            $('#btn-weapon-attack').css('box-shadow', '0px 0px 15px #808080');
        }

        // ENABLE BUTTON ATTACK
        function enableAttack() {
            $('#btn-weapon-attack').removeAttr('disabled');
            $('#btn-weapon-attack').attr('href', '#');
            $('#btn-weapon-attack').css('background', '#dc1c13');
            $('#btn-weapon-attack').css('box-shadow', '0px 0px 15px #dc1c13');
        }

        // Disable semua control
        function disableAllControl() {
            $('.btn-gift').attr('disabled', 'disabled');
            $('.btn-craft').attr('disabled', 'disabled');
            disableAttack();
            disableUpgrade();
            
            // $('#btn-buy-material').attr('disabled', 'disabled');

            //[KENNETH] Disable button Buy Material
            if (!shopping && questAmount < 10) {
                $('#btn-buy-material').attr('disabled', 'disabled');
            } else {
                if (!aksi) {
                    $('#btn-buy-material').removeAttr('disabled');
                }
            }
        }

        // Update quest progress
        function updateQuestProgressBar() {
            $('#quest-amount-text').text(questAmount + "/10");
            var questProgress = (parseInt(questAmount) * 100 / 10) + "%";
            $('#quest-amount-progress').css('width', questProgress);
        }

        // PREVENT CERTAIN CHARACTER
        $(document).on("keydown", ".craft-amount", function(e) {
            if(e.keyCode == 188) { return false; }
            if(e.keyCode == 190) { return false; }
            if(e.keyCode == 69) { return false; }
            if(e.keyCode == 187) { return false; }
            if(e.keyCode == 107) { return false; }
            if(e.keyCode == 109) { return false; }
            if(e.keyCode == 189) { return false; }
        });
        
        // HISTORY AUTO SCROLL
        function bringToBottom() {
            $("#logHistory").scrollTop($("#logHistory")[0].scrollHeight);
        }

        // CHECK DO AND DONT
        function checkWeaponAction() {
            if (teamStatus) {
                if (aksi) {
                    $('.btn-gift').attr('disabled', 'disabled');
                    $('.btn-craft').attr('disabled', 'disabled');
                    $('#btn-buy-material').attr('disabled', 'disabled');

                    disableUpgrade();
                    (weaponLevel > 0) ? enableAttack() : disableAttack();
                } else {
                    $('.btn-gift').removeAttr('disabled');
                    $('.btn-craft').removeAttr('disabled');

                    if (!shopping && questAmount < 10) {
                        $('#btn-buy-material').attr('disabled', 'disabled');
                    } else {
                        $('#btn-buy-material').removeAttr('disabled');
                    }

                    disableAttack();
                    (weaponLevel >= 3) ? disableUpgrade() : enableUpgrade();
                }
            } else {
                disableAllControl();
            }
        }

        // [RICKY] Tampilan halaman saat reload
        $(document).ready(function() {
            if (teamStatus && ronde > 0 && ronde <= 13) {
                checkWeaponAction();
            } else {
                disableAllControl();
            }

            roundSessionTimer();
            bringToBottom();
        });

        // REALTIME ROUND, ACTION AND TIMER
        var runTimer = setInterval(function() { roundSessionTimer(); }, 1000);
        function roundSessionTimer() {
            if (ronde < 1) {
                disableAllControl();
                $('.round').html("Game Besar Belum Dimulai");
            } else if (ronde > 13) {
                disableAllControl();
                $('.round').html("Game Besar Sudah Selesai");
                $('.round-session').text("");
                $('.timer').text("");
            } else {
                $('.round').html("Round " + ronde);
                var sesi = (aksi) ? "Action" : "Preparation";
                $('.round-session').text(sesi);

                if (time > 0) {
                    minutes = (Math.floor(time / 60)).toString().padStart(2, '0');
                    seconds = (time % 60).toString().padStart(2, '0');
                    $('.timer').html(minutes + ":" + seconds);
                    time--;
                } else {
                    $('.timer').html("00:00");
                }
            }
        }

        // CRAFTING EQUIPMENT
        $(document).on("click", ".btn-crafting-equipment", function() {
            var id_equipment = $(this).val();
            var amount = $(this).parent().children('.craft-amount').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('crafting-equipment') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id_equipment': id_equipment,
                    'amount': amount
                },
                success: function(data) {
                    $(this).parent().children('.craft-amount').val(1);

                    if (data.crafting_result) {
                        var amount_now = parseInt($("#jumlah-equipment-" + id_equipment).text()) + parseInt(amount);
                        $("#jumlah-equipment-" + id_equipment).text(amount_now);

                        $.each(data.material_update, function(index, value) {
                            $(".jumlah-material-" + value.materials_id).text(value.amount);
                        });

                        $('#logTable').append(data.message);
                        bringToBottom();
                    } else {
                        $('#result-modal').modal('show');
                        $('#modal-result-message').text(data.message);
                    }
                }
            });
        });

        // USE EQUIPMENT
        $(document).on("click", ".btn-using-equipment", function() {
            var id_equipment = $(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ route('use-equipment') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id_equipment': id_equipment
                },
                success: function(data) {
                    if (data.use_result) {
                        $("#jumlah-equipment-" + id_equipment).text(data.amount_now);
                        $('#logTable').append(data.message);
                        bringToBottom();

                        if (id_equipment == 4) {
                            $('#wt').show();
                        } else if (id_equipment == 5) {
                            $('#ac').show();
                        } else if (id_equipment == 6) {
                            $('#ps').show();
                        } else if (id_equipment == 7) {
                            $('#sp').show();
                        } else if (id_equipment == 8) {
                            $('#ia').show();
                        } else if (id_equipment == 9) {
                            $('#r').show();
                        } else if (id_equipment == 10) {
                            $('#ms').show();
                        }
                    } else {
                        $('#result-modal').modal('show');
                        $('#modal-result-message').text(data.message);
                    }

                    // Jika menggunakan item healing
                    if (data.update_hp != 0) {
                        $('#hp-team').text(data.update_hp + "/1000");
                        var hpBar = (parseInt(data.update_hp) * 100 / 1000) + "%";
                        $('#team-hp-bar').css('width', hpBar);
                    }
                }
            });
        });

        // UPGRADE WEAPON
        $(document).on("click", "#btn-upgrade", function() {
            if (ronde > 0 && ronde < 14 && !aksi && weaponLevel < 3 && teamStatus) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('upgrade-weapon') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>'
                    },
                    success: function(data) {
                        if (data.status) {
                            weaponLevel = data.level_weapon;
                            checkWeaponAction();

                            if (weaponLevel == 1) {
                                $('#weapon-name').text("Loops Hammer");
                            } else if (weaponLevel == 2) {
                                $('#weapon-name').text("Master Sword");
                            } else if (weaponLevel == 3) {
                                $('#weapon-name').text("Quantum Gun");
                            }

                            $.each(data.material_update, function(index, value) {
                                $(".jumlah-material-" + value.materials_id).text(value.amount);
                            });

                            $('#logTable').append(data.message);
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }
                    }
                });
            }
        });

        // ATTACK WEAPON
        $(document).on("click", "#btn-weapon-attack", function() {
            if (ronde > 0 && ronde < 14 && aksi && weaponLevel > 0 && teamStatus) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('attack-weapon') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>'
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#logTable').append(data.message);
                            bringToBottom();
                            $('#atk').show();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }
                    }
                });
            }
            
        });

        // [RICKY] Berhentiin video youtube ketika modal close
        $(document).on("click", ".stop-video", function() {
            $('#video-winner').attr('src', 'https://www.youtube.com/embed/ROk9qsYjwY0?start=171&autoplay=1&mute=1');
            $('#video-reminder').attr('src', 'https://www.youtube.com/embed/Ngq0omaP8Xg?start=28&autoplay=1&mute=1');
        });

        // [Yobong] kirim gift
        $(document).on('click', '.btn-gift-Kirim', function(){
            var material = $(this).attr("material");
            var tujuan = $('#select-' + material).val();
            alert(material);
            alert(tujuan);
        });

        function gift(material) {
            var material = $(this).attr()
            var tujuan = $('#select-'+material).val();
            alert(material);
            alert(tujuan);
            // var jumlah = $('#gift_jumlah').val();

            // $.ajax({
            //     type: 'POST',
            //     url: '{{ route('gift') }}',
            //     data: {
            //         '_token': '<?php echo csrf_token(); ?>',
            //         'tujuan': tujuan,
            //         'material': material,
            //         'jumlah': jumlah
            //     },
            //     success: function(data) {
            //         $('#gift_jumlah').val('1');

            //         if (data.status) {
            //             $('#histories-list').append("<tr><td><div class='history-detail'><b>[GIFT]</b> " + data
            //                 .msg + "</div></td></tr>");
            //             $(".jumlah-material-" + material).text(data.jumlah_sekarang);
            //             bringToBottom();
            //         } else {
            //             $('#result-modal').modal('show');
            //             $('#modal-result-message').text(data.msg);
            //         }
            //     }
            // });
        }

        // [RICKY] Mendapatkan info round, sesi dan waktu saat ronde/sesi di update (PUBLIC-CHANNEL)
        window.Echo.channel('roundChannel').listen('.update', (e) => {
            ronde = e.round;
            aksi = e.action;
            time = e.minutes * 60;

            // disable buy material
            shopping = false;

            checkWeaponAction();
            $('#equipment-crafting').modal('hide');
            $('#equipment-use').modal('hide');
            $('#weapon-upgrade').modal('hide');
            $('#konfirmasi-gift').modal('hide');

            if (!aksi) {
                var boss_hp = 100 * e.boss_hp / 100000;
                $('#hp-boss').text(e.boss_hp + "/100000");
                $('#boss-hp-amount').css('width', boss_hp + "%");
                $('#result-modal').modal('show');
                $('#modal-result-message').text("Round telah berganti");

                // Update Status
                $('#atk').hide();
                $('#ms').hide();
                $('#wt').hide();
                $('#ps').hide();
                $('#r').hide();
                $('#ia').hide();
            } else {
                $('#result-modal').modal('show');
                $('#modal-result-message').text("Sesi Action Dimulai");
            }
        });

        // [RICKY] Mendapatkan instruksi saat video di broadcast (PUBLIC-CHANNEL)
        window.Echo.channel('videoChannel').listen('.broadcast', (e) => {
            if (e.broadcast_winner) {
                $('#winner-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#winner-modal').modal('show');
                $('#video-winner').attr('src',
                    'https://www.youtube.com/embed/ROk9qsYjwY0?start=171&autoplay=1&mute=0');
            } else {
                $('#reminder-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#reminder-modal').modal('show');
                $('#video-reminder').attr('src',
                    'https://www.youtube.com/embed/Ngq0omaP8Xg?start=28&autoplay=1&mute=0');
                $('#secret-weapon-progress-bar').show();
                $('#quest-team-progress-bar').show();
            }
        });

        // [RICKY] Mendapatkan jumlah part terbaru (PUBLIC-CHANNEL)
        window.Echo.channel('partChannel').listen('.progress', (e) => {
            var progress = 100 * e.collected / e.target;
            $('#progress-part').text(e.collected + "/" + e.target);
            $('#part-progress').css('width', progress + "%");
        });

        // [RICKY] Mendapatkan quest result yang dijalanakan (PRIVATE-CHANNEL)
        window.Echo.private('privatequest.' + {{ Auth::user()->team }}).listen('PrivateQuestResult', (e) => {
            $('#histories-list').append("<tr><td><div class='history-detail'><b>[QUEST]</b> " + e.message +
                "</div></td></tr>");
            
            bringToBottom();

            // enable button buy
            shopping = true;
            if (!aksi) {
                $('#btn-buy-material').removeAttr('disabled');
            }

            if (questAmount < 10) {
                questAmount += 1;
            }
            
            updateQuestProgressBar();
        });

        // [RICKY] Mendapatkan hp team terbaru saat round berganti (PRIVATE-CHANNEL)
        window.Echo.private('update-hitpoint.' + {{ Auth::user()->team }}).listen('UpdateHitpoint', (e) => {
            var hpAmount = (parseInt(e.health) * 100 / 1000) + "%";
            $('#team-hp-bar').css('width', hpAmount);
            $('#hp-team').text(e.health + "/1000");

            teamStatus = (e.health > 0) ? true : false;
            checkWeaponAction();

            if (e.message != null) {
                $('#histories-list').append("<tr><td><div class='history-detail'><b>[ATTACKED]</b> " + e.message +
                    "</div></td></tr>");
            }

            if (e.health <= 0) {
                $('#histories-list').append(
                    "<tr><td><div class='history-detail'><b>[STATUS]</b> Tidak dapat bermain lagi</div></td></tr>"
                );
            }

            bringToBottom();
        });

        // [RICKY] Mendapatkan gift yang dikirimkan kelompok lain (PRIVATE-CHANNEL)
        window.Echo.private('send-gift.' + {{ Auth::user()->team }}).listen('SendGift', (e) => {
            $('#histories-list').append("<tr><td><div class='history-detail'><b>[GIFT]</b> " + e.message +
                "</div></td></tr>");
            bringToBottom();

            var getAmountNow = parseInt($(".jumlah-material-" + e.id_material).eq(0).text());
            var amount = parseInt(getAmountNow) + parseInt(e.amount);
            $(".jumlah-material-" + e.id_material).text(amount);
        });

        // [RICKY] Mendapatkan jumlah material terbaru saat membeli di toko
        window.Echo.private('buy-material.' + {{ Auth::user()->team }}).listen('BuyMaterial', (e) => {
            $.each(e.material_list, function(index, value) {
                var getAmountNow = parseInt($(".jumlah-material-" + value.id).eq(0).text());
                var amount = parseInt(getAmountNow) + parseInt(value.qty);
                $(".jumlah-material-" + value.id).text(amount);
                $('.coin-amount').text(e.coin);
            });

            $('#histories-list').append("<tr><td><div class='history-detail'><b>[SHOP]</b> " + e.message +
                "</div></td></tr>");
            bringToBottom();
        });

        // [RICKY] Update Icon Status And Attack Amount
        window.Echo.private('update-status.' + {{ Auth::user()->team }}).listen('UpdateStatus', (e) => {
            if (e.team.debuff_decreased <= 0) {
                $('#ac').hide();
            }

            if (e.team.buff_increased <= 0) {
                $('#sp').hide();
            }

            if (e.attack_amount > 0) {
                $('#histories-list').append(
                    "<tr><td><div class='history-detail'><b>[ATTACK]</b> Berhasil melancarkan serangan sebesar " +
                    parseInt(e.attack_amount) + "</div></td></tr>");
                bringToBottom();
            }
        });
    </script>

</body>

</html>