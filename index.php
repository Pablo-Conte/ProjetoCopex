<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.css">
    <style>
        .navbar {
            background-color: #20C997;
            position: sticky;
            top: 0px;
            
        }
        .btn {
            color: white;
            text-decoration: none;
            border: 1px solid white;
        }

        .btn:hover {
            background-color: white;
        }

        div.main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        body {
            background-color: #92fcdc;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">COPEX</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
      <form class="d-flex">
        <a href="./pages/login.php"><button type="button" class="btn btn-link">Login</button></a>
      </form>
    </div>
  </div>
</nav>
    <div class="main">
        <h1>UMA DISTRIBUIÇÃO BRASILEIRA HERBERT RICHARDS</h1>
    </div>
</body>
</html>