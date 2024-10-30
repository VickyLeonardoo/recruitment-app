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
            <h2>Interview Schedule</h2>
        </div>

        <div class="content">
            <p>Hi {{ $user->name }},</p>

            <p>We are pleased to invite you to an interview. Here are the details:</p>

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

            <p>Please make sure to be available at the scheduled time.</p>

            <p>Best regards,<br>HR Team</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
