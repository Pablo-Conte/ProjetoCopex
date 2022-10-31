<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="./pages/css/headerIndex.css">
  <script src="./Bootstrap/js/bootstrap.bundle.js"></script>
  <title>Index</title>
</head>
<style>
  .carouselBanner1 {
    padding-bottom: 19%;
    font-size: 20px;    
  }

  .hbanner1 {
    font-size: 32px;
    padding-bottom: 1%;
  }

  #hbanner2 {
    font-size: 28px;
    padding-bottom: 2%;
  }

  .carouselBanner2 {
    padding-bottom: 16%;
    font-size: 20px;
  }

  .titulo {
    text-align: center;
    margin: 30px 0 30px 0;
    text-decoration: underline;
    font-size: 35px;
  }
</style>
<body>
  <nav class="navbar navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand ">COPEX</a>
      <form class="d-flex" role="search">
        <a href="./pages/login.php">
          <div class="btn btn-outline-success">Login</div>
        </a>
      </form>
    </div>
  </nav> 

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagens\banner2.png" class="d-block w-100" alt="">
      <div class="carouselBanner1 carousel-caption d-none d-md-block ">
        <h5 class="hbanner1">Bem Vindo(a) à COPEX Estágios </h5>
        <p>Aqui você poderá conferir as ofertas de estágio aos alunos do IFSul!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="imagens\banner3.png" class="d-block w-100" alt="...">
      <div class="carouselBanner2 carousel-caption d-none d-md-block">
        <h5 id="hbanner2">Se deseja conferir as vagas, clique no link abaixo para ser redirecionado para a página de login.</h5>
        <a href="./pages/login.php" class="btn btn-outline-success">Logar-se</a>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!--
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="titulo">Nosso time</h3>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="imagens\Pablo.jpg" class="card-img-top" alt="Imagem de Perfil 1">
          <div class="card-body">
            <h5 class="card-title">Pablo Conte Côrrea</h5>
            <p class="card-text">Técnico em informática</p>
            <p class="card-text">Estudante do IFSul</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="imagens\Thomas.jpg" class="card-img-top" alt="Imagem de Perfil 2">
          <div class="card-body">
            <h5 class="card-title">Thomas Schmidt</h5>
            <p class="card-text">Técnico em informática</p>
            <p class="card-text">Estudante do IFSul</p>
          </div>
        </div>
      </div>           
    </div>
  </div>
-->
<footer>
    <div id="contact-area">
      <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="titulo">Entre em contato</h3>
            </div>
            <div class="col-md-3 contact-box">
              <i class="fas fa-envelope"></i>
              <p><span class="contact-tile">Envie um email:</span> copexestágios@ifsul.edu.br</p>
            </div>
            <div class="col-md-4" id="msg-box">
              <p>Ou nos deixe uma mensagem:</p>
            </div>
            <div class="col-md-4" id="contact-form">
              <form action="">
                <input type="text" class="form-control" placeholder="E-mail" name="email">
                <input type="text" class="form-control" placeholder="Assunto" name="subject">
                <textarea class="form-control" rows="3" placeholder="Sua mensagem..." name="message"></textarea>
                <input type="submit" class="btn btn-primary btn-sm">
              </form>
            </div>
          </div>
      </div>
    </div><br>
    
  </footer>

</body>

</html>