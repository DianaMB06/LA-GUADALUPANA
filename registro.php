

<?php
    session_start();

    if (isset($_POST['validar'])) {
        $_SESSION['userID'] = $_POST['userID'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['picture'] = $_POST['picture'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['accessToken'] = $_POST['accessToken'];

        exit("success");
    }
?>

<!DOCTYPE html>
<head>
<title>Registrarse</title>

  <meta charset="utf-8">


  <link rel="stylesheet" href="css/styleLogin.css">

</head>


<body>

    <div class="container_formulario">
    




                
                    
                    <div class="form-group"> 
                        <form action="registrar.php" method="post">

                        <h2 class="subtittle">REGISTRARSE</h2>
                        
                         <label  for="password"></label>
             
                            <input type="email" name="nick"   placeholder="Correo Electrónico"required>

                         <label for="password"></label>
                            <input type="password" name="pass"  placeholder="Contraseña"required>
                            
                            <button type="submit" class="regis">Registrarse</button>
                         <button type="reset" class="regis"><a href="index.php" class="regis">Iniciar Sesión</a></button>
                  
                              </div>

                </form>
          </div>

<?php
    if(isset($_POST['submit'])){
      require("registrar.php");
    }
  ?>


</body>
</html>




