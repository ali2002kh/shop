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
    <title>success</title>
</head>
<body>
    <div class="container my-4 d-grid" style="max-width:500px">
        <h2 class="text-center text-success display-6" style="font-size:30px">Order successfully submitted</h2>
        <i class="fa fa-check text-success text-center" style="font-size:50px"></i>
        <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
            <div class="justify-content-start">order code : </div>
            <div class="justify-content-end">{{ $order->code }}</div>
        </div>
        <a href="{{ route('order.show', $order->code) }}"class="btn btn-info mx-3 my-2">order info</a>
        <a href="{{ route('home') }}"class="btn btn-success mx-3 my-2">return to shop</a>
    </div>
</body>
</html>
