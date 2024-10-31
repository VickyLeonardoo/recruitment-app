<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Interview Cancellation Notice</h2>
        </div>

        <div class="content">
            <p>Hi {{ $user->user_detail->full_name }},</p>

            <p>We regret to inform you that your scheduled interview has been canceled. Here are the details of the canceled interview:</p>

            <table>
                <tr>
                    <td><strong>Date:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($schedule['date'])->format('l, F j, Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Time:</strong></td>
                    <td>{{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}</td>
                </tr>
            </table>

            <p>We apologize for any inconvenience this may cause. Our team will reach out to you soon with further information.</p>

            <p>Thank you for your understanding,<br>HR Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} PT Xyz. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
