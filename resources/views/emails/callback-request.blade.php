<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; }
        .wrap { max-width: 580px; margin: 0 auto; }
        .header { background: #384BFF; color: #fff; padding: 28px 32px; border-radius: 8px 8px 0 0; text-align: center; }
        .header h2 { margin: 0; font-size: 22px; }
        .body { background: #fff; padding: 28px 32px; border: 1px solid #e5e7eb; }
        .body p { color: #444; margin-top: 0; }
        .field { margin-bottom: 18px; }
        .label { font-weight: bold; color: #384BFF; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
        .value { color: #111; font-size: 16px; margin-top: 4px; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 20px 0; }
        .footer { text-align: center; padding: 16px; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h2>&#128222; New Call Back Request</h2>
    </div>
    <div class="body">
        <p>A visitor has submitted a call back request via the SCS Technologies website.</p>
        <hr class="divider">
        <div class="field">
            <div class="label">Name</div>
            <div class="value">{{ $data['callback_name'] }}</div>
        </div>
        <div class="field">
            <div class="label">Contact Number</div>
            <div class="value">{{ $data['callback_phone'] }}</div>
        </div>
        <div class="field">
            <div class="label">Submitted At</div>
            <div class="value">{{ now()->format('F j, Y \a\t g:i A T') }}</div>
        </div>
        <hr class="divider">
        <p style="color:#666; font-size:14px;">Please follow up with this contact as soon as possible.</p>
    </div>
    <div class="footer">
        SCS Technologies &mdash; 10125 NW 116th Way, Medley, Florida 33178 &mdash; +1 (305) 906-5182
    </div>
</div>
</body>
</html>
