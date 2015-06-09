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
<form action="patientaction.php?stayid=<?php echo $_GET['id'];?>&patient=<?php echo $_GET['patient'];?>" method=post ">
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
	  
        <h3>Wizyta pacjenta</h3>
      
<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
	<br>
<h4>Karty wizyt na oddziałach</h4>
	<?php
	

ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());

echo '<div class="row">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
			  
                <th>Nazwa oddziału</th>
                <th>Od</th>
                <th>Kod</th>
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT patient_records.*, record_items.*, wards.*  FROM patient_records, record_items, wards where record_items.patient_stay_id='".$_GET['id']."' AND patient_records.patient_record_id = record_items.patient_record_id AND wards.ward_id = patient_records.ward_id");
//echo  "SELECT patient_records.*, record_items.*, wards.*  FROM patient_records, record_items, wards where record_items.patient_stay_id='".$_GET['id']."' AND patient_records.patient_record_id = record_items.patient_record_id AND wards.ward_id = patient_records.ward_id";

while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                <td>'.$row{'ward_name'}.'</td>
				
                <td>'.substr($row{'date_from'},0,-8).'</td>
                <td>'.$row{'record_code'}.'</td>
				<td><a href="patientstays2.php?patient='.$_GET{'patient'}.'&id='.$_GET{'id'}.'&recordid='.$row{'patient_record_id'}.'">Więcej...</a></td>
              </tr>';
}

	

echo '</tbody>
          </table>
		  ';
          
	  


$result = $db->query("SELECT patient_operations.*, operation_codes.*  FROM record_items, patient_operations, operation_codes where record_items.patient_stay_id='".$_GET['id']."' AND patient_operations.record_item_id = record_items.record_item_id AND patient_operations.operation_code=operation_codes.operation_code");
//echo  "SELECT DISTINCT patient_operations.*  FROM record_items, patient_operations, operation_codes where record_items.patient_stay_id='".$_GET['id']."' AND patient_operations.record_item_id = record_items.record_item_id join patient_operations on patient_operations.operation_code=operation_codes.operation_code";



	


	  
	  
	  
	
	  

?>
<h5>Nowa karta</h5>
<div class="input-group">
  <span class="input-group-addon">Data wpisania</span>
  <input type="date" id="date_from"  name="date_from" class="form-control" placeholder="Podaj datę w formacie rrrr-mm-dd"></div>
	
  <?php


$result = $db->query("SELECT wards.* FROM wards  ");








echo '
 <div class="input-group">
  <span class="input-group-addon">Oddział</span>
  <select id="ward_id" name="ward_id" class="form-control" placeholder="Wpisz oddział" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź oddział">
  ';
  $db->close();
 while($row = $result->fetch_assoc()){ echo '
  <option value="'.$row{'ward_id'}.'">'.$row{'ward_name'}.'</option>';}
  
  echo '
  <select></div>
  ';?>
  <div class="input-group">
  <span class="input-group-addon">Kod karty<span style="color: red">*</span></span>
  <input type="text" name="record_code" id="record_code" class="form-control" placeholder="Wpisz kod wizyty"  autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź rekord karty"></div>
  <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value="Dodaj karte" ></a></p>
        </div>
<br>


      

            
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




