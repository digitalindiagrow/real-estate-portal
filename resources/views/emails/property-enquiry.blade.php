<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #1f2937;">
    <p>Hi {{ $property->user->name }},</p>
    <p>You have a new enquiry for <strong>{{ $property->title }}</strong> ({{ $property->area }}, {{ $property->city }}).</p>
    <table cellpadding="6">
        <tr><td><strong>Name:</strong></td><td>{{ $enquirerName }}</td></tr>
        <tr><td><strong>Phone:</strong></td><td>{{ $enquirerPhone }}</td></tr>
        @if ($enquiryMessage)
            <tr><td><strong>Message:</strong></td><td>{{ $enquiryMessage }}</td></tr>
        @endif
    </table>
    <p>Reply directly to this enquirer to follow up.</p>
</body>
</html>
