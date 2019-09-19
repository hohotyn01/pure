@extends('layouts.mail')

@section('content')
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                                <h1>Clearing group</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="background-image: url({{asset('assets/img/bg_1.jpg')}}); background-size: cover; height: 400px;">
                    <div class="overlay"></div>
                    <table>
                        <tr>
                            <td>
                                <div class="text" style="padding: 2 5em; text-align: center;">
                                    <h2>Your order is accepted</h2>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td class="bg_white email-section">
                    <div class="heading-section" style="text-align: center; padding: 0 30px;">
                        <h2>Thank you for using our services.</h2>
                    </div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="top" width="50%" style="padding-top: 20px; padding-right: 10px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td class="text-services" style="text-align: left;">
                                            <h3>Your personal data</h3>
                                            <p>Dear {{$user->first_name}}</p>
                                            <p>You have specified this email <br><strong>{{$user->email}}</strong></p>
                                            <p>Your phone number <br><strong>{{$user->mobile_phone}}</strong></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="50%" style="padding-top: 20px; padding-left: 10px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td class="text-services" style="text-align: left;">
                                            <h3>Order Details</h3>
                                            <p>You have selected the type of cleaning <br><strong>{{$order->decryptionType->decryption_type}}</strong></p>
                                            <p>Parameters of your room  <br><strong>{{$order->bedroom}} bed, {{$order->bathroom}} bath - {{$order->home_footage}} sq. ft</strong></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="heading-section" style="text-align: center; padding: 0 30px;">
                        <h2>Price - ${{$order->total_sum}}</h2>
                    </div>
                </td>
            </tr><!-- end: tr -->
            <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="middle" class="bg_black footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="33.333%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-right: 10px;">
                                            <p>&copy; 2019 Clearing Group. All Rights Reserved</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
@endsection
