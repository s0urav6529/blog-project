<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: green;
            color: white !important;
            padding: 20px;
            text-align: center;
            border-radius: 10%;
        }

        .header h1 {
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Email Form Blog</h1>
        </div>
        <div class="content">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 120px;"><strong>Subject:</strong></td>
                    <td>{{ $contact['subject'] }}</td>
                </tr>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $contact['name'] }}</td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{{ $contact['phone'] }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $contact['email'] }}</td>
                </tr>
                <tr>
                    <td><strong>Message:</strong></td>
                    <td>{{ $contact['message'] }}</td>
                </tr>
            </table>
            <p style="margin-top: 20px;">Thank you for contacting us. We will get back to you as soon as possible.</p>
            <center><a class="button" href="http://127.0.0.1:8000/" style="text-decoration: none;">Visit Our Website</a>
            </center>
        </div>
        <div class="footer">
            <p>Copywrite. &copy; {{ date('Y') }} Sourav Majumder. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
