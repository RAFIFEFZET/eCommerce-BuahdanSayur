@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Name<sup>*</sup></label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" @readonly(true)>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control" value="{{ Auth::user()->address1 }}" @readonly(true)>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Province<sup>*</sup></label>
                        <select class="form-control" id="province">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <select class="form-select" id="city">
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $cart)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{ $cart->product->image1_url }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{ $cart->product->product_name }}</td>
                                        <td class="py-5">
                                            @if($cart->product->discounts->isNotEmpty() && $cart->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                                                @php
                                                    $discountedPrice = $cart->product->price - ($cart->product->price * ($cart->product->discounts->first()->percentage / 100));
                                                @endphp
                                                <span class="text-danger text-decoration-line-through">Rp. {{ number_format($cart->product->price, 0, ',', '.') }}/Kg</span>
                                                <span class="fw-bold me-2">Rp. {{ number_format($discountedPrice, 0, ',', '.') }}/Kg</span>
                                                <div class="d-flex justify-content-between align-items-center position-absolute" style="top: 10px; right: 10px;">
                                                    <div class="text-white bg-secondary px-3 py-1 rounded">{{ $cart->product->discounts->first()->percentage }}% off</div>
                                                </div>
                                            @else
                                                Rp. {{ number_format($cart->product->price, 0, ',', '.') }}/Kg
                                            @endif
                                        </td>
                                        <td class="py-5">{{ $cart->quantity }}</td>
                                        <td class="py-5">
                                            @if($cart->product->discounts->isNotEmpty() && $cart->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                                                @php
                                                    $discountedPrice = $cart->product->price - ($cart->product->price * ($cart->product->discounts->first()->percentage / 100));
                                                    $totalPrice = $cart->quantity * $discountedPrice;
                                                @endphp
                                                Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                                            @else
                                                Rp. {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $subtotal = 0;
                                @endphp

                                @foreach($cartItems as $cart)
                                    @if($cart->product->discounts->isNotEmpty() && $cart->product->discounts->first()->end_date > now()->timezone('Asia/Jakarta'))
                                        @php
                                            $discountedPrice = $cart->product->price - ($cart->product->price * ($cart->product->discounts->first()->percentage / 100));
                                            $subtotal += $cart->quantity * $discountedPrice;
                                        @endphp
                                    @else
                                        @php
                                            $subtotal += $cart->quantity * $cart->product->price;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">Rp. {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping Cost</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark" id="shipping-cost">Rp. 0</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p id="total-price" class="mb-0 text-dark">Rp. {{ $subtotal }}</p>
                                            <input type="hidden" id="total-price-input" name="total_price" value="{{ $subtotal }}">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Store the subtotal in a variable
        var subtotal = parseInt(document.getElementById('total-price').innerText.replace(/[^0-9]/g, ''));

        // Event listener for province selection
        document.getElementById('province').addEventListener('change', function() {
            var provinceId = this.value;
            fetch('/get-city?province_id=' + provinceId)
                .then(response => response.json())
                .then(data => {
                    var cityDropdown = document.getElementById('city');
                    cityDropdown.innerHTML = '<option value="">Pilih Kota</option>';
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        data.forEach(city => {
                            var option = document.createElement('option');
                            option.value = city.city_id;
                            option.text = city.type + ' ' + city.city_name;
                            cityDropdown.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                });
        });

        // Event listener for city selection
        document.getElementById('city').addEventListener('change', function() {
            var cityId = this.value;
            fetch('/get-shipping-cost?city_id=' + cityId)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        console.error('No shipping cost data found');
                        return;
                    }

                    var shippingCost = data[0].cost[0].value;
                    if (isNaN(shippingCost)) {
                        console.error('Invalid shipping cost');
                        return;
                    }

                    // Update the shipping cost
                    document.getElementById('shipping-cost').innerText = 'Biaya Ongkir: Rp ' + shippingCost.toLocaleString();

                    // Calculate the total price by adding the subtotal and the shipping cost
                    var totalPrice = subtotal + shippingCost;

                    // Update the total price text
                    document.getElementById('total-price').innerText = 'Rp ' + totalPrice.toLocaleString();

                    // Update the hidden total price input value
                    document.getElementById('total-price-input').value = totalPrice;
                })
                .catch(error => {
                    console.error('Error fetching shipping cost:', error);
                });
        });
    });
</script>
<!-- Checkout Page End -->
@section('footer')
    @include('dashboard.footer')
@endsection
