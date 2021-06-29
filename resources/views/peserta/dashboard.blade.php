<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Besar MOB FT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                                        <td class="nama-equipment">{{ $e->nama_equipment }}</td>
                                        <td>{{ $e->jumlah_equipment }}</td>
                                        <td><button type="button" class="btn-craft" value="{{ $e->id_equipment }}" style="width: 80%; padding: 2%">Crafting</button></td>
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

        <!-- [RICKY] Modal crafting equipment -->
        <div class="modal fade" id="equipment-crafting" tabindex="-1" role="dialog" aria-labelledby="equipmentCrafting" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-crafting" style="margin: auto">Equipment Crafting</h6>
                    </div>

                    <div class="modal-body">
                        <div style="margin-bottom: 1%;">&nbsp;Material yang dibutuhkan :</div>
                        <div id="modal-equipment-requirement-content"></div>
                        <div style="margin-top: 5%; margin-bottom: 3%;">&nbsp;Jumlah crafting :</div>
                        <input class="form-control" type="number" min="0" value="0" id="crafting-amount">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-confirm-crafting">Crafting</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal hasil (berhasil/gagal) -->
        <div class="modal fade" id="result-modal" tabindex="-1" role="dialog" aria-labelledby="resultModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <span id="modal-result-message"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right"></button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            // [RICKY] Event click button crafting (untuk ambil list material yang dibutuhkan)
            $(document).on("click", ".btn-craft", function() {
                var nama_equipment = $(this).parent().parent().children('.nama-equipment').text();
                var id_equipment = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("get-equipment-requirement") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'id_equipment': id_equipment
                    },
                    success: function(data) {
                        $('#modal-title-crafting').text("Crafting " + nama_equipment);
                        $('#modal-equipment-requirement-content').html("");
                        $.each(data.equipment_requirement, function(index, value) {
                            $('#modal-equipment-requirement-content').append("<div>" + value.nama_material + "&nbsp;&nbsp;&nbsp;x" + value.jumlah_material + "</div>");
                        });
                        $('#equipment-crafting').modal('show');
                        $('#btn-confirm-crafting').val(id_equipment);
                    }
                });
            });

            // [RICKY] Event click button crafting di modal (untuk ambil list material yang dibutuhkan)
            $(document).on("click", "#btn-confirm-crafting", function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("crafting-equipment") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'id_equipment': $(this).val(),
                        'amount': $('#crafting-amount').val()
                    },
                    success: function(data) {
                        $('#result-modal').modal('show');
                        $('#crafting-amount').val(0);

                        if (data.crafting_result) {
                            $('#modal-result-message').text("Crafting Berhasil");
                        } else {
                            $('#modal-result-message').text("Crafting Gagal");
                        }
                    }
                });
            });
        </script>
    </body>
</html>