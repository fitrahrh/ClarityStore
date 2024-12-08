<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Minecraft</title>
</head>
<body>
    <h1>Top Up Minecraft Credit</h1>
    <form action="{{ route('topup.process') }}" method="POST">
        @csrf
        <label for="username">Username Minecraft:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="amount">Jumlah Credit:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <button type="submit">Top Up</button>
    </form>
</body>
</html>
