<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Transaksi</title>
</head>
<body>
    <h1>Status Transaksi</h1>

    <p><strong>Merchant Ref:</strong> {{ $transaction->merchant_ref }}</p>
    <p><strong>Status:</strong> {{ $transaction->status }}</p>
    <p><strong>Jumlah:</strong> Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>

    <a href="/">Kembali ke Form</a>
</body>
</html>
