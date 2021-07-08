<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Game Besar MOB FT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../js/app.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard-peserta.css') }}">
    </head>
    
    <body>
        <div id="container">
            <!-- [RICKY] Struktur header halaman -->
            <header>
                <div class="header-left">
                    <span class="ronde"></span>
                    <span class="sesi"></span>
                    <span class="timer"></span>
                </div>

                <div class="header-right">
                    <span class="team-info">{{ Auth::user()->name }}</span>
                    <span class="h4 fw-bold mr-4 text-dark p-2" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </header>
            
            <!-- [RICKY] Struktur content halaman -->
            <div id="content">
                <!-- [RICKY] Struktur content bagian atas (gift, boss, history/log) -->
                <div class="content-top">
                    <!-- [RICKY] Struktur section gift -->
                    <section class="gift ps-4 pe-4">
                        <div class="w-100 text-center h4 fw-bold">GIFT</div>

                        <div>Pilih Team</div>
                        <select id="gift-kelompok" class="form-select w-100 mt-2 mb-3">
                            <option value="" selected disabled>-- Pilih Kelompok --</option>
                            @foreach($friend as $f)
                                <option value="{{$f->id}}">{{$f->name}}</option>
                            @endforeach
                        </select>

                        <div>Pilih Material</div>
                        <select id="gift-material" class="form-select w-100 mt-2 mb-3">
                            <option value="" selected disabled>-- Pilih Material --</option>
                            @foreach($material as $m)
                                <option value="{{$m->materials_id}}">{{$m->nama_material}}</option>
                            @endforeach
                        </select>

                        <div>Jumlah</div>
                        <input type="number" id="gift_jumlah" min='1' value="1" class="form-control w-100 mt-2 mb-3">
                        
                        <button class="btn btn-primary w-100 mt-2" id="btn-gift" data-bs-toggle="modal" data-bs-target="#konfirmasi-gift" >Gift</button>
                    </section>

                    <!-- [RICKY] Struktur section boss -->
                    <section class="boss">
                        <div class="boss-image">
                            <img src="{{ asset('assets/image/cat.jpeg') }}" width="40%" alt="boss-image" style="border-radius: 20px">
                        </div>
                        
                        <div class="boss-hp">
                            @php $hp_boss = $boss->hp_amount * 100 / 100000; @endphp
                            <div style="text-align: center; margin: 1% 0">Monster Boss HP</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $hp_boss }}%;" id="boss-hp-amount"></div>
                            </div>
                        </div>

                        <div class="secret-weapon">
                            @php $weapon_progress = $weapon->part_amount_collected * 100 / $weapon->part_amount_target; @endphp
                            <div style="text-align: center; margin: 1% 0">Secret Weapon</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $weapon_progress }}%;" id="part-progress"></div>
                            </div>
                        </div>
                    </section>

                    <!-- [RICKY] Struktur section history -->
                    <section class="history">
                        <table class="history-table">
                            <tbody id="histories-list">
                                @foreach($histories as $h)
                                    <tr><td><div class="history-detail">{{ $h->name }}</div></td></tr>
                                @endforeach
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
                                @foreach($material as $m)
                                    <tr>
                                        <td>{{$m->nama_material}}</td>
                                        <td id="jumlah-material-{{ $m->materials_id }}">{{$m->jumlah}}</td>
                                    </tr>
                                @endforeach
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
                                        <td id="jumlah-equipment-{{ $e->id_equipment }}">{{ $e->jumlah_equipment }}</td>
                                        <td><button type="button" class="btn btn-info btn-craft text-white p-1" value="{{ $e->id_equipment }}" style="width: 80%; padding: 2%">Crafting</button></td>
                                        <td><button type="button" class="btn btn-primary btn-use p-1" value="{{ $e->id_equipment }}" style="width: 80%; padding: 2%">Use</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>

                    <!-- [RICKY] Struktur section control -->
                    <section class="control">
                        <div class="coin">Coin : <span class="coin-amount">{{ $team->coin }}</span></div>

                        <div class="attack">
                            @if($team->weapon_level == 0)
                                <button class="btn btn-secondary me-1" style="width: 49%;" id="btn-weapon-attack" disabled="disabled">Attack</button>
                            @else
                                <button class="btn btn-danger me-1" style="width: 49%;" id="btn-weapon-attack">Attack</button>
                            @endif

                            @if($team->weapon_level == 3)
                                <button class="btn btn-secondary" style="width: 49%;" disabled="disabled" id="btn-upgrade">Upgrade Weapon</button>
                            @else
                                <button class="btn btn-primary" style="width: 49%;" id="btn-upgrade">Upgrade Weapon</button>
                            @endif
                            
                            <div style="margin-top: 1%">
                                Weapon:
                                <span id="weapon-name">
                                    @if($team->weapon_level == 0)
                                        -
                                    @elseif($team->weapon_level == 1)
                                        Loops Hammer (Lv1)
                                    @elseif($team->weapon_level == 2)
                                        Master Sword (Lv2)
                                    @elseif($team->weapon_level == 3)
                                        Quantum Gun (Lv3)
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="team-hp">
                            <div style="margin-bottom: 1%">Team HP :</div>
                            @php $hp_amount = $team->hp_amount * 100 / 1000; @endphp
                            <div class="progress" style="background: rgba(0,0,0,0.35)">
                                <div class="progress-text text-white" id="hp-team">{{ $team->hp_amount }}/1000</div>
                                <div class="progress-bar" role="progressbar" style="width: {{ $hp_amount }}%;" id="team-hp-bar"></div>
                            </div>
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
                        <h6 class="modal-title" id="modal-title-crafting" style="margin: auto"></h6>
                    </div>

                    <div class="modal-body">
                        <div style="margin-bottom: 1%;">&nbsp;Material yang dibutuhkan :</div>
                        <div id="modal-equipment-requirement-content"></div>
                        <div style="margin-top: 5%; margin-bottom: 3%;">&nbsp;Jumlah crafting :</div>
                        <input class="form-control" type="number" min="1" value="1" id="crafting-amount">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-confirm-crafting">Crafting</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal use equipment -->
        <div class="modal fade" id="equipment-use" tabindex="-1" role="dialog" aria-labelledby="equipmentUse" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-use" style="margin: auto">Use Equipment</h6>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-confirm-use">Use</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal upgrade weapon -->
        <div class="modal fade" id="weapon-upgrade" tabindex="-1" role="dialog" aria-labelledby="weaponUpgrade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"style="margin: auto">Upgrade Weapon?</h6>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-confirm-upgrade">Upgrade</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal hasil (berhasil/gagal) -->
        <div class="modal fade" id="result-modal" tabindex="-1" role="dialog" aria-labelledby="resultModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <span id="modal-result-message" style="display:inline-block; width: 90%"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right"></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal video reminder -->
        <div class="modal fade" id="reminder-modal" tabindex="-1" role="dialog" aria-labelledby="reminderModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 800px;">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe id="video-reminder" width="100%" height="450" src=""></iframe>
                    </div>
                    <button type="button" class="btn btn-danger stop-video" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

        <!-- [RICKY] Modal video winner -->
        <div class="modal fade" id="winner-modal" tabindex="-1" role="dialog" aria-labelledby="winnerModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 800px;">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe id="video-winner" width="100%" height="450" src=""></iframe>
                    </div>
                    <button type="button" class="btn btn-danger stop-video" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

         <!-- [Yobong] Modal Konfirmasi Gift (Ya/Tidak) -->
         <div class="modal fade" id="konfirmasi-gift" tabindex="-1" role="dialog" aria-labelledby="weaponUpgrade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"style="margin: auto">Yakin mengirim material?</h6>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="gift_kirim" onclick="gift()">Ya</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            // [RICKY] Ronde, sesi, timer, status, weapon level
            var ronde = parseInt("{{ $round->round }}");
            var aksi = {{ $round->action }};
            var time = {{ $times }};
            var teamStatus = ( {{ $team->hp_amount }} > 0 ) ? true : false;
            var weaponLevel = {{ $team->weapon_level }};

            // [RICKY] Disable semua control
            function disableAllControl() {
                $('#gift-kelompok').attr('disabled', 'disabled');
                $('#gift-material').attr('disabled', 'disabled');
                $('#gift_jumlah').attr('disabled', 'disabled');
                $('#btn-gift').attr('disabled', 'disabled');
                $('.btn-craft').attr('disabled', 'disabled');
                $('.btn-use').attr('disabled', 'disabled');
                $('#btn-weapon-attack').attr('disabled', 'disabled');
                $('#btn-upgrade').attr('disabled', 'disabled');
            }

            // [RICKY] Pengecekan level senjata dan action
            function checkWeaponAction() {
                if (teamStatus) {
                    if (aksi) {
                        $('#gift-kelompok').attr('disabled', 'disabled');
                        $('#gift-material').attr('disabled', 'disabled');
                        $('#gift_jumlah').attr('disabled', 'disabled');
                        $('#btn-gift').attr('disabled', 'disabled');
                        $('.btn-craft').attr('disabled', 'disabled');
                        $('.btn-use').removeAttr('disabled');

                        if (weaponLevel > 0) {
                            $('#btn-upgrade').attr('disabled', 'disabled');
                            $('#btn-upgrade').removeClass("btn-primary");
                            $('#btn-upgrade').addClass("btn-secondary");

                            $('#btn-weapon-attack').removeAttr('disabled');
                            $('#btn-weapon-attack').removeClass("btn-secondary");
                            $('#btn-weapon-attack').addClass("btn-danger");
                        } else if (weaponLevel <= 0) {
                            $('#btn-upgrade').attr('disabled', 'disabled');
                            $('#btn-upgrade').removeClass("btn-primary");
                            $('#btn-upgrade').addClass("btn-secondary");

                            $('#btn-weapon-attack').attr('disabled', 'disabled');
                            $('#btn-weapon-attack').removeClass("btn-danger");
                            $('#btn-weapon-attack').addClass("btn-secondary");
                        } 
                    } else {
                        $('#gift-kelompok').removeAttr('disabled');
                        $('#gift-material').removeAttr('disabled');
                        $('#gift_jumlah').removeAttr('disabled');
                        $('#btn-gift').removeAttr('disabled');
                        $('.btn-craft').removeAttr('disabled');
                        $('.btn-use').attr('disabled', 'disabled');
                        
                        if (weaponLevel >= 3) {
                            $('#btn-upgrade').attr('disabled', 'disabled');
                            $('#btn-upgrade').removeClass("btn-primary");
                            $('#btn-upgrade').addClass("btn-secondary");

                            $('#btn-weapon-attack').attr('disabled', 'disabled');
                            $('#btn-weapon-attack').removeClass("btn-danger");
                            $('#btn-weapon-attack').addClass("btn-secondary");
                        } else if (weaponLevel < 3) {
                            $('#btn-upgrade').removeAttr('disabled');
                            $('#btn-upgrade').removeClass("btn-secondary");
                            $('#btn-upgrade').addClass("btn-primary");

                            $('#btn-weapon-attack').attr('disabled', 'disabled');
                            $('#btn-weapon-attack').removeClass("btn-danger");
                            $('#btn-weapon-attack').addClass("btn-secondary");
                        }
                    }
                } else {
                    disableAllControl();
                }
            }

            // [RICKY] Saat ada history baru, tabel di scroll ke paling bawah
            function bringToBottom() {
                $("#histories-list").scrollTop($("#histories-list")[0].scrollHeight);
            }

            // [RICKY] Tampilan halaman saat reload
            $(document).ready(function() {
                // [RICKY] Jika hp abis atau ronde tidak aktif, disable semua kontrol
                if (teamStatus && ronde > 0 && ronde <= 20) {
                    checkWeaponAction();
                } else {
                    disableAllControl();
                }

                roundSessionTimer();
                bringToBottom();
            });
            
            // [RICKY] Tampilkan Ronde Sesi Timer secara realtime
            var runTimer = setInterval(function () { roundSessionTimer(); }, 1000);

            // [RICKY] Round, session, timer
            function roundSessionTimer() {
                if(ronde < 1) {
                    disableAllControl();
                    $('.ronde').html("Game Besar Belum Dimulai");
                } else if (ronde > 20) {
                    disableAllControl();
                    $('.ronde').html("Game Besar Sudah Selesai");
                    $('.sesi').text("");
                    $('.timer').text("");
                } else {
                    $('.ronde').html("Round " + ronde + "&nbsp;(");
                    var sesi = (aksi) ? "Action" : "Preparation";
                    $('.sesi').text(sesi);
                    
                    if (time > 0) {
                        minutes = (Math.floor(time / 60)).toString().padStart(2, '0');
                        seconds = (time % 60).toString().padStart(2, '0');
                        $('.timer').html(") " + minutes + ":" + seconds);
                        time--;
                    } else {
                        $('.timer').html(") 00:00");
                    }
                }
            }

            // [RICKY] Event click button crafting
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

            // [RICKY] Event click button use
            $(document).on("click", ".btn-use", function() {
                var nama_equipment = $(this).parent().parent().children('.nama-equipment').text();
                var id_equipment = $(this).val();

                $('#modal-title-use').text("Use " + nama_equipment + " x1?");
                $('#btn-confirm-use').val(id_equipment);
                $('#equipment-use').modal('show');
            });

            // [RICKY] Event click button attack
            $(document).on("click", "#btn-weapon-attack", function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("attack-weapon") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#histories-list').append("<tr><td><div class='history-detail'>" + data.message + "</div></td></tr>");
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }
                    }
                });
            });

            // [RICKY] Event click button upgrade weapon
            $(document).on("click", "#btn-upgrade", function() {
                $('#weapon-upgrade').modal('show');
            });

            // [RICKY] Event click button crafting di modal
            $(document).on("click", "#btn-confirm-crafting", function() {
                var id_equipment = $(this).val();
                var amount = $('#crafting-amount').val();
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route("crafting-equipment") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'id_equipment': id_equipment,
                        'amount': amount
                    },
                    success: function(data) {
                        $('#crafting-amount').val(1);
                        
                        if (data.crafting_result) {
                            var amount_now = parseInt($("#jumlah-equipment-" + id_equipment).text()) + parseInt(amount);
                            $("#jumlah-equipment-" + id_equipment).text(amount_now);

                            $.each(data.material_update, function(index, value) {
                                $("#jumlah-material-" + value.materials_id).text(value.amount);
                            });

                            $('#histories-list').append("<tr><td><div class='history-detail'>" + data.message + "</div></td></tr>");
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }
                    }
                });
            });

            // [RICKY] Event click button use di modal
            $(document).on("click", "#btn-confirm-use", function() {
                var id_equipment = $(this).val();
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route("use-equipment") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'id_equipment': id_equipment
                    },
                    success: function(data) {
                        if (data.use_result) {
                            $("#jumlah-equipment-" + id_equipment).text(data.amount_now);

                            $('#histories-list').append("<tr><td><div class='history-detail'>" + data.message + "</div></td></tr>");
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }

                        if (data.update_hp != 0) {
                            $('#hp-team').text(data.update_hp + "/1000");
                            var hpBar = (parseInt(data.update_hp) * 100 / 1000) + "%";
                            $('#team-hp-bar').css('width', hpBar);
                        }
                    }
                });
            });

            // [RICKY] Event click button upgrade di modal
            $(document).on("click", "#btn-confirm-upgrade", function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("upgrade-weapon") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        if (data.status) {
                            weaponLevel = data.level_weapon;
                            checkWeaponAction();
                            
                            if (weaponLevel == 1) {
                                $('#weapon-name').text("Loops Hammer (Lv1)");
                            } else if (weaponLevel == 2) {
                                $('#weapon-name').text("Master Sword (Lv2)");
                            } else if (weaponLevel == 3) {
                                $('#weapon-name').text("Quantum Gun (Lv3)");
                            }

                            $.each(data.material_update, function(index, value) {
                                $("#jumlah-material-" + value.materials_id).text(value.amount);
                            });

                            $('#histories-list').append("<tr><td><div class='history-detail'>" + data.message + "</div></td></tr>");
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.message);
                        }
                    }
                });
            });

            // [RICKY] Reset jumlah crafting ketika modal crafting ditutup
            $('#equipment-crafting').on('hidden.bs.modal', function() {
                $('#crafting-amount').val(1);
            });

            // [RICKY] Berhentiin video youtube ketika modal close
            $(document).on("click", ".stop-video", function() {
                $('#video-winner').attr('src', 'https://www.youtube.com/embed/ROk9qsYjwY0?start=171&autoplay=1&mute=1');
                $('#video-reminder').attr('src', 'https://www.youtube.com/embed/Ngq0omaP8Xg?start=28&autoplay=1&mute=1');
            });

            // [Yobong] kirim gift
            function gift() {
                var tujuan = $('#gift-kelompok').val();
                var material = $('#gift-material').val();
                var jumlah = $('#gift_jumlah').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("gift") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'tujuan': tujuan,
                        'material': material,
                        'jumlah': jumlah
                    },
                    success: function(data) {
                        $('#gift_jumlah').val('1');

                        if (data.status) {
                            $('#histories-list').append("<tr><td><div class='history-detail'>" + data.msg + "</div></td></tr>");
                            $("#jumlah-material-" + material).text(data.jumlah_sekarang);
                            bringToBottom();
                        } else {
                            $('#result-modal').modal('show');
                            $('#modal-result-message').text(data.msg);
                        }
                    }
                });
            }

            // [RICKY] Mendapatkan info round, sesi dan waktu saat ronde/sesi di update (PUBLIC-CHANNEL)
            window.Echo.channel('roundChannel').listen('.update', (e) => {
                ronde = e.round;
                aksi = e.action;
                time = e.minutes * 60;

                checkWeaponAction();
                $('#equipment-crafting').modal('hide');
                $('#equipment-use').modal('hide');
                $('#weapon-upgrade').modal('hide');
                $('#konfirmasi-gift').modal('hide');

                if (!aksi) {
                    var boss_hp = 100 * e.boss_hp / 100000;
                    $('#boss-hp-amount').css('width', boss_hp + "%");
                    $('#result-modal').modal('show');
                    $('#modal-result-message').text("Round telah berganti");
                }
            });

            // [RICKY] Mendapatkan instruksi saat video di broadcast (PUBLIC-CHANNEL)
            window.Echo.channel('videoChannel').listen('.broadcast', (e) => {
                if (e.broadcast_winner) {
                    $('#winner-modal').modal({backdrop: 'static', keyboard: false});
                    $('#winner-modal').modal('show');
                    $('#video-winner').attr('src', 'https://www.youtube.com/embed/ROk9qsYjwY0?start=171&autoplay=1&mute=0');
                } else {
                    $('#reminder-modal').modal({backdrop: 'static', keyboard: false});
                    $('#reminder-modal').modal('show');
                    $('#video-reminder').attr('src', 'https://www.youtube.com/embed/Ngq0omaP8Xg?start=28&autoplay=1&mute=0');
                }
            });

            // [RICKY] Mendapatkan jumlah part terbaru (PUBLIC-CHANNEL)
            window.Echo.channel('partChannel').listen('.progress', (e) => {
                var progress = 100 * e.collected / e.target;
                $('#part-progress').css('width', progress + "%");
            });

            // [RICKY] Mendapatkan quest result yang dijalanakan (PRIVATE-CHANNEL)
            window.Echo.private('privatequest.' + {{ Auth::user()->team }}).listen('PrivateQuestResult', (e) => {
                $('#histories-list').append("<tr><td><div class='history-detail'>" + e.message + "</div></td></tr>");
                bringToBottom();
            });

            // [RICKY] Mendapatkan hp team terbaru saat round berganti (PRIVATE-CHANNEL)
            window.Echo.private('update-hitpoint.' + {{ Auth::user()->team }}).listen('UpdateHitpoint', (e) => {
                var hpAmount = (parseInt(e.health) * 100 / 1000) + "%";
                $('#team-hp-bar').css('width', hpAmount);
                $('#hp-team').text(e.health + "/1000");

                teamStatus = (e.health > 0) ? true : false;
                checkWeaponAction();

                if (e.message != null) {
                    $('#histories-list').append("<tr><td><div class='history-detail'>" + e.message + "</div></td></tr>");
                }
                
                if (e.health <= 0) {
                    $('#histories-list').append("<tr><td><div class='history-detail'>Tidak dapat bermain lagi</div></td></tr>");
                }

                bringToBottom();
            });

            // [RICKY] Mendapatkan gift yang dikirimkan kelompok lain (PRIVATE-CHANNEL)
            window.Echo.private('send-gift.' + {{ Auth::user()->team }}).listen('SendGift', (e) => {
                $('#histories-list').append("<tr><td><div class='history-detail'>" + e.message + "</div></td></tr>");
                bringToBottom();

                var getAmountNow = parseInt($("#jumlah-material-" + e.id_material).text());
                var amount = parseInt(getAmountNow) + parseInt(e.amount);
                $("#jumlah-material-" + e.id_material).text(amount);
            });

            // [RICKY] Mendapatkan jumlah material terbaru saat membeli di toko
            window.Echo.private('buy-material.' + {{ Auth::user()->team }}).listen('BuyMaterial', (e) => {
                $.each(e.material_list, function(index, value) {
                    var getAmountNow = parseInt($("#jumlah-material-" + value.id).text());
                    var amount = parseInt(getAmountNow) + parseInt(value.qty);
                    $("#jumlah-material-" + value.id).text(amount);
                    $('.coin-amount').text(e.coin);
                });

                $('#histories-list').append("<tr><td><div class='history-detail'>" + e.message + "</div></td></tr>");
                bringToBottom();
            });
        </script>
    </body>
</html>