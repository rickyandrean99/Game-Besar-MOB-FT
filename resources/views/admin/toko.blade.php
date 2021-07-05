<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Game Besar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="../js/app.js"></script> -->
    <link rel="stylesheet" href="{{ asset('assets/css/toko-admin.css') }}">
</head>

<body>
    <header>
        <div>
            Selamat Datang, Admin.
        </div>
        <div class="logout">
            LOGOUT
        </div>
    </header>
    <main>
        <div class="pilih">
            <div class="cboTeam">
                <label for="kelompok" style="font-weight:bold">Pilih kelompok:</label>
                <select class="form-control" id="kelompok">
                    <option value="-">--Pilih Team--</option>
                    @foreach($team as $t)
                    <option value="{{$t->id}}" id="{{$t->coin}}">{{$t->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="koin">
                <span>Koin</span><br>
                <span class="koinKelompok"></span>
            </div>
        </div>
        <form id="myform">
        <!-- <form id="myform" method="POST" action=""> -->
            <div class="table-scroll">
                <table id = "materialTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col" style="width: 150px;">Jumlah</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($material as $m)
                        <tr>
                            <td scope="row" class="idMaterial">{{$m->id}}</td>
                            <td scope="row" class="namaMaterial" id="{{$m->id}}">{{$m->name}}</td>
                            <td class="price" seq="{{$m->id}}">{{$m-> price}}</td>
                            <td>{{$m-> stock}}</td>
                            <td><input type="number" style="width: 100px;" class="qty" seq="{{$m->id}}" min=0></td>
                            <td class="subtotal" seq="{{$m->id}}">0</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=5 style="text-align:right; font-weight: bold;">Total</td>
                            <td class="total" id="total">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tombol">
                <button type="button" class="btn btn-primary" id="buy">Buy</button>
            </div>
        </form>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="showTable">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="buysemua">Buy</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('myform').reset();
    $('document').ready(function() {
        //Koin kelompok berubah ketika combo box berubah
        $('#kelompok').on('change', function(e) {
            var coin = $(this).children(":selected").attr("id");
            $('.koinKelompok').text(coin);
        });

        //Kalau qty berubah
        $('.qty').on('change', function() {
            var seq = $(this).attr('seq');
            var price = $(".price[seq=" + seq + "]").text();
            var qty = $(".qty[seq=" + seq + "]").val();          

            $(".subtotal[seq=" + seq + "]").html(price * qty);

            var grand = 0;
            $('.subtotal').each(function() {
                grand += $(this).html() * 1;
            });
            $('.total').text(grand);
        });
        
        //Kalau total berubah (blm fix)
        $('.total').on('change', function(){
            if(total > koin){
                $('.koinKelompok').addClass('red');
            }
            else{
                $('.koinKelompok').removeClass('red');
            }
        });
        var arrVal=[];
       
        //Ambil data tabel dimana input value-nya tdk kosong
        function getDataTable(){
            var total = $('#total').text();
            alert(total);
            arrVal=[];
            $('#showTable').empty();
            //Iterasi tiap data di table
            $('#materialTable tr').each(function(){
                var qty = $(this).find(".qty").val();
                if(qty > 0){
                    var idmaterial =$(this).find(".idMaterial").text();

                    var nama = $(this).find(".namaMaterial").text();
                    var subtotal = $(this).find(".subtotal").text();
                    var val = {id:idmaterial, qty:qty, total:total};
                    arrVal.push(val);

                    $('#showTable').append(nama + " (" + qty + "x) = " + subtotal + "<br>");    
                }
            });
            $('#showTable').append("Total = " + total); 
        }

        //Kalau button Buy diklik
        $('#buy').on("click", function() {
            $('#buyModal').modal('show');
            getDataTable();
        });

        // //Kalau modal Buy diklik
        $('#buysemua').on("click", function() {
           var team_id =  $('#kelompok').val();
           var cart = arrVal;
            alert(cart[0]['id']);
            $.ajax({
                type: "POST",
                url: "{{route('buymaterials')}}",
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'team_id': team_id,
                    'cart': cart
                },
                success: function(data) {
                     alert(data.cart);
                     location.reload();

                },
            })
        });
    });
</script>

</html>