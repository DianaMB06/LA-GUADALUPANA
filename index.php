
<!DOCTYPE html>
<head>
<title>Login</title>

  <meta charset="utf-8">


  <link rel="stylesheet" href="css/styleLogin.css">


</head>


<body>

    <div class="container_formulario">   
                    <div class="form-group">
        <form action="validar.php" method="post">
                      <h1 class="tittle">LA GUADALUPANA</h1>
                      <h2 class="subtittle">INICIAR SESIÓN</h2>
                
                        <label class="col-xs-12" for="usuario"></label>
                        
                          <input type="email" name="mail"  placeholder="Correo Electrónico"required>

                         <label class="col-xs-12" for="password"></label>
                            <input type="password" name="pass"  placeholder="Contraseña"required>

                            <input type="submit" name="submit" value="Acceder">
                        <button type="submit" class="regis"><a href="registro.php"  class="regis">Registrarse</a></button>
                 
            </div>
        </form>
    </div>

</body>
</html>