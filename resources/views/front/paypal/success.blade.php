<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        *{box-sizing:border-box}
        body{margin:0;font-family:Arial,sans-serif;background:#f5f7fb;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:20px}
        .success-box{background:#fff;padding:40px 25px;border-radius:12px;text-align:center;max-width:480px;width:100%;box-shadow:0 5px 25px rgba(0,0,0,.08)}
        .success-icon{width:75px;height:75px;border-radius:50%;background:#e7f8ee;color:#198754;display:flex;align-items:center;justify-content:center;font-size:42px;margin:0 auto 20px}
        h1{color:#198754;font-size:26px;margin:0 0 15px}
        p{color:#555;line-height:1.6;margin:10px 0}
        .order-id{background:#f5f7fb;padding:12px;border-radius:6px;overflow-wrap:anywhere;font-size:14px;margin:20px 0}
        .home-btn{display:inline-block;background:#022E71;color:#fff;text-decoration:none;padding:13px 25px;border-radius:6px;margin-top:15px}
        .home-btn:hover{background:#01409a}
    </style>
</head>
<body>
    <div class="success-box">
        <div class="success-icon">&#10003;</div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your order. Your PayPal payment has been completed successfully.</p>
        <div class="order-id">
            <strong>PayPal Order ID:</strong><br>
            {{ $paypalOrderId }}
        </div>
        <p>Your order has been confirmed. Thank you for shopping with us!</p>
        <a href="{{ url('/') }}" class="home-btn">Continue Shopping</a>
    </div>
</body>
</html>