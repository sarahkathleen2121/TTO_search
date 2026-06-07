<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="margin: 0; padding: 0; background: #ffffff; font-family: 'Roboto', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: #ffffff; padding: 40px 0;">
        <tr>
            <td align="center">
                <!-- Logo -->
                <table width="480" cellpadding="0" cellspacing="0" style="max-width: 480px; width: 100%;">
                    <tr>
                        <td align="center" style="padding: 0 40px 30px;">
                            <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="The Total Office" style="height: 30px; display: block; margin: 0 auto;">
                        </td>
                    </tr>
                </table>

                <!-- Main Content Block -->
                <table width="480" cellpadding="0" cellspacing="0" style="background: #eef5ff; max-width: 480px; width: 100%;">
                    <!-- Greeting -->
                    <tr>
                        <td align="center" style="padding: 40px 40px 20px;">
                            <h1 style="color: #383E42; font-weight: 800; font-size: 28px; margin: 0;">
                                Hi {{ $booking->name }}
                            </h1>
                        </td>
                    </tr>

                    @if($booking->type === 'call')
                        <!-- Booking Details (Call) -->
                        <tr>
                            <td align="center" style="padding: 10px 40px;">
                                <p style="color: #383E42; font-size: 15px; line-height: 1.6; margin: 0;">
                                    We booked your call at
                                    <strong>{{ \Carbon\Carbon::parse($booking->date)->format('j F Y') }}, {{ $booking->time }}</strong>
                                </p>
                                <p style="color: #383E42; font-size: 15px; margin: 4px 0 0;">
                                    We will give you a call at your number that you specified<br>
                                    as <strong>{{ $booking->phone ?? '35 478 90 00' }}</strong>
                                </p>
                            </td>
                        </tr>

                        <!-- Reminder -->
                        <tr>
                            <td align="center" style="padding: 16px 40px 30px;">
                                <p style="color: #383E42; font-size: 13px; line-height: 1.6; margin: 0;">
                                    We will send you a reminded to your email 1<br>day before the date
                                </p>
                            </td>
                        </tr>

                        <!-- Buttons (Call) -->
                        <tr>
                            <td align="center" style="padding: 0 40px 12px;">
                                <a href="{{ url('/?reschedule=' . $booking->id) }}" style="display: inline-block; width: 260px; background: #383E42; color: #ffffff; text-decoration: none; text-align: center; padding: 14px 0; font-weight: 700; font-size: 14px; border: 1px solid #383E42; border-radius: 0;">
                                    Reschedule the call
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0 40px 40px;">
                                <a href="{{ url('/?cancel=' . $booking->id) }}" style="display: inline-block; width: 260px; background: transparent; color: #383E42; text-decoration: none; text-align: center; padding: 14px 0; font-weight: 700; font-size: 14px; border: 1px solid #8fbaf3; border-radius: 0;">
                                    Cancel the call
                                </a>
                            </td>
                        </tr>
                    @else
                        <!-- Booking Details (Visit) -->
                        <tr>
                            <td align="center" style="padding: 10px 40px;">
                                <p style="color: #383E42; font-size: 15px; line-height: 1.6; margin: 0;">
                                    We booked your visit at
                                    <strong>{{ \Carbon\Carbon::parse($booking->date)->format('j F Y') }}, {{ $booking->time }}</strong>
                                </p>
                                <p style="color: #383E42; font-size: 15px; margin: 4px 0 0;">
                                    Attend to <strong>35 Jsh. street, building 2, office 415</strong>
                                </p>
                            </td>
                        </tr>

                        <!-- Reminder -->
                        <tr>
                            <td align="center" style="padding: 16px 40px 30px;">
                                <p style="color: #383E42; font-size: 13px; line-height: 1.6; margin: 0;">
                                    We will send you a reminded to your email 1<br>day before the visit
                                </p>
                            </td>
                        </tr>

                        <!-- Buttons (Visit) -->
                        <tr>
                            <td align="center" style="padding: 0 40px 12px;">
                                <a href="{{ url('/?reschedule=' . $booking->id) }}" style="display: inline-block; width: 260px; background: #383E42; color: #ffffff; text-decoration: none; text-align: center; padding: 14px 0; font-weight: 700; font-size: 14px; border: 1px solid #383E42; border-radius: 0;">
                                    Reschedule the meeting
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 0 40px 40px;">
                                <a href="{{ url('/?cancel=' . $booking->id) }}" style="display: inline-block; width: 260px; background: transparent; color: #383E42; text-decoration: none; text-align: center; padding: 14px 0; font-weight: 700; font-size: 14px; border: 1px solid #8fbaf3; border-radius: 0;">
                                    Cancel the meeting
                                </a>
                            </td>
                        </tr>
                    @endif
                </table>

                <!-- Header / Main content separator gap -->
                <table width="480" cellpadding="0" cellspacing="0" style="max-width: 480px; width: 100%;">
                    <tr>
                        <td style="height: 4px; background: #ffffff;"></td>
                    </tr>
                </table>

                <!-- Footer Block -->
                <table width="480" cellpadding="0" cellspacing="0" style="background: #eef5ff; max-width: 480px; width: 100%;">
                    <tr>
                        <td align="center" style="padding: 24px 40px 10px;">
                            <p style="color: #383E42; font-weight: 700; font-size: 13px; margin: 0;">
                                &copy; {{ date('Y') }} Total Office. All Rights Reserved.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 10px 40px 24px;">
                            <a href="#" style="color: #383E42; text-decoration: none; margin: 0 8px; font-size: 16px;">
                                <img src="https://cdn-icons-png.flaticon.com/16/733/733579.png" alt="Twitter" style="width: 18px; height: 18px;" />
                            </a>
                            <a href="#" style="color: #383E42; text-decoration: none; margin: 0 8px; font-size: 16px;">
                                <img src="https://cdn-icons-png.flaticon.com/16/145/145807.png" alt="LinkedIn" style="width: 18px; height: 18px;" />
                            </a>
                            <a href="#" style="color: #383E42; text-decoration: none; margin: 0 8px; font-size: 16px;">
                                <img src="https://cdn-icons-png.flaticon.com/16/1384/1384060.png" alt="YouTube" style="width: 18px; height: 18px;" />
                            </a>
                            <a href="#" style="color: #383E42; text-decoration: none; margin: 0 8px; font-size: 16px;">
                                <img src="https://cdn-icons-png.flaticon.com/16/733/733585.png" alt="WhatsApp" style="width: 18px; height: 18px;" />
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
