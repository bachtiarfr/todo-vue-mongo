<!DOCTYPE html>
<html>
<head>
    <title>Reminder: Incomplete Item</title>
</head>
<body>
    <p>Dear user,</p>

    <p>This is a reminder that the following item is still incomplete:</p>

    <ul>
        @foreach ($items as $item)
        <li>{{ $item['name'] }}</li>
        @endforeach
    </ul>

    <p>Please complete the item as soon as possible.</p>

    <p>Regards,<br>Your App</p>
</body>
</html>
