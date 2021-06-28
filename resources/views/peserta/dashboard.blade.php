<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Besar MOB FT</title>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard-peserta.css') }}">
        <style>
        
        </style>
    </head>
    
    <body>
        <div id="container">
            <!-- [RICKY] Struktur header halaman -->
            <header>
                <div class="header-left">
                    <span class="ronde">Round X&nbsp;</span>
                    <span class="sesi">Preparation&nbsp;</span>
                    <span class="timer">03:00</span>
                </div>

                <div class="header-right">
                    <span class="team-info">Team 1</span>
                    <span class="logout">Logout</span>
                </div>
            </header>
            
            <!-- [RICKY] Struktur content halaman -->
            <div id="content">
                <!-- [RICKY] Struktur content bagian atas (gift, boss, history/log) -->
                <div class="content-top">
                    <!-- [RICKY] Struktur section gift -->
                    <section class="gift">
                        <table class="gift-table">
                            <tbody>
                                @for($i = 2; $i <= 30; $i++)
                                    <tr>
                                        <td>Tim {{ $i }}</td>
                                        <td><button type="button" style="width: 80%; padding: 2%" class="btn-gift-material">Gift</button></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </section>

                    <!-- [RICKY] Struktur section boss -->
                    <section class="boss">
                        <div class="boss-image">
                            <img src="{{ asset('assets/image/cat.jpeg') }}" width="40%" alt="boss-image" style="border-radius: 20px">
                        </div>

                        <div class="boss-hp">
                            <label>Monster Boss HP<br><br><br></label>
                            <progress value="95000" max="100000" style="width: 30%; position: absolute"></progress>
                        </div>

                        <div class="secret-weapon">
                            <label>Secret Weapon Progress<br><br><br></label>
                            <progress value="80" max="300" style="width: 30%; position: absolute"></progress>
                        </div>
                    </section>

                    <!-- [RICKY] Struktur section history -->
                    <section class="history">
                        <table class="history-table">
                            <tbody>
                                @for($i = 1; $i <= 30; $i++)
                                    <tr>
                                        <td>History {{ $i }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </section>
                </div>

                <!-- [RICKY] Struktur content bagian bawah (material, equipment, control) -->
                <div class="content-bottom">
                    <!-- [RICKY] Struktur section material -->
                    <section class="material">
                        <table class="material-table">
                            <tbody>
                                @for($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>Material {{ $i }}</td>
                                        <td>0</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </section>

                    <!-- [RICKY] Struktur section equipment -->
                    <section class="equipment">
                        <table class="equipment-table">
                            <tbody>
                                @foreach($equipments as $e)
                                    <tr>
                                        <td>{{ $e->name }}</td>
                                        <td>0</td>
                                        <td><button type="button" id="craft" style="width: 80%; padding: 2%">Crafting</button></td>
                                        <td><button type="button" style="width: 80%; padding: 2%">Use</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>

                    <!-- [RICKY] Struktur section control -->
                    <section class="control">
                        <div class="coin">Coin : 0</div>

                        <div class="attack">
                            <button type="button" style="width: 100%">Attack</button>
                        </div>

                        <div class="team-hp">
                            <label for="file">Team HP :&nbsp;&nbsp;&nbsp;</label>
                            <progress value="790" max="1000" style="width: 100%"></progress>
                        </div>

                        <div class="status">

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>