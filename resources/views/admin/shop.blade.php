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
        <div class="logout">
            <span class="h4 fw-bold mr-4 text-dark p-2" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </header>
    <main>
        <div class="pilih">
            <div class="cboTeam">
                <label for="kelompok" style="font-weight:bold">Pilih kelompok:</label>
                <select class="form-control" id="kelompok">
                    <option value="-" id="-">--Pilih Team--</option>
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
                <button type="button" class="btn btn-primary" id="buy">Buy</button>
            </div>
        </form>
    </main>
    <!-- Modal Buy -->
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
                    <button type="button" class="btn btn-primary" onclick="location.reload();">Oke</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('document').ready(function() {
        document.getElementById('myform').reset();
        //Nonaktifkan tombol buy dan kosongkan isi koin
        document.getElementById('buy').disabled = true;
        $("select").val("-").change();
        $('.koinKelompok').text("-");
        var coin = "";
        var total = "";

        $('.stock').each(function() {
            if ($(this).text() == 0) {
                $(this).addClass('red');
            } else {
                $(this).removeClass('red');
            }
        });
        //Koin kelompok berubah ketika combo box berubah
        $('#kelompok').on('change', function(e) {
            document.getElementById('myform').reset();
            $('.stock').each(function() {
                if ($(this).text() == 0) {
                    $(this).addClass('red');
                } else {
                    $(this).removeClass('red');
                }
            });
            $('.subtotal').text(0);
            $('.total').text(0);
            coin = $(this).children(":selected").attr("id");
            $('.koinKelompok').text(coin);
            if (coin == "-") {
                $('.total').text("-");
                $('.koinKelompok').removeClass('red');
                document.getElementById('buy').disabled = true;
            } else {
                total = $('#total').text();
                if (total > coin) {
                    $('.koinKelompok').addClass('red');
                } else {
                    $('.koinKelompok').removeClass('red');
                }
                document.getElementById('buy').disabled = false;
            }
        });

        //Kalau qty berubah
        $('.qty').on('change', function() {
            coin = $('#kelompok').children(":selected").attr("id");
            var seq = $(this).attr('seq');
            var stock = parseInt($(".stock[seq=" + seq + "]").text());
            var qty = parseInt($(".qty[seq=" + seq + "]").val());

            // $('.stock').each(function() {
            //     var stock = parseInt($(this).text());
            //     if (stock < qty) {
            //         $(this).addClass('red');
            //         document.getElementById('buy').disabled = true;
            //     } else {
            //         if(stock != 0){
            //             $(this).removeClass('red');
            //         }
            //         if (coin != "-") {
            //             document.getElementById('buy').disabled = false;
            //         }
            //     }
            // });

            if (stock < qty) {
                $(".stock[seq=" + seq + "]").addClass('red');
                document.getElementById('buy').disabled = true;
            } else {
                if (stock != 0) {
                    $(".stock[seq=" + seq + "]").removeClass('red');
                }
                if (coin != "-") {
                    document.getElementById('buy').disabled = false;
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
            coin = parseInt($('#kelompok').children(":selected").attr("id"));
            total = parseInt($('#total').text());
            if (coin >= total) {
                if (total == 0) {
                    $('#errorModal').modal('show');
                    $('#showError').text('Kelompok belum membeli material sama sekali.');
                } else {
                    $('#buyModal').modal('show');
                }
                getDataTable();
            } else if (coin < total) {
                $('#errorModal').modal('show');
                $('#showError').text('Koin kelompok tidak mencukupi.');
            }
        });

        // //Kalau modal Buy diklik
        $('#buysemua').on("click", function() {
            var team_id = $('#kelompok').val();
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