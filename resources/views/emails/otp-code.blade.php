<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #1f2937;">
    <p>Hi {{ $user->name }},</p>
    <p>Your verification code is:</p>
    <p style="font-size: 28px; font-weight: bold; letter-spacing: 4px;">{{ $code }}</p>
    <p>This code expires in 10 minutes. If you didn't request this, you can ignore this email.</p>
</body>
</html>
