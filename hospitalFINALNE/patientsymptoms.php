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
<form action="patientaction.php?stayid=<?php echo $_GET['id'];?>&patient=<?php echo $_GET['patient'];?>&recordid=<?php echo $_GET['recordid'];?>&diagnoseid=<?php echo $_GET['diagnoseid'];?>" method=post ">
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
	  
        <h3>Symptomy</h3>
      
<?php
	if(strlen($message)!=0)
	{echo $message;}
	?>
	<br>

	<?php
	

ini_set('display_errors',1);
error_reporting(E_ALL);
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());


        
 echo '<div class="row">
 
 <table class="table">
            <thead>
              <tr>
			  
                <th>ID</th>
				<th>Symptom</th>
                <th>Przepisany lek</th>
                
				
              </tr>
            </thead>
			<tbody>';
$result = $db->query("SELECT symptoms.*,  drugs.*, comments.*  FROM symptoms, symptom_drugs, drugs, comments where symptoms.diagnose_id ='".$_GET['diagnoseid']."'  AND symptoms.symptom_id = symptom_drugs.symptom_id AND symptom_drugs.drug_id=drugs.drug_id AND symptoms.comment_id=comments.comment_id");
//echo  "SELECT symptoms.*, symptom_drugs.*, drugs.*  FROM symptoms, symptoms_drugs, drugs where symptom.diagnose_id ='".$_GET['diagnoseid']."'  AND symptoms.symptom_id = symptom_drugs.symptom_id AND symptom_drugs.drug_id=drugs.drug_id AND symptoms.comment_id=comments.comment_id";
//echo '<h4>Operacje</h4>';
while($row = $result->fetch_assoc()){
   
   echo '<tr>
				
                <td>'.$row{'diagnose_id'}.'</td>
				<td>'.$row{'comment_text'}.'</td>
                <td>'.$row{'drug_name'}.'</td>
				
                
              </tr>';
}

	

echo '</tbody>
          </table>
		  ';
     
	  
	  
	  
	
	  

?>
<h5>Nowy lek</h5>

  <div class="input-group">
  <span class="input-group-addon">Symptom<span style="color: red">*</span></span>
  <textarea id="comment" name="comment" rows="4" cols="50" class="form-control" placeholder="Wpisz symptom" autocomplete="off" data-toggle="popover" onClick=pop()  data-content="Wprowadź symptom"></textarea></div>
	<?php
$db =new mysqli('localhost', 'HOSPITAL', 'password', 'HOSPITAL_DEV')or die('Błąd !: ' . mysql_error());

$result = $db->query("SELECT drugs.* FROM drugs  ");








echo '
 <div class="input-group">
  <span class="input-group-addon">Wybrany lek</span>
  <select id="drug_code" name="drug_code" class="form-control" placeholder="Lek" autocomplete="off"  data-toggle="popover" onClick=pop()  data-content="Wprowadź lek">
 ';
 while($row = $result->fetch_assoc()){ echo '
  <option value="'.$row{'drug_id'}.'">'.$row{'drug_description'}.'</option>';}
  
  echo '
  <select></div>
  ';?>

  
  <p><input type="submit" id="button1" name="button" class="btn btn-primary btn-lg" role="button" value="Dodaj lek" ></a></p>
        </div>
		<!-- -->
	
	
	
<br>


      

            
           

	</div>
    </div> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  
</html>




