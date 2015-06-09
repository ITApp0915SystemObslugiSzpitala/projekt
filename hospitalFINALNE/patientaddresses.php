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
<form action="patientaction.php?id=<?php echo $_GET['id'];?>" method=post ">
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
	  
        <h3>Adresy pacjenta</h3>
      
<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>

	<?php
	

ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());
$result = $db->query("SELECT patients.*  FROM patients where patient_id='".$_GET['id']."' ");
while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                <td>'.$row{'forename'}.'</td>
				
                <td>'.$row{'surname'}.'</td>
                
              </tr>';
}
echo '<div class="row">
        
          <table class="table">
            <thead>
              <tr>
			  
                
                <th>Ulica</th>
				<th>Numer ulicy/lokalu</th>
				<th>Miasto</th>
                <th>Kod</th>
				<th>Kraj</th>
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT patient_addresses.*, addresses.* FROM patient_addresses, addresses where patient_addresses.patient_id='".$_GET['id']."' AND patient_addresses.address_id = addresses.address_id");
//echo  "SELECT patient_identity_docs.*, identity_documents.*, type_items.*  FROM patient_identity_docs, identity_documents, type_items where patient_identity_docs.patient_id='".$_GET['id']."' AND patient_identity_docs.identity_document_id = identity_documents.identity_document_id JOIN identity_documents ON identity_documents.document_type_id=type_items.type_id";

while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                
				
                <td>'.$row{'street_name'}.'</td>
				<td>'.$row{'street_number'}.'</td>
				<td>'.$row{'city'}.'</td>
                <td>'.$row{'postal_code'}.'</td>
				<td>'.$row{'country'}.'</td>
              </tr>';
}

	

echo '</tbody>
          </table>';
          
	  
		
  
     
	  
	  
	  
	
	  
$db->close();
?>
<h5>Nowy adres</h5>
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
  <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value="Dodaj adres" ></a></p>
        </div>
<br>


      

            
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




