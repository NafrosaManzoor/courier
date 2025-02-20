<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tracking Number</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .email-header {
            background-color: #007bff;
            padding: 15px;
            text-align: center;
            color: #ffffff;
            font-size: 18px;
            border-radius: 8px 8px 0 0;
        }

        .email-body {
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 12px;
        }

        .email-footer {
            margin-top: 20px;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            Parcel Tracking Information
        </div>

        <div class="email-body">
            <p>Dear Customer,</p>
            <p>Your parcel tracking number is: <strong>{{ $parcel->reference_number }}</strong></p>
            <p>You can use this tracking number to track the status of your parcel on our website.</p>

            <p>Thank you for using our services!</p>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} Courier Service. All rights reserved.
        </div>
    </div>

</body>

</html>
