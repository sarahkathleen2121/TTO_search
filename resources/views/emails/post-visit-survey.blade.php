<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Visit Survey</title>
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
                            <h1 style="color: #383E42; font-weight: 800; font-size: 24px; margin: 0 0 20px;">
                                Hi {{ $booking->name }}
                            </h1>
                            @if($booking->type === 'call')
                                <h2 style="color: #383E42; font-weight: 500; font-size: 22px; margin: 0 0 24px;">
                                    Thank you for your call
                                </h2>
                                <p style="color: #383E42; font-size: 14px; line-height: 1.6; margin: 0 0 40px; text-align: center; max-width: 320px;">
                                    We would be humbled if you could<br>complete through our post call survey. You<br>can access it by clicking button below
                                </p>
                            @else
                                <h2 style="color: #383E42; font-weight: 500; font-size: 22px; margin: 0 0 24px;">
                                    Thank you for your visit
                                </h2>
                                <p style="color: #383E42; font-size: 14px; line-height: 1.6; margin: 0 0 40px; text-align: center; max-width: 320px;">
                                    We would be humbled if you could<br>complete through our post visit survey. You<br>can access it by clicking button below
                                </p>
                            @endif
                            
                            <!-- Button -->
                            <a href="{{ route('post.feedback', ['booking' => $booking->id]) }}" style="display: inline-block; width: 220px; background: #383E42; color: #ffffff; text-decoration: none; text-align: center; padding: 14px 0; font-weight: 600; font-size: 14px; border-radius: 0px; box-shadow: 0 4px 6px rgba(11, 77, 232, 0.2);">
                                Take the survey
                            </a>
                        </td>
                    </tr>
                    
                    <!-- Spacer -->
                    <tr>
                        <td style="padding: 20px 0;"></td>
                    </tr>
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
