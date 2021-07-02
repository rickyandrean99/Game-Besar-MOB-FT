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
        <button class="btn btn-primary ms-5 mt-5" id="btn-update">Update Round</button>
        <button class="btn btn-danger ms-5 mt-5" id="btn-action">Update Sesi Action</button>

        <div class="ms-5 mt-3 h4">
            <span class="ronde"></span>
            <span class="sesi"></span>
            <span class="timer"></span>
        </div>

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
                } else if (ronde > 20) {
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

            // [RICKY] Memperbaharui timer setelah ronde/sesi di update
            window.Echo.channel('roundChannel').listen('.update', (e) => {
                ronde = e.round;
                aksi = e.action;
                time = e.minutes * 60;
            });
        </script>
    </body>
</html>