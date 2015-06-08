<?php
session_start();
	require_once ('log_check.php');	 
		 $message=$_SESSION['message'];
		 $_SESSION['message']=NULL;
		 
		  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    

	
	<script type="text/javascript">
	
  




	function pop()
	{
	$('[data-toggle="popover"]').popover('hide');
$('[data-toggle="popover"]').popover();
	}
	
  </script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>System obsługi szpitala</title>

    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    
  </head >

  
	<form action="useraction.php" id="city" method=post "> 
    
    <nav class="navbar navbar-default navbar-fixed-top" >
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
            <li><a href="patientlist.php">Edytuj</a></li>
            
            <li class="divider"></li>
            <li><a href="patientlist.php">Wyszukaj</a></li>
            
        
          </ul>
        </li>

        


      </ul>

        <ul class="nav navbar-nav">
        <li class="active"><a href="#"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personel<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="adduser.php">Dodaj</a></li>
            <li><a href="userlist.php">Edytuj</a></li>
            <li><a href="#">Usuń</a></li>
            
            
        
          </ul>
        </li>

       
       
    <li ><a href="adminlogout.php">Wyloguj: <?php echo $_SESSION['login'],' ', $_SESSION['surname']; ?></a></li>
      </ul>


       

      </ul>




      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  
    <div class="container theme-showcase" role="main">

      
      <div class="jumbotron">
        <h3>Dodaj użytkownika</h3>
		<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
		<div class="input-group">
  <span class="input-group-addon">Imię<span style="color: red">*</span></span>
  <input type="text" name="forename" id="forename" class="form-control" placeholder="Wpisz imię" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź imie użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Nazwisko<span style="color: red">*</span></span>
  <input type="text" id="surname" name="surname" class="form-control" placeholder="Wpisz nazwisko" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź nazwisko użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Wprowadź hasło<span style="color: red">*</span></span>
  <input type="password" id="password" name="password" class="form-control" placeholder="Wpisz hasło" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź hasło"></div>
  <div class="input-group">
  <span class="input-group-addon">Płeć<span style="color: red">*</span></span>
  <select id="gender" name="gender" class="form-control" placeholder="Wpisz płeć" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź płeć">
  
  <option value="M">M</option>
  <option value="K">K</option>
  
  <select></div>
 
	<div class="input-group">
  <span class="input-group-addon">Data urodzenia<span style="color: red">*</span></span>
  <input type="date" id="birth_date"  name="birth_date" class="form-control" placeholder="Podaj datę w formacie rrrr-mm-dd" data-toggle="popover" onClick=pop()  data-content="Wprowadź datę urodzenia w formacie rrrr-mm-dd)"></div>
	<div class="input-group">
  <span class="input-group-addon">Miejsce urodzenia<span style="color: red">*</span></span>
  <input type="text" id="birth_place" name="birth_place" class="form-control" placeholder="Wpisz miejsce urodzenia" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź miejsce urodzenia (Miasto)"></div>
 
  
	
 
<div class="input-group">
  <span class="input-group-addon">Ulica<span style="color: red">*</span></span>
  <input type="text" id="street_name" name="street_name" class="form-control" placeholder="Wpisz nazwę ulicy" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź ulicę"></div>
 

   <div class="input-group">
  <span class="input-group-addon">Numer Lokalu<span style="color: red">*</span></span>
  <input type="text" id="street_number" name="street_number" class="form-control" placeholder="Wpisz numer lokalu" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź numer lokalu"></div>
      
		 <div class="input-group">
  <span class="input-group-addon">Miasto<span style="color: red">*</span></span>
  <input type="text" id="city" name="city" class="form-control" placeholder="Wpisz miasto" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź nazwę miasta"></div>
 
	<div class="input-group">
  <span class="input-group-addon">Kod Pocztowy<span style="color: red">*</span></span>
  <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Wpisz kod pocztowy" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź kod pocztowy"></div>
 
<div class="input-group">
  <span class="input-group-addon">Kraj<span style="color: red">*</span></span>
  <input type="text" id="country" name="country" class="form-control" placeholder="Wpisz kraj" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź kraj"></div>
 

    
    <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value=Wstaw ></a></p>
      </div>
	</div> 
	</div> 

  





    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  
</html>
