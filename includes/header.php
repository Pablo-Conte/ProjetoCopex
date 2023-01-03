<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./Bootstrap/css/bootstrap.css">
  <style>
    .navbar {
      background-color: #0C4D18;
      position: sticky;
      top: 0rem;
      color: white;
      margin: 0px
    }

    a {
      color: white;
    }

    .container {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 85%;
    }

    .row {
      display: flex;
      width: 100%;
    }

    .navLeft {
      width: 25%;
      
    }

    .navRight {
      width: 75%;
      float: left;
      text-align: right;
    }

    ul {
      float: right;
      margin: 0em;
    }

    li {
      float: left;
      list-style: none;
      margin-left: 0.9375rem;
      margin-right: 0.9375rem;
      padding: 1.4375rem 0.9375rem;
    }

    a {
      text-decoration: none;
    }

    a :hover {
      color: #5ECC72;
    }

    .op {
      margin: 0px;
    }

    * {
      font-family: Arial, Helvetica, sans-serif;
    }
    
    .logo h1 {
      font-size: 1.5em;
      font-weight: bold;
      padding: 1.25rem 0.9375rem;
      margin: 0rem
    }

    body {
      margin: 0px;
    }
  </style>
</head>

<body>

  <nav class="navbar">
    <div class="container">
      <div class="row">
        <div class="navLeft">
          <div class="logo">
            <a href=""><h1>COPEX</h1></a>
          </div>
        </div>
        <div class="navRight">
          <ul>
            <li><a href=""><p class="op">Sobre nós</p></a></li>
            <li><a href=""><p class="op">Login</p></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>


