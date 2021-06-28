<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Besar MOB FT</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard-peserta.css') }}">
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
                                        <td>{{ $e->nama_equipment }}</td>
                                        <td>{{ $e->jumlah_equipment }}</td>
                                        <td><button data-toggle="modal" data-target="#equipment-crafting" type="button" class="btn-craft" value="{{ $e->id_equipment }}" style="width: 80%; padding: 2%">Crafting</button></td>
                                        <td><button type="button" class="btn-use" value="{{ $e->id_equipment }}" style="width: 80%; padding: 2%">Use</button></td>
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

        <!-- [RICKY] Equipment crafting modal -->
        <div class="modal fade" id="equipment-crafting" tabindex="-1" role="dialog" aria-labelledby="equipmentCrafting" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle" style="margin: auto">Equipment Crafting</h6>
                    </div>

                    <div class="modal-body" id="modal-equipment-requirement-content">
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Crafting</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).on("click", ".btn-craft", function() {
                var id_equipment = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("get-equipment-requirement") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'id_equipment': id_equipment
                    },
                    success: function(data) {
                        $('#modal-equipment-requirement-content').html("&nbsp;Material yang dibutuhkan :");
                        $.each(data.equipment_requirement, function(index, value) {
                            $('#modal-equipment-requirement-content').append("<div>" + value.nama_material + "&nbsp;&nbsp;&nbsp;x" + value.jumlah_material + "</div>");
                        });
                    }
                });
            });
        </script>
    </body>
</html>