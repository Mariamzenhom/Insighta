<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>
    <h1>Hello, {{ $get_user_name }}!</h1>
    <p>Thank you for registering with us.</p>
    <p>Your verification code is: <strong>{{ $validToken }}</strong></p>
    <p>Please use this code to activate your account.</p>
    <p>Thank you!</p>
</body>
</html>
