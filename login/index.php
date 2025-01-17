<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="../css/stylelog.css" type="text/css">
    <style>
      
    </style>
</head>
<body>

<section class="login">
    <!-- Login Form -->
    <h3>Login Admin</h3>
    <form name="masuk" action="../admin/proses_login.php" method="post">
        <table>
            <tr>
                <td>UserName</td>
                <td><input type="text" name="username" placeholder="Masukan UserName" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="Masukan Password" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="login" value="Login">
                </td>
            </tr>
        </table>
    </form>

  
</section>

</body>
</html>
