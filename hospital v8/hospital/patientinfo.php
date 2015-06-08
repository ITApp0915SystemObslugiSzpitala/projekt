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
<form action="patientaction.php" method=post ">
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
        <h3>Dane pacjenta</h3>
      


	<?php
	

ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost:3306', 'root', 'haslo123', 'hospital_dev')or die('Błąd !: ' . mysql_error());
$result = $db->query("SELECT patient_identity_docs.*, identity_documents.* FROM patient_identity_docs, identity_documents where patient_identity_docs.default_flg='1' AND patient_identity_docs.identity_document_id=identity_documents.identity_document_id AND patient_identity_docs.patient_id=".$_GET['id']);


while($row = $result->fetch_assoc()){
$doku=$row{'document_number'};

}
$result = $db->query("SELECT patients.* FROM patients where patient_id=".$_GET['id']);
		while($row = $result->fetch_assoc()){
		echo '
		
	<div class="table-responsive">
    <table class="table table-bordered table-striped">
      
      <tbody>
        <tr>
          <th class="text-nowrap" scope="row">Imię</th>
          <td>'.$row{'forename'}.'</td>
        </tr>
        <tr>
          <th class="text-nowrap" scope="row">Nazwisko</th>
          <td>'.$row{'surname'}.'</td>
          
        </tr>
        <tr>
          <th class="text-nowrap" scope="row">Płeć</th>
          <td>'.$row{'gender'}.'</td>
          
        </tr>
        <tr>
          <th class="text-nowrap" scope="row">Data urodzenia</th>
          <td >'.substr($row{'birth_date'},0,-8).'</td>
        </tr>
        <tr>
          <th class="text-nowrap" scope="row">Miejsce urodzenia</th>
          <td >'.$row{'birth_place'}.'</td>
          
        </tr>';
		
        echo '
      </tbody>
    </table>
  </div>';}
echo '<div class="row">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
			  <th></th>
                <th>Od</th>
                <th>Do</th>
                <th>Kod</th>
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT patient_stays.* FROM patient_stays where patient_id=".$_GET['id']);

while($row = $result->fetch_assoc()){
   
   echo '<tr>
				<td>'.'<input name="patient_stay_id" id="patient_stay_id" type="radio" visibility: hidden checked value='.$row{'patient_stay_id'}.'>'.'</td>
                <td>'.substr($row{'date_from'},0,-8).'</td>
				
                <td>'.substr($row{'date_to'},0,-8).'</td>
                <td>'.$row{'stay_code'}.'</td>
				<td><a href="patientstays.php?patient='.$_GET{'id'}.'&id='.$row{'patient_stay_id'}.'">Więcej...</a></td>
              </tr>';
}

	

echo '</tbody>
          </table>
        
        </div>
      </div>';
	  
	   $result = $db->query("SELECT patient_stays.* FROM patient_stays where patient_id=".$_GET['id']." AND date_to IS NULL");

if ($result->num_rows!=0){
echo '<p><input type="submit" name="button" onClick="return confirmDelete();" class="btn btn-lg btn-danger" role="button" value="Wypisz"></a> ' ;
}
	  
$db->close();
?>
<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $doku;?>&choe=UTF-8" title="Patient ID" align="right"/>
<a href="patientdocs.php?id=<?php echo $_GET['id'];?>" class="btn btn-primary btn-lg">Dokumenty</a>
<a href="patientaddresses.php?id=<?php echo $_GET['id'];?>" class="btn btn-primary btn-lg">Adresy</a>
<br><br><br><br><br><br>
      

            
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




