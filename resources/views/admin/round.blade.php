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

        <div class="round ms-5 mt-5">{{ $round->round }}</div>

        <script>
            // [RICKY] Event untuk update ke ronde selanjutnya dengan aksi preparation
            $(document).on('click', '#btn-update', function(e) {
                e.preventDefault();

                const options = {
                    method: 'post',
                    url: '/update-round',
                    data: {},
                    transformResponse: [(data) => {
                        alert('Berhasil Update Ronde');
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
                        alert('Berhasil Update Sesi');
                        return data;
                    }]
                }

                axios(options);
            });
        </script>
    </body>
</html>