<?php
session_start();
	require_once ('log_check.php');	 
		 $message=$_SESSION['message'];
		 $_SESSION['message']=NULL;
		 
		  ?>
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
<form action="patientaction.php" id="city" method=post "> 
  <style type="text/css">

  body {
    padding-top: 70px;
  }
    </style>
    
    
  <div class="container">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Grupowanie "marki" i przycisku rozwijania mobilnego menu -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="mainpage.php">System Obsługi Szpitala</a>
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
            <li><a href="searchwynik.php">Wyszukaj</a></li>
            
        
          </ul>
        </li>

        


      </ul>

        <ul class="nav navbar-nav">
        <li class="active"><a href="#"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personel<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Dodaj</a></li>
            <li><a href="#">Edytuj</a></li>
            <li><a href="#">Usuń</a></li>
            
            
        
          </ul>
        </li>

       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personel<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Dodaj</a></li>
            <li><a href="#">Edytuj</a></li>
            <li><a href="#">Usuń</a></li>
            
            
        
          </ul>
        </li>
	<li ><a href="adminlogout.php">Wyloguj: <?php echo $_SESSION['login'],' ', $_SESSION['surname']; ?></a></li>
      </ul>


       

      </ul>




      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  






</div>




<div class="container theme-showcase" role="main">

      
      <div class="jumbotron">
        <h3>Dodaj pacjenta</h3>
		
		<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
	<h5>Dane podstawowe</h5>
		<div class="input-group">
  <span class="input-group-addon">Imię<span style="color: red">*</span></span>
  <input type="text" name="forename" id="forename" class="form-control" placeholder="Wpisz imię" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź imie użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Nazwisko<span style="color: red">*</span></span>
  <input type="text" id="surname" name="surname" class="form-control" placeholder="Wpisz nazwisko" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź nazwisko użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Płeć<span style="color: red">*</span></span>
  <select id="gender" name="gender" class="form-control" placeholder="Wpisz płeć" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź płeć">
  
  <option value="M">Mężczyzna</option>
  <option value="K">Kobieta</option>
  
  <select></div>
 
	<div class="input-group">
  <span class="input-group-addon">Data urodzenia<span style="color: red">*</span></span>
  <input type="date" id="birth_date"  name="birth_date" class="form-control" placeholder="Podaj datę w formacie rrrr-mm-dd"></div>
	<div class="input-group">
  <span class="input-group-addon">Miejsce urodzenia<span style="color: red">*</span></span>
  <input type="text" id="birth_place" name="birth_place" class="form-control" placeholder="Wpisz miejsce urodzenia" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź miejsce urodzenia (Miasto)"></div>
  <br>
  <h5>Przedstawiony dokument</h5>
  <div class="input-group">
  <span class="input-group-addon">Typ dokumentu<span style="color: red">*</span></span>
  <select id="doctype" name="doctype" class="form-control" placeholder="Wybierz" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź typ dokumentu">
  
  <option value="2">Pesel</option>
  <option value="3">Numer dowodu osobistego</option>
  <option value="4">Paszport</option>
  <select></div><div class="input-group">
  <span class="input-group-addon">NR dokumentu<span style="color: red">*</span></span>
  <input type="text" id="doc_nr" name="doc_nr" class="form-control" placeholder="Wpisz nr dokumentu" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź numer dowodu pacjenta"></div>
  
  
	


        
		 <!--<input type="file" name="map" id="map">-->
        <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value=Wstaw ></a></p>
		
    
    
      </div>
	</div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>


