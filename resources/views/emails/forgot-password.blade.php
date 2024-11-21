<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background-color: #4caf50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            line-height: 1.5;
            margin: 16px 0;
        }
        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            padding: 10px;
            background-color: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #4caf50;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Reset Password</h1>
        </div>
        <div class="email-body">
            <p>Hello {{$user->name}},</p>
            <p>We received a request to reset your password. Here is your verification code:</p>
            <h3>{{ $code }}</h3>
            <p>Please use this code to reset your password.</p>
            <p>Best regards,</p>
            <p>The Shop E-commerce Team</p>
        </div>
        <div class="email-footer">
            &copy; 2024 Shop E-commerce. All rights reserved.
        </div>
    </div>
</body>
</html>
