<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field-label {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .field-value {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
        }

        .message-box {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>New Contact Message</h1>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">From:</div>
            <div class="field-value">{{ $name }} &lt;{{ $email }}&gt;</div>
        </div>

        <div class="field">
            <div class="field-label">Subject:</div>
            <div class="field-value">{{ $subject }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="message-box">
                {{ nl2br(e($messageContent)) }}
            </div>
        </div>
    </div>

    <div class="footer">
        <p>This message was sent from the Jammin website contact form.</p>
        <p>Sent on: {{ date('F j, Y, g:i a') }}</p>
    </div>
</div>
</body>
</html>
