<!-- resources/views/admin_users/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Admin User</title>
</head>
<body>
    <h1>Admin User Details</h1>
    <p>Name: {{ $admin_user->name }}</p>
    <p>Email: {{ $admin_user->email }}</p>
</body>
</html>