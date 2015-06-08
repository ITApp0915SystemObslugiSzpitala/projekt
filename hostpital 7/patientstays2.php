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
	<script type="text/javascript">
	
	function pop()
	{
	$('[data-toggle="popover"]').popover('hide');
$('[data-toggle="popover"]').popover();
	}
	




  </script>
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
<form action="patientaction.php?stayid=<?php echo $_GET['id'];?>&patient=<?php echo $_GET['patient'];?>&recordid=<?php echo $_GET['recordid'];?>" method=post ">
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
	  
        <h3>Szczegóły pobytu na oddziale</h3>
      
<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
	<br>

	<?php
	

ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'root', '', 'hospital_dev')or die('Błąd !: ' . mysql_error());


        
 echo '<div class="row">
 <div class="col-md-6">
 <table class="table">
            <thead>
              <tr>
			  
                <th>Sala</th>
                <th>Typ operacji</th>
                <th>Data</th>
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT patient_operations.*, operation_codes.*, rooms.*  FROM record_items, patient_operations, operation_codes, rooms where patient_operations.record_item_id ='".$_GET['recordid']."'  AND patient_operations.record_item_id = record_items.record_item_id AND patient_operations.operation_code=operation_codes.operation_code AND rooms.room_id=patient_operations.room_id");
//echo  "SELECT patient_operations.*, operation_codes.*, rooms.*  FROM record_items, patient_operations, operation_codes, rooms where record_items.patient_stay_id='".$_GET['id']."' AND patient_operations.record_item_id ='".$_GET['recordid']."'  AND patient_operations.record_item_id = record_items.record_item_id AND patient_operations.operation_code=operation_codes.operation_code AND rooms.room_id=patient_operations.room_id";
echo '<h4>Operacje</h4>';
while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                <td>'.$row{'room_code'}.'</td>
				
                <td>'.$row{'short_description'}.'</td>
                <td>'.$row{'date_from'}.'</td>
              </tr>';
}

	

echo '</tbody>
          </table>
		  ';
     
	  
	  
	  
	
	  

?>
<h5>Nowa operacja</h5>
<div class="input-group">
  <span class="input-group-addon">Data operacji</span>
  <input type="date" id="date_from"  name="date_from" class="form-control" placeholder="Podaj datę w formacie rrrr-mm-dd"></div>
	
 <div class="input-group">
  <span class="input-group-addon">Rodzaj operacji</span>
  <select id="operation_code" name="operation_code" class="form-control" placeholder="Wpisz oddział" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź oddział">
  
  <option value="XBL">Serca</option>
  <option value="2">D</option>
  
  <select></div>
  <div class="input-group">
  <span class="input-group-addon">Sala</span>
  <select id="room_id" name="room_id" class="form-control" placeholder="Wpisz oddział" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź salę operacji">
  
  <option value="0">A</option>
  <option value="1">B</option>
  
  <select></div>
  
  <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value="Dodaj operacje" ></a></p>
        </div>
		<!-- -->
	<?php echo	'<div class="col-md-6">
 <table class="table">
            <thead>
              <tr>
			  
                <th>Data</th>
                <th>Typ diagnozy</th>
                <th>Komentarz</th>
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT diagnoses.*, comments.*, record_items.*, diagnose_codes.* FROM diagnoses, comments, record_items, diagnose_codes where diagnoses.record_item_id ='".$_GET['recordid']."'  AND diagnoses.record_item_id = record_items.record_item_id AND diagnoses.diagnose_code=diagnose_codes.diagnose_code AND comments.comment_id=diagnoses.comment_id");
//echo  "SELECT diagnoses.*, comments.*, record_items.*, diagnose_codes.* FROM diagnoses, comments, record_items, diagnose_codes where record_items.patient_stay_id='".$_GET['id']."' AND diagnoses.record_item_id ='".$_GET['recordid']."'  AND diagnoses.record_item_id = record_items.record_item_id AND diagnoses.diagnose_code=diagnose_codes.diagnose_code AND comments.comment_id=diagnoses.comment_id";
echo '<h4>Diagnozy</h4>';
$i=0;
while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                <td>'.substr($row{'created_on_date'},0,-8).'</td>
				
                <td>'.$row{'short_description'}.'</td>
				<td><button type="button" class="btn btn-default" data-container="body" data-toggle="popover" onClick=pop()  data-placement="bottom" data-content="'.$row{'comment_text'}.'">
  Komentarz
</button></td>
              </tr>';
}

	

echo '</tbody>
          </table>
		  ';
     
	  
	  
	  
	
	  
$db->close();
?>
<h5>Nowa diagnoza</h5>
<div class="input-group">
  
 <div class="input-group">
  <span class="input-group-addon">Typ diagnozy</span>
  <select id="diagnose_code" name="diagnose_code" class="form-control" placeholder="Wpisz diagnoze" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź typ diagnozy">
  
  <option value="A">Rutynowe badanie</option>
  <option value="B">USG</option>
  
  <select></div>
  <div class="input-group">
  <span class="input-group-addon">Komentarz<span style="color: red">*</span></span>
  <textarea id="comment" name="comment" rows="4" cols="50" class="form-control" placeholder="Wpisz komentarz" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź komentarz"></textarea></div>
  
  
  <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value="Dodaj diagnoze" ></a></p>
        </div>
		<!-- -->
		</div>
	
	
<br>


      

            
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




