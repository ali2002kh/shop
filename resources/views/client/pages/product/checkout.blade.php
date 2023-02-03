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
    <title>checkout</title>
</head>
<body>
    <div class="container my-2 d-grid">
        <div class="row">
            <div class="col-sm-12 rounded-3 m-1">
                <p class="lead">Checkout</p>
                <hr>
            </div>
            <div class="col-sm-11 rounded-3 m-1 px-0">
            @foreach (auth()->user()->cart()->items() as $i)
                <div class="col-sm-12 my-1 d-flex">
                    <div class="container-fluid d-flex align-items-center">
                        <img class="item-img me-3" src="{{ asset('storage/product/'.$i->product()->image()) }}" alt="">
                        <div class="d-grid">
                            <p class="lead mb-1">{{ $i->product()->name }}</p>
                            <p class="text-muted mb-1">{{ $i->product()->price }} toman</p>
                        </div>
                    </div>
                    <div class="d-grid justify-content-end align-items-center w-100">
                        <p class="text-muted m-2 text-center">{{ $i->product()->price * $i->count }} toman</p>
                        <hr class="my-0">
                        <p class="text-muted m-2 text-center">count : {{ $i->count }}</p>
                    </div>
                </div>
                <br>
            @endforeach
            </div>

            <div class="col-sm-6 rounded-3 m-1 px-0">
                @include('client.layouts.error')
                <form id="buy-form" action="{{ route('buy') }}" method="Post">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center m-1">
                        <select class="form-select form-select-lg m-1 text-muted"  style="font-size:16px" name="province" id="province" value="{{ old('province') }}">
                            <option value="">province</option>
                            @foreach ($provinces as $v)
                                @if (old('province')==$v->id)
                                <option selected value="{{ $v->id }}">
                                    {{ $v->name }}
                                </option>
                                @else
                                <option value="{{ $v->id }}">
                                    {{ $v->name }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <select name="city" class="form-select form-select-lg m-1 text-muted"  style="font-size:16px" required id="city">
                            <option value="">city</option>
                        </select>
                    </div>
                    <div class="m-1">
                        <label for="zip_code" class="form-label">zip code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}"  required>
                    </div>
                    <div class="m-1">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"  required>
                    </div>
                    <div class="m-1">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}"  required>
                    </div>
                </form>
            </div>

            <div class="col-sm-5 rounded-3 m-1">
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Cart total price : </div>
                    <div class="justify-content-end">{{ auth()->user()->cart()->totalPrice() }} toman</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Tax (9%) : </div>
                    <div class="justify-content-end">{{ auth()->user()->cart()->totalPrice()*9/100 }} toman</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Shipping cost : </div>
                    <div class="justify-content-end">30000 toman</div>
                </div>
                <hr class="m-2">
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Payment amount : </div>
                    <div class="justify-content-end">{{ auth()->user()->cart()->totalPrice()*109/100 + 30000 }} toman</div>
                </div>
                <div class="m-1 d-grid">
                    <button id="submit-button" type="button" class="btn btn-dark m-3">Pay</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#province').on('change', function() {
            var provinceId = this.value;
            $('#city').html('city');
            $.ajax({
                url: '{{ route('getCities') }}?province_id=' + provinceId,
                type: 'get',
                success: function(res) {
                    $('#city').html('<option value="">city </option>');
                    $.each(res, function(key, value) {
                        $('#city').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

        $("#submit-button").click(function(){        
            $("#buy-form").submit();
        });
    });
</script>

</html>

<style>
    .item-img {
        width : 80px;
        height: 80px;
        border-radius: 10px;
    }
</style>