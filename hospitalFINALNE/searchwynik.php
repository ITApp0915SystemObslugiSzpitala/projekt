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
  
<form action="patientedit.php" method=post ">
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
            <li><a href="przypiszrole.php">Przypisz Rolę</a></li>
            
        
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
        <h3>Lista pacjentów</h3>
      <?php
	if(strlen($message)!=0)
	{echo $message;}
	?>


	<?php
	

ini_set('display_errors',0);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());
echo '<div class="row">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                
				<th>Urodzony</th>
				<th>Płeć</th>
              </tr>
            </thead>
			<tbody>';
			



$result = $db->query("SELECT patients.* FROM patients where patients.surname LIKE '%".$_POST['search']."%' ");




while($row = $result->fetch_assoc()){
   
   echo '<tr> 	

                <td>'.'<input name="patient_id" id="patient_id" type="radio" checked value='.$row{'patient_id'}.'>'.'</td>
                <td>'.$row{'forename'}.'</td>
                <td>'.$row{'surname'}.'</td>
				<td>'.substr($row{'birth_date'},0,-8).'</td>
				<td>'.$row{'gender'}.'</td>
              </tr>';
}
echo '</tbody>
          </table>
        
        </div>
      </div>';
	

$db->close();

if ($_POST["button"]=="Szukaj"){
echo '<p><input type="submit" name="button" onClick="return confirmDelete();" class="btn btn-lg btn-danger" role="button" value="Przyjmij"></a>';
}
if ($_POST["button"]=="Szukaj pacjenta"){
echo '<p><input type="submit" name="button" onClick="return confirmDelete();" class="btn btn-lg btn-danger" role="button" value="Wybierz"></a>';
}
?>
   

<!--<input type="submit" name="button" class="btn btn-primary btn-lg" role="button" value="Edytuj"></a></p> -->           
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




