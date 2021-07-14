<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Round</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../js/app.js"></script>
    </head>

    <body>
        <div class="me-4" style="float: right">
            <span class="h4 fw-bold mr-4 text-dark p-2 pt-0" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>

        <div class="ms-5 mt-3 h4">
            <span class="ronde"></span>
            <span class="sesi"></span>
            <span class="timer"></span>
        </div>
        
        <hr class="mt-4" style="height: 5px;">
        <!-- [RICKY] Bagian round & sesi -->
        <div class="ms-5 d-inline-block fw-bold h5">Update Round/Sesi : </div>
        <button class="btn btn-primary ms-3 text-white fw-bold" id="btn-update">Update Round</button>
        <button class="btn btn-danger ms-3 text-white fw-bold" id="btn-action">Update Sesi Action</button><br>
        <hr style="height: 5px;">

        <!-- [RICKY] Bagian broadcast video -->
        <div class="ms-5 d-inline-block fw-bold h5">Pilih Jenis Video : </div>
        <button class="btn btn-dark ms-3 text-white fw-bold" id="btn-broadcast-reminder" onclick="broadcastVideo(false)">Broadcast Video Reminder</button>
        <button class="btn btn-dark ms-3 text-white fw-bold" id="btn-broadcast-winner" onclick="broadcastVideo(true)">Broadcast Video Winner</button>
        <hr style="height: 5px;">

        <!-- [RICKY] Bagian part special weapon -->
        <div class="ms-5 d-inline-block fw-bold h5">Jumlah Part : </div>
        <input class="form-control ms-3 w-25 d-inline-block" type="number" min="1" value="1" id="part-amount">
        <button class="d-inline-block btn btn-info ms-5 text-white fw-bold" id="btn-update-part">Update Special Weapon Part</button><br>
        <hr style="height: 5px;">
        
        <script>
            // [RICKY] Ronde, sesi, timer
            var ronde = parseInt("{{ $round->round }}");
            var aksi = {{ $round->action }};
            var time = {{ $times }};

            // [RICKY] Tampilkan Ronde Sesi Timer saat reload halaman
            $(document).ready(function() {
                roundSessionTimer();
            });
            
            // [RICKY] Tampilkan Ronde Sesi Timer secara realtime
            var runTimer = setInterval(function () { roundSessionTimer(); }, 1000);

            // [RICKY] Round, session, timer
            function roundSessionTimer() {
                if (ronde < 1) {
                    $('.ronde').html("Game Besar Belum Dimulai");
                    $('#btn-action').attr('disabled', 'disabled');
                } else if (ronde > 16) {
                    $('.ronde').html("Game Besar Sudah Selesai");
                    $('.sesi').text("");
                    $('.timer').text("");
                    $('#btn-action').attr('disabled', 'disabled');
                    $('#btn-update').attr('disabled', 'disabled');
                } else {
                    $('.ronde').html("Round " + ronde + "&nbsp;(");
                    var sesi = (aksi) ? "Action" : "Preparation";
                    $('.sesi').text(sesi);

                    if (aksi) {
                        $('#btn-action').attr('disabled', 'disabled');
                        $('#btn-update').removeAttr('disabled');
                    } else {
                        $('#btn-update').attr('disabled', 'disabled');
                        $('#btn-action').removeAttr('disabled');
                    }
                    
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

            // [RICKY] Event untuk update ke ronde selanjutnya dengan aksi preparation
            $(document).on('click', '#btn-update', function(e) {
                e.preventDefault();

                const options = {
                    method: 'post',
                    url: '/update-round',
                    data: {},
                    transformResponse: [(data) => {
                        return data;
                    }]
                }

                axios(options);
            });

            // [RICKY] Event untuk update ke sesi action
            $(document).on('click', '#btn-action', function(e) {
                e.preventDefault();

                const options = {
                    method: 'post',
                    url: '/update-sesi',
                    data: {},
                    transformResponse: [(data) => {
                        return data;
                    }]
                }

                axios(options);
            });

            // [RICKY] Event untuk broadcast video reminder/winner
            function broadcastVideo(type) {
                const options = {
                    method: 'post',
                    url: '/broadcast-video',
                    data: {
                        'broadcast_type': type
                    },
                    transformResponse: [(data) => {
                        return data;
                    }]
                }

                axios(options);
            }

            // [RICKY] Event untuk update special part (testing doang)
            $(document).on('click', '#btn-update-part', function(e) {
                e.preventDefault();
                const options = {
                    method: 'post',
                    url: '/update-part-manual',
                    data: {
                        'amount': $('#part-amount').val()
                    },
                    transformResponse: [(data) => {
                        $('#part-amount').val(1);
                        return data;
                    }]
                }

                axios(options);
            });

            // [RICKY] Mendapatkan info round, sesi dan waktu saat ronde/sesi di update
            window.Echo.channel('roundChannel').listen('.update', (e) => {
                ronde = e.round;
                aksi = e.action;
                time = e.minutes * 60;
            });
        </script>
    </body>
</html>