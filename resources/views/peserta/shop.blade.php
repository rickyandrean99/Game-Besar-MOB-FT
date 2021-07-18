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
    <link rel="stylesheet" href="{{ asset('assets/css/toko-admin.css') }}">
</head>

<body>
    <header>
        <div>
            Selamat Datang, {{ Auth::user()->name }}.
        </div>
    </header>
    <main>
        <div class="pilih">
            <div class="koin">
                <span>Koin</span><br>
                <span class="koinKelompok">{{$team->coin}}</span>
            </div>
        </div>
        <form id="myform">
            <!-- <form id="myform" method="POST" action=""> -->
            <div class="table-scroll">
                <table id="materialTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 200px;">Jumlah</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($material as $m)
                        <tr>
                            <td scope="row" class="idMaterial">{{$m->id}}</td>
                            <td scope="row" class="namaMaterial" id="{{$m->id}}">{{$m->name}}</td>
                            <td class="stock" seq="{{$m->id}}">{{$m-> stock}}</td>
                            <td class="price" seq="{{$m->id}}">{{$m-> price}}</td>
                            <td><input type="number" style="width: 100px;" class="qty" seq="{{$m->id}}" min=0><input type="button" seq="{{$m->id}}" class="btn btn-secondary reset" style="margin-left:10px; width:50px; height: 45px;" value=&#8634;></td>
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
                <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Back</a>
                <button type="button" class="btn btn-primary" id="buy">Buy</button>
            </div>
        </form>
    </main>
    <!-- Modal Buy -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Apakah kamu yakin?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showTable">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="buysemua">Buy</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gagal membeli!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showError"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Status -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Berhasil membeli!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showStatus"></div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{route('dashboard')}}" role="button">Oke!</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('document').ready(function() {
        document.getElementById('myform').reset();
        var coin = "";
        var total = "";

        $('.stock').each(function() {
            if ($(this).text() == 0) {
                $(this).addClass('red');
            } else {
                $(this).removeClass('red');
            }
        });

        //Kalau qty berubah
        $('.qty').on('change', function() {
            coin = parseInt($('.koinKelompok').text());
            var seq = $(this).attr('seq');
            var stock = parseInt($(".stock[seq=" + seq + "]").text());
            var qty = parseInt($(".qty[seq=" + seq + "]").val());

            if (stock < qty) {
                $(".stock[seq=" + seq + "]").addClass('red');
                document.getElementById('buy').disabled = true;
            } else {
                if (stock != 0) {
                    $(".stock[seq=" + seq + "]").removeClass('red');
                }
            }

            var price = $(".price[seq=" + seq + "]").text();

            if (qty <= 0) {
                qty = 0;
                $(".qty[seq=" + seq + "]").val(qty);
            }

            $(".subtotal[seq=" + seq + "]").html(price * qty);

            var grand = 0;
            $('.subtotal').each(function() {
                grand += $(this).html() * 1;
            });
            $('.total').text(grand);

            if (grand > coin) {
                $('.koinKelompok').addClass('red');
            } else {
                $('.koinKelompok').removeClass('red');
            }

        });

        var arrVal = [];
        //Ambil data tabel dimana input value-nya tdk kosong
        function getDataTable() {
            arrVal = [];
            $('#showTable').empty();
            $('#showTable').append("Item yang akan dibeli:<br>");
            //Iterasi tiap data di table
            $('#materialTable tr').each(function() {
                var qty = $(this).find(".qty").val();
                if (qty > 0) {
                    var idmaterial = $(this).find(".idMaterial").text();
                    var nama = $(this).find(".namaMaterial").text();
                    var subtotal = $(this).find(".subtotal").text();
                    var val = {
                        id: idmaterial,
                        qty: qty,
                        total: total
                    };
                    arrVal.push(val);
                    $('#showTable').append(nama + " (" + qty + "x) = " + subtotal + "<br>");
                }
            });
            $('#showTable').append("Total = " + total);
        }

        //Kalau button Buy diklik
        $('#buy').on("click", function() {
            coin = parseInt($('.koinKelompok').text());
            total = parseInt($('#total').text());
            getDataTable();
            if (coin >= total) {
                if (total == 0) {
                    $('#errorModal').modal('show');
                    $('#showError').text('Wah, kelihatannya belum beli material sama sekali ya?');
                } else if(arrVal.length > 3){
                    $('#errorModal').modal('show');
                    $('#showError').text('Hayo.. Tidak boleh membeli lebih dari 3 macam material yaa!');
                } else {
                    $('#buyModal').modal('show');
                }
            } else if (coin < total) {
                $('#errorModal').modal('show');
                $('#showError').text('Yahh... koin kelompok tidak mencukupi.');
            }
        });

        // //Kalau modal Buy diklik
        $('#buysemua').on("click", function() {
            var team_id = {{Auth::user()->team}};
            var cart = arrVal;
            $.ajax({
                type: "POST",
                url: "{{route('insertOrUpdate')}}",
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'teams_id': team_id,
                    'cart': cart
                },
                success: function(data) {
                    $('#statusModal').modal('show');
                    $('#showStatus').text(data.message);
                },
            })
        });

        $(document).on("click", ".reset", function() {
            var seq = $(this).attr('seq');
            $(".stock[seq=" + seq + "]").removeClass('red');
            $(".qty[seq=" + seq + "]").val(0);
            $(".subtotal[seq=" + seq + "]").text(0);
            var grand = 0;
            $('.subtotal').each(function() {
                grand += $(this).html() * 1;
            });
            $('.total').text(grand);
        });
    });
</script>

</html>