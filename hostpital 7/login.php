<!DOCTYPE html>
<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Obsługi Szpitala</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<form action="setLogin.php" id="mainpage" method=post >
  <style type="text/css">


    </style>
    
    
 <div class="container">
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <legend>Zaloguj Się</legend>
            <!--<div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>
                Niepoprawna Nazwa Uzytkownika lub Hasło!
            </div>-->
      <form method="POST" action="" accept-charset="UTF-8">
      <input type="text" name="login" id="login" class="span4"  placeholder="Imie"><br><br>
	  <input type="text" name="surname" id="surname" class="span4"  placeholder="Nazwisko"><br><br>
      <input type="password" id="password" class="span4" name="password" placeholder="Hasło">
            <label class="checkbox">
              <input type="checkbox" name="remember" value="1"> Zapamiętaj Mnie!
            </label>
      <input type="submit" id="button1" role="button" name="submit" class="btn btn-info " value=Zaloguj></button>
	  
      </form>    
    </div>
  </div>
</div>

</html>