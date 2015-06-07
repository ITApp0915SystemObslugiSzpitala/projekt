<?php
session_start();
	require_once ('log_check.php');	 
		 $message=$_SESSION['message'];
		 $_SESSION['message']=NULL;
		  
		  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

	
	
    <title>System Obsługi Szpitala</title>

    
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">

    
  </head >

  
	<form action="searchwynik.php" id="city" method=post "> 
    
    <nav class="navbar navbar-default navbar-fixed-top" >
      <div class="container">
    <!-- Grupowanie "marki" i przycisku rozwijania mobilnego menu -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">System Obsługi Szpitala</a>
    </div>
 
    <!-- Grupowanie elementów menu w celu lepszego wyświetlania na urządzeniach moblinych -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"></a></li>
        <li><a href="przyjmij.php">Przyjmij</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacjent<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="patientprofile.php">Dodaj</a></li>
            <li><a href="#">Edytuj</a></li>
            
            <li class="divider"></li>
            <li><a href="#">Wyszukaj</a></li>
            
        
          </ul>
        </li>

         


      </ul>

        <ul class="nav navbar-nav">
        <li class="active"><a href="#"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personel<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="adduser.php">Dodaj</a></li>
            <li><a href="#">Edytuj</a></li>
            <li><a href="#">Usuń</a></li>
            
            
        
          </ul>
        </li>

       
        
	<li ><a href="adminlogout.php">Wyloguj: <?php echo $_SESSION['login'],' ', $_SESSION['surname']; ?></a></li>
      </ul>


       

      </ul>




      
      
    </div>
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <div class="jumbotron"> 
       <form class="form-inline" role="form">
  <div class="form-group">
  <br><br><br>
    <label class="sr-only" for="exampleInputEmail2">Wyszukaj</label>
	<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
    <input type="search" class="form-control" id="search" name="search" placeholder="Wpisz tekst">
  </div>
  
  <p><input type="submit" id="button" name="button" class="btn btn-default" role="button" value="Szukaj pacjenta"></a></p>
  
  
</form>
<p>"pelnisz role: "</p> <?php echo $_SESSION['role_name']; ?>
</div>

      </div>
	</div> 

  





    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>
