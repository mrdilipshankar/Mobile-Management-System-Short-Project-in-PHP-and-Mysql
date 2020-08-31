<?php
include_once("config.php");
include_once("inc/header.php");

?>
<?php

$conn = mysqli_connect("localhost","root","","mobilereg");


if(isset($_REQUEST['datasubmit']))
{
   
  $empid = $_POST['empid'];
  $empname = $_POST['empname'];
  $empmobile = $_POST['empmobile'];
  $emphandset = $_POST['emphandset'];
  $myselectbox = $_POST['myselectbox'];
  
  date_default_timezone_set('Asia/Kolkata');
  $statustime = date('d-m-Y h:i:s', time());

  if(empty($empid) && empty($empname) && empty($empmobile) && empty($emphandset) && empty($myselectbox)) 
  {
    echo "<script>alert('All Field Required')</script>";
  }
  else
  {


  $sqldatas = "INSERT INTO dashboard_data(employee_id,employee_name,employee_mobile,employee_handset,employee_status,data_time ) VALUES('$empid','$empname','$empmobile','$emphandset','$myselectbox','$statustime')";

  $sqlfetch = mysqli_query($conn,$sqldatas);
  
  header('Location:dashboard.php');
  exit;
 
  
 

}
}
?>
<?php
$sqlempdata = "SELECT * FROM dashboard_data";
  $dataresult = mysqli_query($conn,$sqlempdata);
?>

  	<section class="sil-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="sil-head">
							<h2>Mobile Entry Application</h2>
							<p>Entry your mobile handsets...</p>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="tlname">
                <?php 
                if($_SESSION["email"] == true)
                {

                  echo "<h5>".$_SESSION["email"]."</h5>";
                  
                }
                ?>      
            </div>
					</div>
          <div class="col-lg-1">
            <a href="index.php" class="btn btn-danger">Logout</a>
          </div>
				</div>
				<div class="row float-right">
					<div class="col-lg-12">
						<form method="post" class="form-inline" onsubmit="return dashboardForm()" name="dashboardform">
              <div class="form-group mx-1">
							<input type="" name="empid" placeholder="Employee Id" class="form-control" id="impid" value="" minlength="5" title="" autocomplete="on">
              </div><div class="form-group mx-1">
							<input type="" name="empname" placeholder="Employee Name" class="form-control" id="">
              </div><div class="form-group mx-1">
							<input type="" name="empmobile" placeholder="Mobile Number" class="form-control" minlength="8" maxlength="10" >
              </div><div class="form-group mx-1">
							<input type="" name="emphandset" placeholder="Handset Model" class="form-control">
              </div><div class="form-group mx-1">
                <select class="form-control" name="myselectbox">
                  <option name="intime" value="" disabled selected>Set Time</option>
                  <option name="intime" value="In Time">Check In</option>
                  <option name="outime" value="Out Time">Check Out</option>
                </select>
                </div><div class="form-group mx-1">
							<input type="submit" name="datasubmit" value="Submit" class="btn btn-dark">
            </div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<section class="sil-table">
			<table class="table table-dark table-hover container" id="mobiledata">
    <thead>
      <tr>
        <th>Check</th>
        <th>Employee Id</th>
        <th>Employee Name</th>
        <th>Mobile No.</th>
        <th>Handset Model</th>
        <th>Status</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        
        
          <?php 
          if(!isset($dataresult)=="")
          {

            while($myrows = mysqli_fetch_assoc($dataresult))
                {
                  echo 
                  "<tr>
                  <td><input type='radio' name='checkstuts' id='mycheckout'></td>
                  <td>SIPLIND{$myrows['employee_id']}</td>
                  <td>{$myrows['employee_name']}</td>
                  <td>{$myrows['employee_mobile']}</td>
                  <td>{$myrows['employee_handset']}</td>
                  <td>{$myrows['employee_status']}</td>
                  <td>{$myrows['data_time']}<td>
                  </tr>"
                  ;
                }
              
                }
                
                ?>
          
        </tr>
        
      
    </tbody>
  </table>

		</section>

    <section class="footer-blk">
        <p>Silaris &copy; 2020 | Mobile Entry Application</p>
    </section>
		
<?php

include_once("inc/footer.php");

?>

 <script type="text/javascript">
 
  function dashboardForm() {
  var a = document.forms["dashboardform"]["empid"].value;
  var b = document.forms["dashboardform"]["empname"].value;
  var c = document.forms["dashboardform"]["empmobile"].value;
  var d = document.forms["dashboardform"]["emphandset"].value;
  var ef = document.forms["dashboardform"]["myselectbox"].value;

  if (a == "" ) {
    alert("Employee ID must be filled out");
    return false;
  }
  if(!a.match(/^\d+/))
  {
    alert("Only Numeric character minium length 5 words");
    return false;
  }
  if(b == "")
  {
    alert("Employee Name must be filled out");
    return false;
  }
  if(c == "")
  {
    alert("Mobile Number must be filled out");
    return false;
  }
  if(d == "")
  {
    alert("Handset must be filled out");
    return false;
  }

}
</script> 