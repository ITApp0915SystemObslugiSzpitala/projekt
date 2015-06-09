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

  
	<form action="patientaction.php" id="city" method=post "> 
    
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
            <li><a href="przypiszrole.php">Przypisz Rolę</a></li>
            
        
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

        <h3>Edytuj dnae pacjenta/ użytkownika</h3>

        <div>
		<?php
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());






	if(strlen($message)!=0)
	{echo $message;}




$result = $db->query("SELECT patients.* FROM patients where patient_id=".$_GET['id']."  ");






while($row = $result->fetch_assoc()){
   
   echo '<div class="input-group">
  <span class="input-group-addon">ID<span style="color: red">*</span></span>
  <input type="int" name="ud_patient_id" id="ud_patient_id" class="form-control" value="'.$row{'patient_id'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź imie użytkownika(Max 45 znaków)"></div>
   <div class="input-group">
  <span class="input-group-addon">Imię<span style="color: red">*</span></span>
  <input type="text" name="ud_forename" id="ud_forename" class="form-control" value="'.$row{'forename'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź imie użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Nazwisko<span style="color: red">*</span></span>
  <input type="text" id="ud_surname" name="ud_surname" class="form-control" value="'.$row{'surname'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź nazwisko użytkownika(Max 45 znaków)"></div>
  <div class="input-group">
  <span class="input-group-addon">Płeć<span style="color: red">*</span></span>
  <select id="ud_gender" name="ud_gender" class="form-control" value="'.$row{'gender'}.'" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź płeć">
  
  <option value="M">M</option>
  <option value="K">K</option>
  
  <select></div>
 
  <div class="input-group">
  <span class="input-group-addon">Miejsce urodzenia<span style="color: red">*</span></span>
  <input type="text" id="ud_birth_place" name="ud_birth_place" class="form-control" value="'.$row{'birth_place'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź miejsce urodzenia (Miasto)"></div>
 

 
    

<p><input type="submit" id="button2" name="button" class="btn btn-primary btn-lg" role="button" value=Aktualizuj ></a></p>
      </div>
  </div> 
  </div> 

  ';}







 
$db->close();


?>
</div>


<div>
  <?php
  $db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());






  if(strlen($message)!=0)
  {echo $message;}
$result = $db->query("SELECT addresses.*, patient_addresses.* FROM addresses, patient_addresses where patient_id=".$_GET['id']."   ");






while($row = $result->fetch_assoc()){
   
   echo '

 <div class="input-group">
  <span class="input-group-addon">Ulica<span style="color: red">*</span></span>
  <input type="text" id="ud_street_name" name="ud_street_name" class="form-control" value="'.$row{'street_name'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź ulicę"></div>
 

   <div class="input-group">
  <span class="input-group-addon">Numer Lokalu<span style="color: red">*</span></span>
  <input type="text" id="ud_street_number" name="ud_street_number" class="form-control" value="'.$row{'street_number'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź numer lokalu"></div>
      
     <div class="input-group">
  <span class="input-group-addon">Miasto<span style="color: red">*</span></span>
  <input type="text" id="ud_city" name="ud_city" class="form-control" value="'.$row{'city'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź nazwę miasta"></div>
 
  <div class="input-group">
  <span class="input-group-addon">Kod Pocztowy<span style="color: red">*</span></span>
  <input type="text" id="ud_postal_code" name="ud_postal_code" class="form-control" value="'.$row{'postal_code'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź kod pocztowy"></div>
 
<div class="input-group">
  <span class="input-group-addon">Kraj<span style="color: red">*</span></span>
  <input type="text" id="ud_country" name="ud_country" class="form-control" value="'.$row{'country'}.'" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź kraj"></div>
 

    

<p><input type="submit" id="button2" name="button" class="btn btn-primary btn-lg" role="button" value=Aktualizuj ></a></p>
      </div>
  </div> 
  </div> 

  ';}







 
$db->close();


?>
</div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  
</html>
