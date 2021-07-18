<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/app.js"></script>
</head>
<body>
    {{-- [eRHa] NavBar eRHa --}}
    <div class="navbar d-flex justify-content-between align-items-center m-3">
        <div>
            <h3>Selamat datang, {{ Auth::user()->name }}</h3>
        </div>

        <div class="logout">
            <span class="h4 fw-bold mr-4 text-dark p-2" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>

    {{-- [eRHa] Main Content --}}
    <div class="content m-3">
        <label for="team">Pilih Kelompok :</label>

        <div class="form-group">
            <select name="team" id="team" class="form-control" size="10" multiple>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <small class="text-secondary">Tahan Ctrl + Windows atau Command + Mac OS untuk memilih beberapa tim.</small>

        <br>

        {{-- [eRHa] Quest Success --}}
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#successModal">
                Berhasil
            </button>

            <!-- Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Are you sure ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Part will be added.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="questResult(true)">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        {{-- [eRHa] Status table --}}
        <div class="team-status">
            <h4><b>STATUS</b></h4>

            <table class="table table-striped">
                <tr class="table-dark">
                    <th>No.</th>
                    <th>Nama Team</th>
                    <th>Status Quest</th>
                </tr>

                @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>

                        @if ($team->quest_status)
                            <td id="table-status-team-{{ $team->id }}" class="table-status table-success">Berhasil Menyelesaikan</td>
                        @else
                            <td id="table-status-team-{{ $team->id }}" class="table-status table-danger">Belum Menyelesaikan</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
<script>
    function reloadPage() {
        location.reload();
    }

    function questResult(status) {
        const arr_team_id = [];

        for (var option of document.getElementById('team').options) {
            if (option.selected) {
                arr_team_id.push(option.value);
            }
        }

        if (arr_team_id.length == 0)
            alert("Silakan memilih team terlebih dahulu !");
        else {
            axiosServ(arr_team_id);
        }
    }

    function axiosServ(teamID) {
        const options = {
            method: 'post',
            url: '/quest-result',
            data: {
                'id_team': teamID
            },
            transformResponse: [(data) => {
                return data;
            }]
        }

        axios(options);
    }

    window.Echo.channel('roundChannel').listen('.update', (e) => {
        if (!e.action) {
            $('.table-status').text("Belum Menyelesaikan");
            $('.table-status').removeClass("table-success");
            $('.table-status').addClass("table-danger");
        }
    });

    window.Echo.channel('adminQuest').listen('.status', (e) => {
        if (e.success) {
            $.each(e.team_list, function(key, value) {
                $("#table-status-team-" + value).text("Berhasil Menyelesaikan");
                $("#table-status-team-" + value).addClass("table-success");
                $("#table-status-team-" + value).removeClass("table-danger");
            });
        }
    });
</script>
</html>
