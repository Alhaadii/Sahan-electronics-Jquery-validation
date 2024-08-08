<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-4 p-5 bg-light shadow-lg rounded">
                <h1 class="mb-5 text-center fw-bold  text-uppercase border-bottom">Login</h1>
                <form action="operation.php" method="post" id="userform">
                    <input class="form-control mt-2" type="text" name="user" id="user" placeholder="Enter Username">
                    <input class="form-control mt-2" type="password" name="pass" id="pass" placeholder="Enter password">
                    <input class="form-control mt-4 btn btn-primary btn-lg text-uppercase" type="submit" name="submit" value="login">
                </form>
            </div>
        </div>
    </div>

    
</body>

</html>