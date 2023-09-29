<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<style>
    table, th, td{
        border: 1px solid black;
        padding: 5px;
        border-collapse: collapse;
    }
</style>
<body>
<form action="" method="POST">
    @csrf
    <table>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" placeholder="Enter mail" name="email">
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                <input type="password" placeholder="Enter Password" name="password">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Login">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
