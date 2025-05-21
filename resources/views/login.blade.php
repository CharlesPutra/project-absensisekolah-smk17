<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="img/smk17.png">
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <div>
        {{-- img  --}}
        <div class="mt-4">
            <img src="img/smk17.png" class="rounded mx-auto d-block img-fluid" style="width: 50px; height: 50px;"
                alt="...">
        </div>
        {{-- card form --}}
        <div class="d-flex justify-content-center mt-5">
            <div class="card w-50 text-center">
                <div class="card-header bg-primary text-white fw-bold">
                    Login Web App Absensi
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                              <label for="name" class="col-form-label">Username:</label>
                            </div>
                            <div>
                                <input type="text" id="name" name="name" class="form-control" aria-describedby="passwordHelpBlock">
                            </div>
                          </div><br>    
                          <div class="row g-3 align-items-center">
                            <div class="col-auto">
                              <label for="password" class="col-form-label">Password:</label>
                            </div>
                            <div>
                              <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-2">Login</button>   
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- Link ke Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
