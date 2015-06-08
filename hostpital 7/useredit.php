<?php
if ($_POST["button"]=="Wybierz"){
    header ('Location: userinfo.php?id='.$_POST['user_id'].'');
    }
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
<form action="useraction.php" method=post ">
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
  





</div>




<div class="container theme-showcase" role="main">

      <div class="jumbotron">
        <h3>Przyjmij pacjenta</h3>
		<input type="hidden" name="searchid" id="searchid" value="<?php echo $_POST['user_id'] ?>" />
		<?php
		ini_set('display_errors',0);
		
		
		error_reporting(E_ALL);
		$db =new mysqli('localhost', 'root', '', 'hospital_dev')or die('Błąd !: ' . mysql_error());
		
		$result = $db->query("SELECT users.* FROM users where user_id=".$_POST['user_id']);
		while($row = $result->fetch_assoc()){
		echo '
		
	<div class="input-group">
  <span class="input-group-addon">ID pacjenta</span>
  <input type="text" id="user_id" name="user_id" class="form-control" value="'.$_POST['user_id'].'" readonly></div>
   <div class="input-group">
  <span class="input-group-addon">Kod<span style="color: red">*</span></span>
  <input type="text" name="stay_code" id="stay_code" class="form-control" placeholder="Wpisz kod wizyty"  autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź kod wizyty"></div>
  <div class="input-group">
  <span class="input-group-addon">Data wpisania</span>
  <input type="date" id="date_from"  name="date_from" class="form-control" placeholder="Podaj datę w formacie rrrr-mm-dd"></div>
	 <div class="input-group">
  <span class="input-group-addon">Oddział</span>
  <select id="ward_id" name="ward_id" class="form-control" placeholder="Wpisz oddział" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź oddział">
  
  <option value="1">Dzieciecy</option>
  <option value="2">Chirurgiczny</option>
  
  <select></div>
  <div class="input-group">
  <span class="input-group-addon">Kod karty<span style="color: red">*</span></span>
  <input type="text" name="record_code" id="record_code" class="form-control" placeholder="Wpisz kod wizyty"  autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź rekord karty"></div>
  
  
  ';}
  $db->close();
  ?>

        <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value=Przyjmij ></a></p>


      
         

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




