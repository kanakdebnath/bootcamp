<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
</head>
<body>
    <h1>Complete Your Payment</h1>
    <p>Amount: {{ $amount }} BDT</p>

    <form method="POST" action="{{ route('bkash.create') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <button type="submit">Pay with bKash</button>
    </form>
</body>
</html>
