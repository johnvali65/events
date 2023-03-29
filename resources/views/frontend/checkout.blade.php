@extends('frontend.master', ['activePage' => 'checkout'])
<style>
    .container {
        max-width: 1299px !important;
    }
</style>
@section('content')

    @include('frontend.layout.breadcrumbs', [
        'title' => __('Checkout'),
        'page' => __('Checkout'),
    ])

    <section class="property-single nav-arrow-b">
        <div class="container">
            <input type="hidden" id="razor_key" name="razor_key"
                value="{{ \App\Models\PaymentSetting::find(1)->razorPublishKey }}">
            <input type="hidden" id="stripePublicKey" name="stripePublicKey"
                value="{{ \App\Models\PaymentSetting::find(1)->stripePublicKey }}">

            <form action="{{ url('createOrder') }}" id="checkout" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body single-ticket">
                                <h5 class="mb-4">{{ __('Additional info and quantity') }}</h5>
                                <div class="quantity-section text-center mb-4">
                                    <p class="mb-1">{{ __('Quantity') }}</p>
                                    <input type="hidden" value="{{ $data->ticket_per_order }}" name="tpo"
                                        id="tpo">
                                    <input type="hidden" value="{{ $data->available_qty }}" name="available"
                                        id="available">
                                    <div class="quantity">
                                        <div class="pro-qty mt-3">
                                            <input type="hidden" id="quantity" value="1">
                                            <span class="dec qtybtn" id="dec-{{ $data->id }}">-</span>
                                            <input type="number" readonly name="quantity" value="1">
                                            <span class="inc qtybtn" id="inc-{{ $data->id }}">+</span>
                                        </div>
                                    </div>
                                </div>
                                <article class="ticket mb-4">
                                    <header class="ticket__wrapper">
                                        <div class="ticket__header">
                                            <span>{{ $data->ticket_number }} - {{ Str::upper($data->category) }}</span>

                                        </div>
                                    </header>
                                    <div class="ticket__divider">
                                        <div class="ticket__notch"></div>
                                        <div class="ticket__notch ticket__notch--right"></div>
                                    </div>
                                    <div class="ticket__body">
                                        <section class="ticket__section">
                                            <h3>{{ $data->name }}</h3>
                                            <p>{{ $data->description }}</p>
                                        </section>
                                        <section class="ticket__section">
                                            @if ($data->type == 'free')
                                                <h2>{{ __('Free') }}</h2>
                                            @else
                                                <h3>{{ $currency . $data->price }}</h3>
                                            @endif
                                        </section>
                                        <section class="ticket__section">
                                            <h3>{{ __('Sales') }}</h3>
                                            <p class="mb-0"><span>{{ __('Start') }} :
                                                </span>{{ $data->start_time->format('Y-m-d h:i a') }}</p>
                                            <p class="mb-0"><span>{{ __('end') }} :
                                                </span>{{ $data->end_time->format('Y-m-d h:i a') }}</p>
                                            <p><span>{{ __('Quantity') }} :
                                                </span>{{ $data->available_qty . ' pcs left' }}
                                            </p>
                                        </section>
                                    </div>
                                </article>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="price" id="ticket_price" value="{{ $data->price }}">
                    <input type="hidden" name="tax" id="tax_total"
                        value="{{ $data->type == 'free' ? 0 : $data->tax_total }}">
                    @php
                        $price = $data->price;
                        if ($data->currency_code == 'USD' || $data->currency_code == 'EUR') {
                            $price = $data->price * 100;
                        }
                    @endphp
                    <input type="hidden" name="payment"
                        id="payment"value="{{ $data->type == 'free' ? 0 : $price + $data->tax_total }}">
                    <input type="hidden" name="stripe_payment"
                        id="stripe_payment"value="{{ $data->type == 'free' ? 0 : $price + $data->tax_total }}">
                    <input type="hidden" name="currency_code" id="currency_code" value="{{ $data->currency_code }}">
                    <input type="hidden" name="payment_token" id="payment_token">
                    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $data->id }}">
                    <input type="hidden" name="coupon_id" id="coupon_id" value="">
                    <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                    <input type="hidden" name="category" id="category" value="{{ $data->category }}">

                    <div class="col-lg-5">
                        <div class="card checkout-right mb-4">
                            <img src="{{ url('images/upload/' . $data->event->image) }}">
                            <div class="card-body">
                                <div class="event-top text-center">
                                    <h5>{{ $data->event->name }}</h5>
                                    @if ($data->event->type == 'online')
                                        <p>{{ __('Online Event') }}</p>
                                    @else
                                        <p>{{ $data->event->address }}</p>
                                    @endif
                                </div>
                                <div class="event-middle">
                                    <div class="middle">
                                        <p><span>{{ $data->name }}</span> </p>
                                        <p>
                                            @if ($data->type == 'free')
                                                <span>{{ __('FREE') }}</span>
                                            @else
                                                <span class="qty">1</span>
                                                <span class="px-2"> *</span>
                                                <span class="price">{{ $data->price }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if ($data->type == 'paid')
                                        <input type="hidden" name="tax_data" value="{{ $data->tax }}">
                                        @foreach ($data->tax as $item)
                                            <div class="middle">
                                                <p><span>{{ $item->name }}</span> </p>
                                                <p>
                                                    <span class=""></span>
                                                    <span class="px-2"></span>
                                                    <span class="">(+) {{ $item->price }}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="coupon-section mb-2 mt-3">
                                    <div class="coupon-data">
                                        <span>{{ __('You have coupon to use') }}</span>
                                        <span class="btn-apply">{{ __('Apply') }} </span>
                                    </div>
                                </div>
                                <div class="event-total">
                                    <p class="mb-0"><span>{{ __('Total') }}</span></p>
                                    @if ($data->type == 'free')
                                        <p class="mb-0"><span>{{ $currency }}0.00</span></p>
                                    @else
                                        <p class="mb-0"><span
                                                class="total">{{ $currency . ($data->price + $data->tax_total) }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <?php $setting = App\Models\PaymentSetting::find(1); ?>

                        <div class="card checkout-right">
                            <div class="card-body">
                                <h5 class="mb-4"> {{ __('Choose Payment') }}</h5>
                                <div class="payments">
                                    @if ($data->type == 'free')
                                        <label class="chk-container">{{ __('FREE') }}
                                            <input type="radio" name="payment_type" value="FREE" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    @else
                                        @if ($setting->paypal == 1)
                                            <label class="chk-container">{{ __('Paypal') }}
                                                <input type="radio" name="payment_type" value="PAYPAL">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                        @if ($setting->razor == 1)
                                            <label class="chk-container">{{ __('Razorpay') }}
                                                <input type="radio" name="payment_type" value="RAZOR">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                        @if ($setting->stripe == 1)
                                            <label class="chk-container">{{ __('Stripe') }}
                                                <input type="radio" name="payment_type" value="STRIPE">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                        @if ($setting->flutterwave == 1)
                                            <label class="chk-container">{{ __('Flutterwave') }}
                                                <input type="radio" name="payment_type" value="FLUTTERWAVE">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                        @if (
                                            $setting->cod == 1 ||
                                                ($setting->flutterwave == 0 && $setting->stripe == 0 && $setting->paypal == 0 && $setting->razor == 0))
                                            <label class="chk-container">{{ __('Cash On Delivery') }}
                                                <input type="radio" name="payment_type" value="LOCAL" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif

                                        <div class="paypal-button-section hide mt-4">
                                            <div id="paypal-button-container"> </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-lg-12">
                        <div class="mobile-view">
                            <!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="utf-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="description" content="">
                                <meta name="author" content="">
                                <meta name="viewport"
                                    content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
                                <title>Screen</title>
                                <link rel="stylesheet" href="{{ asset('layout/css/bootstrap.min.css') }}">
                                <link rel="stylesheet" href="{{ asset('layout/css/style.css') }}">
                            </head>

                            <body>
                                <section>
                                    <?php
                                    // Silver Left
                                    $sa = ['5', '4', '3', '2', '1'];
                                    $sb = ['15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sc = ['16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sd = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $se = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sf = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sg = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sh = ['20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $si = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sj = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sk = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sl = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sm = ['13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sn = ['13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    
                                    // VIP & Gold
                                    $vip_a = ['16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_a_right = ['16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_b = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_b_right = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_c = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_c_right = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_d = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_d_right = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_e = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_e_right = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_f = ['20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_f_right = ['20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_g = ['21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_g_right = ['21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_h = ['21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_h_right = ['21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_i = ['22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_i_right = ['22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_j = ['23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_j_right = ['23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_k = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_k_right = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_l = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_l_right = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_m = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_m_right = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_n = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_n_right = ['7', '6', '5', '4', '3', '2', '1'];
                                    $vip_o = ['24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $vip_o_right = ['5', '4', '3', '2', '1'];
                                    
                                    // Silver Right
                                    $sra = ['5', '4', '3', '2', '1'];
                                    $srb = ['15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $src = ['16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srd = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sre = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srf = ['17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srg = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srh = ['20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $sri = ['18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srj = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srk = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srl = ['19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srm = ['13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    $srn = ['13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
                                    ?>
                                    
                                    <div class="container-fluid custom-container">
                                        <div class="logo-sec">
                                            <img src="{{ asset('layout/images/logo.svg') }}" class="logo" />
                                        </div>
                                        <img src="{{ asset('layout/images/stage.png') }}" class="stage" />
                                        <img src="{{ asset('layout/images/stage-mobile.png') }}" class="stage-mobile" />
                                        <div class="row">
                                            <div class="col-md-3 col-3">
                                                <div class="silver-sec">
                                                    <h1 class="text-center">SILVER</h1>
                                                    <!-- A Silver -->
                                                    <div class="A silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p style="color:#212529">A</p>
                                                                </li>
                                                                @foreach ($sa as $a)
                                                                    <li class="seat">
                                                                        <input class="silver" type="checkbox"
                                                                            id="SA{{ $a }}" value="SA{{ $a }}"/>
                                                                        <label class="@if(in_array('SA'.$a, $data->silver_booked_seats))booked @endif" for="SA{{ $a }}">{{ $a }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- B Silver -->
                                                    <div class="B silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>B</p>
                                                                </li>
                                                                @foreach ($sb as $b)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SB{{ $b }}" value="SB{{ $b }}"/>
                                                                        <label class="@if(in_array('SB'.$b, $data->silver_booked_seats))booked @endif" for="SB{{ $b }}">{{ $b }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- C Silver -->
                                                    <div class="C silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>C</p>
                                                                </li>
                                                                @foreach ($sc as $c)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SC{{ $c }}" value="SC{{ $c }}"/>
                                                                        <label class="@if(in_array('SC'.$c, $data->silver_booked_seats))booked @endif" for="SC{{ $c }}">{{ $c }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- D Silver -->
                                                    <div class="D silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>D</p>
                                                                </li>
                                                                @foreach ($sd as $d)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SD{{ $d }}" value="SD{{ $d }}"/>
                                                                        <label class="@if(in_array('SD'.$d, $data->silver_booked_seats))booked @endif" for="SD{{ $d }}">{{ $d }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- E Silver -->
                                                    <div class="E silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>E</p>
                                                                </li>
                                                                @foreach ($se as $e)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SE{{ $e }}" value="SE{{ $e }}"/>
                                                                        <label class="@if(in_array('SE'.$e, $data->silver_booked_seats))booked @endif" for="SE{{ $e }}">{{ $e }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- F Silver -->
                                                    <div class="F silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>F</p>
                                                                </li>
                                                                @foreach ($sf as $f)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SF{{ $f }}" value="SF{{ $f }}"/>
                                                                        <label class="@if(in_array('SF'.$f, $data->silver_booked_seats))booked @endif" for="SF{{ $f }}">{{ $f }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- G Silver -->
                                                    <div class="G silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>G</p>
                                                                </li>
                                                                @foreach ($sg as $g)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SG{{ $g }}" value="SG{{ $g }}"/>
                                                                        <label class="@if(in_array('SG'.$g, $data->silver_booked_seats))booked @endif" for="SG{{ $g }}">{{ $g }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- H Silver -->
                                                    <div class="H silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>H</p>
                                                                </li>
                                                                @foreach ($sh as $h)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SH{{ $h }}" value="SH{{ $h }}"/>
                                                                        <label class="@if(in_array('SH'.$h, $data->silver_booked_seats))booked @endif" for="SH{{ $h }}">{{ $h }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- I Silver -->
                                                    <div class="I silver">
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>I</p>
                                                                </li>
                                                                @foreach ($si as $i)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SI{{ $i }}" value="SI{{ $i }}"/>
                                                                        <label class="@if(in_array('SI'.$i, $data->silver_booked_seats))booked @endif" for="SI{{ $i }}">{{ $i }}</label>
                                                                    </li>
                                                                    @if ($i == 13)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- J Silver -->
                                                    <div class="J silver">
                                                        <div class="left">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>J</p>
                                                                </li>
                                                                @foreach ($sj as $j)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SJ{{ $j }}" value="SJ{{ $j }}"/>
                                                                        <label class="@if(in_array('SJ'.$j, $data->silver_booked_seats))booked @endif" for="SJ{{ $j }}">{{ $j }}</label>
                                                                    </li>
                                                                    @if ($j == 14)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- K Silver -->
                                                    <div class="K silver">
                                                        <div class="left">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>K</p>
                                                                </li>
                                                                @foreach ($sk as $k)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SK{{ $k }}" value="SK{{ $k }}"/>
                                                                        <label class="@if(in_array('SK'.$k, $data->silver_booked_seats))booked @endif" for="SK{{ $k }}">{{ $k }}</label>
                                                                    </li>
                                                                    @if ($k == 14)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- L Silver -->
                                                    <div class="L silver">
                                                        <div class="left">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>L</p>
                                                                </li>
                                                                @foreach ($sl as $l)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SL{{ $l }}" value="SL{{ $l }}"/>
                                                                        <label class="@if(in_array('SL'.$l, $data->silver_booked_seats))booked @endif" for="SL{{ $l }}">{{ $l }}</label>
                                                                    </li>
                                                                    @if ($l == 14)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- M Silver -->
                                                    <div class="M silver">
                                                        <div class="left">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>M</p>
                                                                </li>
                                                                <li class="seat">
                                                                    <span style="width:108px"></span>
                                                                </li>
                                                                @foreach ($sm as $m)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SM{{ $m }}" value="SM{{ $m }}"/>
                                                                        <label class="@if(in_array('SM'.$m, $data->silver_booked_seats))booked @endif" for="SM{{ $m }}">{{ $m }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- N Silver -->
                                                    <div class="N silver">
                                                        <div class="left">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>N</p>
                                                                </li>
                                                                <li class="seat">
                                                                    <span style="width:108px"></span>
                                                                </li>
                                                                @foreach ($sn as $n)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SN{{ $n }}" value="SN{{ $n }}"/>
                                                                        <label class="@if(in_array('SN'.$n, $data->silver_booked_seats))booked @endif" for="SN{{ $n }}">{{ $n }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- VIP & GOLD Start -->
                                            <div class="col-md-6 col-6 mid-sec">
                                                <div class="vip-sec">
                                                    <h1 class="text-center">VIP</h1>
                                                    <!-- A Red VIP -->
                                                    <div class="A red">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_a as $a)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="A{{ $a }}" value="A{{ $a }}"/>
                                                                        <label class="@if(in_array('A'.$a, $data->vip_booked_seats))booked @endif" for="A{{ $a }}">{{ $a }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p style="color:#212529">A</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p style="color:#212529">A</p>
                                                                </li>
                                                                @foreach ($vip_a_right as $a)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="AR{{ $a }}" value="AR{{ $a }}"/>
                                                                        <label class="@if(in_array('AR'.$a, $data->vip_booked_seats))booked @endif" for="AR{{ $a }}">{{ $a }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- B Red VIP -->
                                                    <div class="B red">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_b as $b)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="B{{ $b }}" value="B{{ $b }}"/>
                                                                        <label class="@if(in_array('B'.$b, $data->vip_booked_seats))booked @endif"
                                                                            for="B{{ $b }}">{{ $b }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>B</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>B</p>
                                                                </li>
                                                                @foreach ($vip_b_right as $b)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="BR{{ $b }}" value="BR{{ $b }}"/>
                                                                        <label class="@if(in_array('BR'.$b, $data->vip_booked_seats))booked @endif"
                                                                            for="BR{{ $b }}">{{ $b }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- C Red VIP -->
                                                    <div class="C red">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_c as $c)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="C{{ $c }}" value="C{{ $c }}" />
                                                                        <label class="@if(in_array('C'.$c, $data->vip_booked_seats))booked @endif"
                                                                            for="C{{ $c }}">{{ $c }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>C</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>C</p>
                                                                </li>
                                                                @foreach ($vip_c_right as $c)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="CR{{ $c }}" value="CR{{ $c }}"/>
                                                                        <label class="@if(in_array('CR'.$c, $data->vip_booked_seats))booked @endif"
                                                                            for="CR{{ $c }}">{{ $c }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- D Red VIP -->
                                                    <div class="D red">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_d as $d)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="D{{ $d }}" value="D{{ $d }}"/>
                                                                        <label class="@if(in_array('D'.$d, $data->vip_booked_seats))booked @endif"
                                                                            for="D{{ $d }}">{{ $d }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>D</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>D</p>
                                                                </li>
                                                                @foreach ($vip_d as $d)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="DR{{ $d }}" value="DR{{ $d }}"/>
                                                                        <label class="@if(in_array('DR'.$d, $data->vip_booked_seats))booked @endif"
                                                                            for="DR{{ $d }}">{{ $d }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- E Red VIP -->
                                                    <div class="E red">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_e as $e)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="E{{ $e }}" value="E{{ $e }}"/>
                                                                        <label class="@if(in_array('E'.$e, $data->vip_booked_seats))booked @endif"
                                                                            for="E{{ $e }}">{{ $e }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>E</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>E</p>
                                                                </li>
                                                                @foreach ($vip_e_right as $e)
                                                                    <li class="seat">
                                                                        <input class="vip" name="seats[]" type="checkbox"
                                                                            id="ER{{ $e }}" value="ER{{ $e }}"/>
                                                                        <label class="@if(in_array('ER'.$e, $data->vip_booked_seats))booked @endif"
                                                                            for="ER{{ $e }}">{{ $e }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- F Yellow GOLD -->
                                                    <div class="F yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_f as $f)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="F{{ $f }}" value="F{{ $f }}"/>
                                                                        <label class="@if(in_array('F'.$f, $data->gold_booked_seats))booked @endif" 
                                                                            for="F{{ $f }}">{{ $f }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>F</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>F</p>
                                                                </li>
                                                                @foreach ($vip_f_right as $f)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="FR{{ $f }}" value="FR{{ $f }}"/>
                                                                        <label class="@if(in_array('FR'.$f, $data->gold_booked_seats))booked @endif"
                                                                            for="FR{{ $f }}">{{ $f }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- G Yellow GOLD -->
                                                    <div class="G yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_g as $g)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="G{{ $g }}" value="G{{ $g }}"/>
                                                                        <label class="@if(in_array('G'.$g, $data->gold_booked_seats))booked @endif"
                                                                            for="G{{ $g }}">{{ $g }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>G</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>G</p>
                                                                </li>
                                                                @foreach ($vip_g_right as $g)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="GR{{ $g }}" value="GR{{ $g }}"/>
                                                                        <label class="@if(in_array('GR'.$g, $data->gold_booked_seats))booked @endif"
                                                                            for="GR{{ $g }}">{{ $g }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- H Yellow GOLD -->
                                                    <div class="H yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_h as $h)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="H{{ $h }}" value="H{{ $h }}"/>
                                                                        <label class="@if(in_array('H'.$h, $data->gold_booked_seats))booked @endif"
                                                                            for="H{{ $h }}">{{ $h }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>H</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>H</p>
                                                                </li>
                                                                @foreach ($vip_h_right as $h)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="HR{{ $h }}" value="HR{{ $h }}"/>
                                                                        <label class="@if(in_array('HR'.$h, $data->gold_booked_seats))booked @endif"
                                                                            for="HR{{ $h }}">{{ $h }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- I Yellow GOLD -->
                                                    <div class="I yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_i as $i)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="I{{ $i }}" value="I{{ $i }}"/>
                                                                        <label class="@if(in_array('I'.$i, $data->gold_booked_seats))booked @endif"
                                                                            for="I{{ $i }}">{{ $i }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>I</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>I</p>
                                                                </li>
                                                                @foreach ($vip_i_right as $i)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="IR{{ $i }}" value="IR{{ $i }}"/>
                                                                        <label class="@if(in_array('IR'.$i, $data->gold_booked_seats))booked @endif"
                                                                            for="IR{{ $i }}">{{ $i }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- J Yellow GOLD -->
                                                    <div class="J yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_j as $j)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="J{{ $j }}" value="J{{ $j }}"/>
                                                                        <label class="@if(in_array('J'.$j, $data->gold_booked_seats))booked @endif"
                                                                            for="J{{ $j }}">{{ $j }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>J</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>J</p>
                                                                </li>
                                                                @foreach ($vip_j_right as $j)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="JR{{ $j }}" value="JR{{ $j }}"/>
                                                                        <label class="@if(in_array('JR'.$j, $data->gold_booked_seats))booked @endif"
                                                                            for="JR{{ $j }}">{{ $j }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- K Yellow GOLD -->
                                                    <div class="K yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_k as $k)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="K{{ $k }}" value="K{{ $k }}"/>
                                                                        <label class="@if(in_array('K'.$k, $data->gold_booked_seats))booked @endif"
                                                                            for="K{{ $k }}">{{ $k }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>K</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>K</p>
                                                                </li>
                                                                @foreach ($vip_k_right as $k)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="KR{{ $k }}" value="KR{{ $k }}"/>
                                                                        <label class="@if(in_array('KR'.$k, $data->gold_booked_seats))booked @endif"
                                                                            for="KR{{ $k }}">{{ $k }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- L Yellow GOLD -->
                                                    <div class="L yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_l as $l)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="L{{ $l }}" value="L{{ $l }}"/>
                                                                        <label class="@if(in_array('L'.$l, $data->gold_booked_seats))booked @endif"
                                                                            for="L{{ $l }}">{{ $l }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>L</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>L</p>
                                                                </li>
                                                                @foreach ($vip_l_right as $l)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="LR{{ $l }}" value="LR{{ $l }}"/>
                                                                        <label class="@if(in_array('LR'.$l, $data->gold_booked_seats))booked @endif"
                                                                            for="LR{{ $l }}">{{ $l }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- M Yellow GOLD -->
                                                    <div class="M yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_m as $m)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="M{{ $m }}" value="M{{ $m }}"/>
                                                                        <label class="@if(in_array('M'.$m, $data->gold_booked_seats))booked @endif"
                                                                            for="M{{ $m }}">{{ $m }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>M</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>M</p>
                                                                </li>
                                                                @foreach ($vip_m_right as $m)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="MR{{ $m }}" value="MR{{ $m }}"/>
                                                                        <label class="@if(in_array('MR'.$m, $data->gold_booked_seats))booked @endif"
                                                                            for="MR{{ $m }}">{{ $m }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- N Yellow GOLD -->
                                                    <div class="N yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_n as $n)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="N{{ $n }}" value="N{{ $n }}"/>
                                                                        <label class="@if(in_array('N'.$n, $data->gold_booked_seats))booked @endif"
                                                                            for="N{{ $n }}">{{ $n }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>N</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>N</p>
                                                                </li>
                                                                @foreach ($vip_n_right as $n)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="NR{{ $n }}" value="NR{{ $n }}"/>
                                                                        <label class="@if(in_array('NR'.$n, $data->gold_booked_seats))booked @endif"
                                                                            for="NR{{ $n }}">{{ $n }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- O Yellow GOLD -->
                                                    <div class="O yellow">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($vip_o as $o)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="O{{ $o }}" value="O{{ $o }}"/>
                                                                        <label class="@if(in_array('O'.$o, $data->gold_booked_seats))booked @endif"
                                                                            for="O{{ $o }}">{{ $o }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>O</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="right">
                                                            <ol class="seats-right">
                                                                <li class="seat">
                                                                    <p>O</p>
                                                                </li>
                                                                @foreach ($vip_o_right as $o)
                                                                    <li class="seat">
                                                                        <input class="gold" name="seats[]" type="checkbox"
                                                                            id="OR{{ $o }}" value="OR{{ $o }}"/>
                                                                        <label class="@if(in_array('OR'.$o, $data->gold_booked_seats))booked @endif"
                                                                            for="OR{{ $o }}">{{ $o }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                            <div class="light-desk">
                                                                <p>Light & Sound Desk</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h2 class="text-center gold">GOLD</h2>
                                                </div>
                                            </div>
                                            <!-- VIP & GOLD End -->
                                            <!-- Silver Right -->
                                            <div class="col-md-3 col-3 right-sec">
                                                <div class="silver-sec-right">
                                                    <h1 class="text-center">SILVER</h1>
                                                    <!-- A Silver -->
                                                    <div class="A silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($sra as $a)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRA{{ $a }}" value="SRA{{ $a }}"/>
                                                                        <label class="@if(in_array('SRA'.$a, $data->silver_booked_seats))booked @endif" for="SRA{{ $a }}">{{ $a }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p style="color:#212529">A</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- B Silver -->
                                                    <div class="B silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($srb as $b)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRB{{ $b }}" value="SRB{{ $b }}"/>
                                                                        <label class="@if(in_array('SRB'.$b, $data->silver_booked_seats))booked @endif" for="SRB{{ $b }}">{{ $b }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>B</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- C Silver -->
                                                    <div class="C silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($src as $c)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRC{{ $c }}" value="SRC{{ $c }}"/>
                                                                        <label class="@if(in_array('SRC'.$c, $data->silver_booked_seats))booked @endif" for="SRC{{ $c }}">{{ $c }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>C</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- D Silver -->
                                                    <div class="D silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($srd as $d)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRD{{ $d }}" value="SRD{{ $d }}"/>
                                                                        <label class="@if(in_array('SRD'.$d, $data->silver_booked_seats))booked @endif" for="SRD{{ $d }}">{{ $d }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>D</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- E Silver -->
                                                    <div class="E silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($sre as $e)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRE{{ $e }}" value="SRE{{ $e }}"/>
                                                                        <label class="@if(in_array('SRE'.$e, $data->silver_booked_seats))booked @endif" for="SRE{{ $e }}">{{ $e }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>E</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- F Silver -->
                                                    <div class="F silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($srf as $f)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRF{{ $f }}" value="SRF{{ $f }}"/>
                                                                        <label class="@if(in_array('SRF'.$f, $data->silver_booked_seats))booked @endif" for="SRF{{ $f }}">{{ $f }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>F</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- G Silver -->
                                                    <div class="G silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($srg as $g)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRG{{ $g }}" value="SRG{{ $g }}"/>
                                                                        <label class="@if(in_array('SRG'.$g, $data->silver_booked_seats))booked @endif" for="SRG{{ $g }}">{{ $g }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>G</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- H Silver -->
                                                    <div class="H silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($srh as $h)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRH{{ $h }}" value="SRH{{ $h }}"/>
                                                                        <label class="@if(in_array('SRH'.$h, $data->silver_booked_seats))booked @endif" for="SRH{{ $h }}">{{ $h }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>H</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- I Silver -->
                                                    <div class="I silver">
                                                        <div class="right">
                                                            <ol class="seats-left">
                                                                @foreach ($sri as $i)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRI{{ $i }}" value="SRI{{ $i }}"/>
                                                                        <label class="@if(in_array('SRI'.$i, $data->silver_booked_seats))booked @endif" for="SRI{{ $i }}">{{ $i }}</label>
                                                                    </li>
                                                                    @if ($i == 7)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>I</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- J Silver -->
                                                    <div class="J silver">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($srj as $j)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRJ{{ $j }}" value="SRJ{{ $j }}"/>
                                                                        <label class="@if(in_array('SRJ'.$j, $data->silver_booked_seats))booked @endif" for="SRJ{{ $j }}">{{ $j }}</label>
                                                                    </li>
                                                                    @if ($j == 7)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>J</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- K Silver -->
                                                    <div class="K silver">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($srk as $k)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRK{{ $k }}" value="SRK{{ $k }}"/>
                                                                        <label class="@if(in_array('SRK'.$k, $data->silver_booked_seats))booked @endif" for="SRK{{ $k }}">{{ $k }}</label>
                                                                    </li>
                                                                    @if ($k == 7)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>K</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- L Silver -->
                                                    <div class="L silver">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($srl as $l)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRL{{ $l }}" value="SRL{{ $l }}"/>
                                                                        <label class="@if(in_array('SRL'.$l, $data->silver_booked_seats))booked @endif" for="SRL{{ $l }}">{{ $l }}</label>
                                                                    </li>
                                                                    @if ($l == 7)
                                                                        <li class="seat">
                                                                            <span style="width:35px"></span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="seat">
                                                                    <p>L</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- M Silver -->
                                                    <div class="M silver">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($srm as $m)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRM{{ $m }}" value="SRM{{ $m }}"/>
                                                                        <label class="@if(in_array('SRM'.$m, $data->silver_booked_seats))booked @endif" for="SRM{{ $m }}" >{{ $m }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <span style="width:108px"></span>
                                                                </li>
                                                                <li class="seat">
                                                                    <p>M</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <!-- N Silver -->
                                                    <div class="N silver">
                                                        <div class="left">
                                                            <ol class="seats-left">
                                                                @foreach ($srn as $n)
                                                                    <li class="seat">
                                                                        <input class="silver" name="seats[]" type="checkbox"
                                                                            id="SRN{{ $n }}" value="SRN{{ $n }}" />
                                                                        <label class="@if(in_array('SRN'.$n, $data->silver_booked_seats))booked @endif" for="SRN{{ $n }}">{{ $n }}</label>
                                                                    </li>
                                                                @endforeach
                                                                <li class="seat">
                                                                    <span style="width:108px"></span>
                                                                </li>
                                                                <li class="seat">
                                                                    <p>N</p>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </body>
                            <script src="https://code.jquery.com/jquery-1.9.1.min.js"
                                integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
                            <script>
                                // alert('hi');
                                var checkboxes = $('input[type=checkbox]');
                                checkboxes.change(function() {
                                    var quantity = $('#quantity').val();
                                    if (this.checked) {
                                        var category = $('#category').val();
                                        var selected_class = $(this).attr("class");
                                        var selected_value = $(this).val();
                                        var silver_booked_seats = <?php print json_encode($data->silver_booked_seats) ?>;
                                        var gold_booked_seats = <?php print json_encode($data->gold_booked_seats) ?>;
                                        var vip_booked_seats = <?php print json_encode($data->vip_booked_seats) ?>;
                                        if(selected_class == 'vip'){
                                            if(jQuery.inArray(selected_value, vip_booked_seats) !== -1){
                                                $(this).prop('checked', false);
                                                Swal.fire({
                                                  icon: 'error',
                                                  title: 'Oops...',
                                                  text: 'This is a Booked Seat, please choose another'
                                                })
                                            }
                                        } else if(selected_class == 'gold'){
                                            if(jQuery.inArray(selected_value, gold_booked_seats) !== -1){
                                                $(this).prop('checked', false);
                                                Swal.fire({
                                                  icon: 'error',
                                                  title: 'Oops...',
                                                  text: 'This is a Booked Seat, please choose another'
                                                })
                                            }
                                        } else if(selected_class == 'silver'){
                                            if(jQuery.inArray(selected_value, silver_booked_seats) !== -1){
                                                $(this).prop('checked', false);
                                                Swal.fire({
                                                  icon: 'error',
                                                  title: 'Oops...',
                                                  text: 'This is a Booked Seat, please choose another'
                                                })
                                            }
                                        }
                                        if(category != selected_class){
                                            $(this).prop('checked', false);
                                            Swal.fire({
                                              icon: 'error',
                                              title: 'Oops...',
                                              text: 'Incorrect Seat Selection! Please Select in '+ category.toUpperCase() + ' category.'
                                            })
                                        }
                                        var seats = $("input[type=checkbox]:checked").map(function() {
                                            return this.value;
                                        }).get().join(', ');
                                        var strHtml = '<span class="btn-apply" id="selected_seats">'+ seats +'</span>';
                                        $("#selected_seats").html(strHtml);
                                        if (checkboxes.filter(':checked').length == quantity) {
                                            checkboxes.not(':checked').prop('disabled', true);
                                        }
                                    } else {
                                        var seats = $("input[type=checkbox]:checked").map(function() {
                                            return this.value;
                                        }).get().join(', ');
                                        var strHtml = '<span class="btn-apply" id="selected_seats">'+ seats +'</span>';
                                        $("#selected_seats").html(strHtml);
                                        checkboxes.prop('disabled', false);
                                    }
                                });
                            </script>

                            </html>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="stripe-form-section hide mt-4">
                            <div class="stripe-form"> </div>
                        </div>
                        <div class="coupon-section mb-2 mt-5">
                            <div class="coupon-data">
                                <strong>{{ __('Selected Seats') }}</strong>
                                <span class="btn-apply" id="selected_seats"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="stripe-form-section hide mt-4">
                            <div class="stripe-form"> </div>
                        </div>
                        <button type="submit" id="form_submit" class="btn btn-a w-100 mt-4"><i
                                class="fa pr-2 fa-check-square"></i>{{ __('Place Order') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
