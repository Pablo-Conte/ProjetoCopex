<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body{
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            height: 100%;
            background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );
        }

        .loginChoice {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }

        .opcao {
            background-color: #212529;
            padding: 25px;
            width: 100%;
            color: #fff;
            text-align: center;
        }

        .opcao:hover {
            background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );
        }

        .container{
            display: flex;
            grid-gap: 7rem;
            padding: 3.125rem;
            justify-content: center;
            background-color: #292e33;
            margin: 0rem 6.25rem;
            border-radius: 0.625rem;
            margin-top: 3.125rem;
        }

        .img{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 80%;
        }

        .login-content{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .img img{
            width: 31.25rem;
        }

        form{
            width: 22.5rem;
        }

        .login-content img{
            height: 6.25rem;
        }

        .login-content h2{
            margin: 0.9375rem 0;
            color: #333;
            text-transform: uppercase;
            font-size: 2.9rem;
        }

        .login-content .input-div{
            position: relative;
            display: grid;
            grid-template-columns: 7% 93%;
            margin: 1.5625rem 0;
            padding: 0.3125rem 0;
            border-bottom: 2px solid #fff;
        }

        .login-content .input-div.one{
            margin-top: 0;
        }

        .i{
            color: #d9d9d9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .i i{
            transition: .3s;
        }

        .input-div > div{
            position: relative;
            height: 2.8125rem;
        }

        .input-div > div > h5{
            position: absolute;
            left: 0.625rem;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1.125rem;
            transition: .3s;
        }

        .input-div:before, .input-div:after{
            content: '';
            position: absolute;
            bottom: -0.125rem;
            width: 0%;
            height: 0.125rem;
            background-color: #38d39f;
            transition: .4s;
        }

        .input-div:before{
            right: 50%;
        }

        .input-div:after{
            left: 50%;
        }

        .input-div.focus:before, .input-div.focus:after{
            width: 50%;
        }

        .input-div.focus > div > h5{
            top: -5px;
            font-size: 0.9375rem;
        }

        .input-div.focus > .i > i{
            color: #38d39f;
        }

        .input-div > div > input{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            background: none;
            padding: 0.5rem 0.7rem;
            font-size: 1.2rem;
            color: #555;
            font-family: 'poppins', sans-serif;
        }

        .input-div.pass{
            margin-bottom: 4px;
        }

        a{
            display: block;
            text-align: right;
            text-decoration: none;
            color: #fff;
            font-size: 0.9rem;
            transition: .3s;
        }

        a:hover{
            color: #38d39f;
        }

        .btn{
            display: block;
            width: 100%;
            height: 3.125rem;
            border-radius: 1.5625rem;
            outline: none;
            border: none;
            background-image: radial-gradient( circle farthest-corner at 12.3% 19.3%,  rgba(85,88,218,1) 0%, rgba(95,209,249,1) 100.2% );
            background-size: 200%;
            font-size: 1.2rem;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            margin: 1rem 0;
            cursor: pointer;
            transition: .5s;
        }
        .btn:hover{
            background-position: right;
        }


        @media screen and (max-width: 1050px){
            .container{
                grid-gap: 5rem;
            }
        }

        @media screen and (max-width: 1000px){
            form{
                width: 18.125rem;
            }

            .login-content h2{
                font-size: 2.4rem;
                margin: 0.5rem 0;
            }

            .img img{
                width: 400px;
            }
        }

        @media screen and (max-width: 900px){
            .container{
                grid-template-columns: 1fr;
            }

            .img{
                display: none;
            }

            .wave{
                display: none;
            }

            .login-content{
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    
        <div class="container">
            <div class="loginChoice">

                <label value="Administrador" name="opcao" class="opcao" id="Administrador">Administrador</label>
                <label value="Estudante" name="opcao" class="opcao" id="Estudante">Estudante</label>
                <label value="Empresa" name="opcao" class="opcao" id="Empresa">Empresa</label>

            </div>
            <div class="login-content">
                <form action="index.html">
                    <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Username</h5>
                            <input type="text" class="input">
                    </div>
                    </div>
                    <div class="input-div pass">
                    <div class="i"> 
                            <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                            <h5>Password</h5>
                            <input type="password" class="input">
                    </div>
                    </div>
                    <a href="#">Forgot Password?</a>
                    <input type="submit" class="btn" value="Login">
                </form>
            </div>
    </div>
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>