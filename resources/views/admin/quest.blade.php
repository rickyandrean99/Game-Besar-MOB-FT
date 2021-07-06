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
    {{-- NavBar eRHa --}}
    <div class="mt-4 me-4" style="float: right">
        <span class="h4 fw-bold mr-4 text-dark p-2" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a></span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

    {{-- Main Content eRHa --}}
    <div class="content">
        <label for="team">Pilih Kelompok :</label>
        <select name="team" id="team" class="form-control">
            <option disabled selected>Choose one!</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>

        {{-- Quest Success --}}
        <div>
            {{-- <button type="button" class="btn btn-success" onclick="questResult(true)">
                Berhasil
            </button> --}}

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

        {{-- Quest Failed --}}
        <div>
            {{-- <button type="button" class="btn btn-danger" onclick="questResult(false)">
                Gagal
            </button> --}}

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#failedModal">
                Gagal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="failedModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="failedModalLabel">Are you sure ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Nothing will be changed.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="questResult(false)">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function questResult(status) {
        const options = {
            method: 'post',
            url: '/quest-result',
            data: {
                'id_team': $('#team').val(),
                'status': status
            },
            transformResponse: [(data) => {
                return data;
            }]
        }

        axios(options);
    }
</script>
</html>
