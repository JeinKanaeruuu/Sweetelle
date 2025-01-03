<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
</head>
<body>
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>This is your customer dashboard.</p>

    <form method="POST" action="{{ route('customer.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
