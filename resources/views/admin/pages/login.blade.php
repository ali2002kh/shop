<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>admin login</title>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6 m-10">
                @include('client.layouts.error')
                <form action="{{ route('admin.login') }}" method="Post">
                    @csrf
                    <div class="m-3">
                        <label for="email-or-number" class="form-label">Email or phon number</label>
                        <input type="text" class="form-control" id="email-or-number" placeholder="name@example.com or 09xxxxxxxxx" name="email-or-number" value="{{ old('email-or-number') }}" required>
                    </div>
                    <div class="m-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="m-3 d-grid">
                        <button type="submit" class="btn btn-dark m-3">login</button>
                        <a class="nav-link text-center" href="{{ route('signup_page') }}">new account</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 m-10">
                <img src="{{ asset('storage/img/shop.jpg') }}" class="img-fluid" alt="shop image">
            </div>
        </div> 
    </div>
</body>
</html>