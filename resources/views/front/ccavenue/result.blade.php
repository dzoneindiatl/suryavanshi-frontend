<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment {{ $success ? 'Successful' : 'Update' }}</title>
</head>
<body>
    <main style="max-width: 640px; margin: 10vh auto; padding: 24px; font-family: Arial, sans-serif; text-align: center;">
        <h1>{{ $success ? 'Payment successful' : 'Payment update' }}</h1>
        <p>{{ $message }}</p>
        @if ($order)
            <p>Order number: <strong>{{ $order->order_number }}</strong></p>
        @endif
        <a href="{{ route('front-home.index') }}">Return to home</a>
    </main>
</body>
</html>
