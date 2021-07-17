<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Email Template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
</head>
<body style="font-family: 'Manrope', sans-serif; margin: 0; padding: 0;">
<table style=" border: none; width: 375px;padding: 70px 12px; font-family: 'Manrope', sans-serif; background: url({{ url('/public/assets/images/email_temp/bg-img.png') }});"
       cellpadding="0" cellspacing="0" background="{{ url('/public/assets/images/email_temp/bg-img.png') }}">
    <tbody>
    <tr style="margin:0 12px 10px 12px;">
        <td><img style="padding-bottom: 15px;" src="{{ url('/public/assets/images/email_temp/logo.png') }}" alt="">
        </td>
    </tr>
    <!-- FIRST CARD -->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="background: #fff; border: none; padding: 20px; margin-bottom: 20px;    border-radius: 5px;">
                <tbody>
                <tr style="text-align: center;">
                    <td style="text-align: center;">
                        <img src="{{ url('/public/assets/images/email_temp/card-dog.png') }}" alt="" style="max-width: 100%; height: auto;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1 style="padding: 0; margin: 0;margin-top: 15px; margin-bottom: 12px; font-size: 20px; color: #2d2d2d; font-weight: 700;">
                            Order Confirmed</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="padding: 0; margin: 0 0 10px 0; font-size: 13px; color: #2d2d2d; font-weight: 400;">
                            Hi {{$user['details']['first_name']}}</p>
                        <p style="padding: 0; margin: 0; font-size: 13px; color: #2d2d2d; font-weight: 400;">Lorem ipsum
                            dolor sit amet consectetur adipisicing elit.</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <!-- SECOND CARD -->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="background: #fff; border: none; padding: 20px; margin-bottom: 20px; width: 100%;    border-radius: 5px;"
                   border="0">
                <tbody>
                <tr>
                    <td style="width: 25px;">
                        <img src="{{ url('/public/assets/images/email_temp/calender-icon.png') }}" alt="calender-logo" style="max-width: 100%; height: auto;">
                    </td>
                    <td style="padding-left: 20px;">
                        <p style="padding: 0; margin: 0; font-size: 15px; font-weight: 500;color: #97999b;">Order is
                            Scheduled to</p>
                        <p style="padding: 0; margin: 0; font-size: 15px; font-weight: 500;color: #2d2d2d;">{{date('l jS F, h:ia' ,strtotime($order['date_time']))}}</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <!-- THIRD CARD -->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="background: #fff; border: none; padding: 20px; margin-bottom: 20px;    border-radius: 5px;">
                <tbody>
                <tr style="margin-bottom: 20px;">
                    <td>
                        <p style="color: #2d2d2d; font-size: 16px; font-weight: 500;">Order <span
                                    style="color: #19b69b;">#{{$order['id']}}</span> Summary</p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td style="width: 16%;" colspan="1">
                                    <img src="{{ $order['shop']['image_url'] }}" alt="service-logo"
                                         style="max-width: 100%; height: auto;padding-bottom: 25px;">
                                </td>
                                <td style="width: 84%;padding-left: 10px; text-align: left;" colspan="3">
                                    <p style="padding: 0; margin: 0; font-size: 15px; font-weight: 500; color: #2e384d; text-align: left;">
                                        {{$order['shop']['name']}}</p>
                                    <p style="padding: 0; margin: 0; font-size: 15px; font-weight: 500;color: #8798ad; text-align: left;padding-bottom: 25px;">
                                        {{$order['shop']['address']}}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                @foreach($order['services'] as $service)
                    <?php $amount = $service['price']?>
                <tr style="padding-bottom: 20px; margin-bottom: 20px; border-bottom: 1px solid #ccc">
                    <td style="width: 70%; text-align: left;">
                        <p style="padding: 0; margin: 0; font-size: 14px; font-weight: 500;color: #2d2d2d;">{{$service['service_name']}}</p>
                        @foreach($service['addons'] as $addon)
                            <?php $amount += $addon['price']?>
                        <p style="padding: 0; margin: 0; font-size: 13px;color: #ccc;padding-bottom: 20px;">{{$addon['submenu_name']}}</p>
                        @endforeach
                    </td>

                    <td style="width: 30%; text-align: right;">
                        <p style="padding: 0; margin: 0; font-size: 15px;font-weight: 500; color: #000;padding-bottom: 20px;white-space: nowrap;">
                            AED {{$amount}}</p>
                    </td>

                </tr>
                @endforeach
                {{--<tr style="padding-bottom: 20px; margin-bottom: 20px; border-bottom: 1px solid #ccc">--}}
                    {{--<td style="width: 70%; text-align: left;">--}}
                        {{--<p style="padding: 0; margin: 0; font-size: 14px; font-weight: 500;color: #2d2d2d;">Bath &--}}
                            {{--Brush</p>--}}
                        {{--<p style="padding: 0; margin: 0; font-size: 12px; font-weight: 500; color: #97999b;padding-bottom: 20px;">--}}
                            {{--Medium Pet</p>--}}
                    {{--</td>--}}
                    {{--<td style="width: 30%; text-align: right;">--}}
                        {{--<p style="padding: 0; margin: 0; font-size: 15px; color: #000;padding-bottom: 20px;font-weight: 500;white-space: nowrap;">--}}
                            {{--AED 210</p>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                <tr style="padding-bottom: 10px;">
                    <td style="text-align: left; width: 70%;">
                        <p style="padding: 0; padding-bottom: 10px; margin: 0; font-size: 14px; font-weight: 500;color: #2d2d2d;">
                            Subtotal</p>
                    </td>
                    <td style="text-align: right; width: 30%;">
                        <p style="padding: 0; padding-bottom: 10px; margin: 0; font-size: 14px; font-weight: 500; color: #2d2d2d;white-space: nowrap;">
                            AED {{$order['sub_total']}}</p>
                    </td>
                </tr>
                <tr style="padding-bottom: 10px;">
                    <td style="text-align: left; width: 70%;">
                        <p style="padding: 0; padding-bottom: 10px; margin: 0; font-size: 14px; font-weight: 500;color: #2d2d2d;">
                            Tax</p>
                    </td>
                    <td style="text-align: right; width: 30%;">
                        <p style="padding: 0; padding-bottom: 10px; margin: 0; font-size: 14px; font-weight: 500; color: #2d2d2d;">
                            AED {{$order['tax']}}</p>
                    </td>
                </tr>
                <tr style="padding-bottom: 10px;">
                    <td style="text-align: left; width: 70%;">
                        <p style="padding: 0; margin: 0; font-size: 14px; font-weight: 500;color: #2d2d2d;padding-bottom: 30px;">
                            Delivery</p>
                    </td>
                    <td style="text-align: right; width: 30%;">
                        <p style="padding: 0; margin: 0; font-size: 14px; font-weight: 500; color: #2d2d2d; padding-bottom: 30px;">
                            AED {{$order['delivery_fee']}}</p>
                    </td>
                </tr>
                <tr style="padding-bottom: 10px; margin-top: 20px;">
                    <td style="text-align: left; width: 70%;">
                        <p style="padding: 0; margin: 0; font-size: 17px;color: #2d2d2d;  font-weight: 700;">Order
                            Total </p>
                    </td>
                    <td style="text-align: right; width: 30%;">
                        <p style="padding: 0; margin: 0; font-size: 17px;color: #2d2d2d; font-weight: 700;white-space: nowrap;">
                            AED {{$order['total']}} </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <!-- FOURTH CARD WORK FROM HERE-->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="background: #fff; border: none; padding: 20px; margin-bottom: 20px; width: 100%;    border-radius: 5px;">
                <tbody>
                <tr>
                    <td>
                        <p style="padding:0; margin: 0;font-size: 14px; font-weight: 700; margin-bottom: 15px; color: #2d2d2d;">
                            Customer Information</p></td>
                </tr>
                <tr>
                    <td style="width: 50%;margin-top: -40px !important;">
                        <p style="margin:0;padding:0; margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #818181;">
                            Delivery Address</p>
                        <p style="margin:0;padding:0;font-size: 14px; font-weight: 700; color: #2d2d2d;">{{$order['address']['apartment_number']}}</p>
                        <p style="margin:0;padding:0;font-size: 14px; font-weight: 500; color: #2d2d2d;">
                            {{$order['address']['address']}}
                        </p>
                        <br><br>
                    </td>
                    <td style="width: 50%;">
                        <p style="margin:0;padding:0; margin-bottom: 5px;font-size: 14px; font-weight: 500; color: #818181;">
                            Payment Method</p>
                        <p style="margin:0;padding:0;font-size: 14px; font-weight: 700; color: #2d2d2d; margin-bottom: 15px;">
                            Visa card x8263</p>

                        <p style="margin:0;padding:0; margin-bottom: 5px;font-size: 14px; font-weight: 500; color: #818181;">
                            Contact Info</p>
                        <p style="margin:0;padding:0;font-size: 14px; font-weight: 700; color: #2d2d2d;">{{$user['details']['phone']}}</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <!-- FIFTH CARD -->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="background: #fff; border: none; padding: 20px; margin-bottom: 20px; width: 100%;    border-radius: 5px;">
                <tbody>
                <tr>
                    <td style="width: 100%;">
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td style="width: 17%;" colspan="1">
                                    <img src="{{ url('/public/assets/images/email_temp/chat-icon.png') }}" alt="service-logo"
                                         style="max-width: 100%; height: auto;padding-bottom: 25px;">
                                </td>
                                <td style="width: 83%;padding-left: 10px; text-align: left;" colspan="3">
                                    <p style="padding: 0; margin: 0; font-size: 17px; font-weight: 500; color: #2d2d2d; text-align: left;">
                                        Need assistance?</p>
                                    <p style="padding: 0; margin: 0; font-size: 12px; font-weight: 500;color: #97999B; text-align: left;padding-bottom: 25px;">
                                        Chat with petspace</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                <tr>
                    <td>
                        <a href="#!"
                           style="width: 100%; height: 38px;color: #2d2d2d; color: #2d2d2d; text-align: center; font-size: 16px; font-weight: 700; text-decoration: none;display: inline-block;border: 1px solid #000;border-radius: 25px;padding-top: 12px;">Contact
                            Petspace</a>
                    </td>
                </tr>
                <!-- <tr style="margin-top: 15px;">
                    <td style="width: 100%;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#!" style="width: 100%; height: 48px;color: #2d2d2d; color: #2d2d2d; text-align: center; font-size: 14px; font-weight: 700; text-decoration: none;display: inline-block;border: 1px solid #000;border-radius: 25px;">Contact Petspace</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr> -->
                </tbody>
            </table>
        </td>
    </tr>
    <!-- SIXTH CARD -->
    <tr style="margin:0 12px 0px 12px;">
        <td>
            <table style="width: 100%;">
                <tbody>
                <tr style="text-align: center;">
                    <td style="text-align: center;"><img src="{{ url('/public/assets/images/email_temp/footer-logo.png') }}" alt="logo"
                                                         style="max-width: 100%; height: auto;padding-bottom: 20px;">
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="text-align: center; font-size: 14px;font-weight: 500;color: #2D2D2D;padding-bottom: 20px;">
                        2020 Petspace LLC
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="text-align: center; font-size: 14px;font-weight: 500;color: #2D2D2D;padding-bottom: 20px;">
                        www.petspace.app
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="text-align: center; font-size: 14px;font-weight: 500;color: #2D2D2D;padding-bottom: 20px;">
                        598 Olutaw Extension<br>Mountain View, Dubai
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="text-align: center;">
                        <a href="#!" style="margin:0 15px; display: inline;"><img src="{{ url('/public/assets/images/email_temp/icon-fb.png') }}" alt=""
                                                                                  style="max-width: 100%; height: auto;"></a>
                        <a href="#!" style="margin:0 15px; display: inline;">
                            <img src="{{ url('/public/assets/images/email_temp/icon-insta.png') }}" alt="" style="max-width: 100%; height: auto;">
                        </a>
                        <a href="#!" style="margin:0 15px; display: inline;">
                            <img src="{{ url('/public/assets/images/email_temp/icon-tw.png') }}" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>