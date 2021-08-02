<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rally Games</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../js/app.js"></script>
        <style>
            .hidden{
                display: none;
            }
        </style>
    </head>

    <body>
        <div class="me-4" style="float: right">
            <span class="h4 fw-bold mr-4 text-dark p-2 pt-0" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>

        <div class="container">
        @if(session('status'))
            <div class="alert alert-success" id="">
                {{session('status')}}
            </div>
        @endif
        <div class="row justify-content-cent er">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <br> <br>
                    
                        <select name="tipe" id="tipe" onchange="battle()">
                        <option value="" selected disabled>-- Pilih Tipe Game --</option>
                        <option value="singel">Single</option>
                        <option value="battle" >Battle</option>
                        </select>
                        <br> <br>
                        <label for="" id="kelompok1Label">
                            <select name="kelompok1" id="kelompok1" >
                            <option value="" selected disabled >-- Pilih Kelompok 1 --</option>
                            @foreach ($teams as $t)
                                <option value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                            </select> 
                        </label>
                        
                        <label for="" id="kelompok2Label" class="hidden">
                        Kalah:
                        <select name="kelompok2" id="kelompok2" >
                        <option value="" selected disabled >-- Pilih Kelompok 2 --</option>
                        @foreach ($teams as $t)
                            <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                        </select>
                        </label>
                        
                        <br> <br>
                        <select name="status" id="status">
                        
                        </select> <br> <br>

                        <button type=button id="simpan" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="simpan()">Simpan</button>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/rally/simpan" method="post">
            @csrf
            <div class="modal-body">
                Yakin untuk memasukan Coin?
                <input type="hidden" id="tipe_modal" name="tipe" value="">
                <input type="hidden" id="kelompok1_modal" name="kelompok1" value="">
                <input type="hidden" id="kelompok2_modal" name="kelompok2" value="">
                <input type="hidden" id="status_modal" name="status" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary" >Ya</button>
            </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        function battle(){
           var tipe = $('#tipe').val();
          
           if(tipe == "battle"){
               $('#kelompok2Label').removeClass('hidden');
                $('#kelompok1Label').prepend('<span id="win">Menang: </span>');
                $('#status').empty();
                $('#status').append('<option value="winOrLose">Menang atau Kalah</option>');
                $('#status').append('<option value="draw">Draw</option>');
           }
           else{
            $('#kelompok2Label').addClass('hidden');
            $('span#win').remove();
            $('#status').empty();
            $('#status').append('<option value="win">Menang</option>');
            $('#status').append('<option value="lose">Kalah</option>');
           }
        }

        function simpan(){
            var tipe = $('#tipe').val();
            var kelompok1 = $('#kelompok1').val();
            var kelompok2 = $('#kelompok2').val();
            var status = $('#status').val();
            $("#tipe_modal").val(tipe);
            $("#kelompok1_modal").val(kelompok1);
            $("#kelompok2_modal").val(kelompok2);
            $("#status_modal").val(status);
    }
    </script>

    </body>
</html>