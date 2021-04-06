
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peradeniya Dentals Patient Registration</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	 <link href="https://fonts.googleapis.com/css?family=Markazi+Text" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  </head>

<body>

<section id="top" class="clearfix">
 <div class="container">
  <div class="row">
   <div class="top clearfix">
    <div class="col-sm-6 top_left clearfix">
	 <div class="top_left_inner">
	  <h5>Peradeniya Dentals Hospital</h5>
	 </div>
	</div>
	<div class="col-sm-6 top_right clearfix">
	 <div class="top_right_inner">
	  <ul>
	   <li><i class="fa fa-map-marker"></i>Location: 494,Hospital Road,Jaffna</li>
	   <li><i class="fa fa-phone"></i>24/7 Emergency  <a href="#"> 021-2227655</a></li>
	  </ul>
	 </div>
	</div>
   </div>
  </div>
 </div>
</section>

<section id="header"  class="cd-secondary-nav">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><span class="liner_1">Peradeniya</span><span class="liner_2">Dentals</span></a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="index.php">HOME</a>
                    </li>
                     
                    <li>
                        <a class="" href="about.php">ABOUT US</a>
                    </li>
					
					<li>
                        <a class="" href="patientappointment.php">APPOINMENT</a>
                    </li>
                    <li>
                        <a class= "" href="contact.php">CONTACT US</a>
                    </li>
                    <li>
                        <a class="active_tag" href="patient.php">REGISTRATION</a>
                    </li>
					
                </ul>
			
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</section>




<?php
session_start();
include("x.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE patientid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('patients record inserted successfully...');</script>";
		$insid= mysqli_insert_id($con);
		if(isset($_SESSION[adminid]))
		{
		echo "<script>window.location='patientappointment.php?patid=$insid';</script>";	
		}
		else
		{
		echo "<script>window.location='index.php';</script>";	
		}		
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Patient profile Registration Panel</h1>
    <form method="post" action="" name="frmpatient" onSubmit="return validateform()">
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="34%">Patient Name</td>
          <td width="66%"><input type="text" name="patientname" id="patientname"  value="<?php echo $rsedit[patientname]; ?>"/></td>
        </tr>
<?php
if(isset($_GET[editid]))
{
?>       
        <tr>
          <td>Admission Date</td>
          <td><input type="date" name="admissiondate" id="admissiondate" value="<?php echo $rsedit[admissiondate]; ?>" readonly /></td>
        </tr>
        <tr>
          <td>Admission Time</td>
          <td><input type="time" name="admissiontme" id="admissiontme" value="<?php echo $rsedit[admissiontime]; ?>" readonly /></td>
        </tr>
<?php
}
?>
        <tr>
          <td>Address</td>
          <td><textarea name="address" id="address" cols="45" rows="5"><?php echo $rsedit[address]; ?></textarea></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>" /></td>
        </tr>
        <tr>
          <td>City</td>
          <td><input type="text" name="city" id="city" value="<?php echo $rsedit[city]; ?>" /></td>
        </tr>
        <tr>
          <td>PIN Code</td>
          <td><input type="text" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" /></td>
        </tr>
        <tr>
          <td>Login ID</td>
          <td><input type="text" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid]; ?>"/></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>" /></td>
        </tr>
        <tr>
          <td>Confirm Password</td>
          <td><input type="password" name="confirmpassword" id="confirmpassword"  value="<?php echo $rsedit[confirmpassword]; ?>"/></td>
        </tr>
        <tr>
          <td>Blood Group</td>
          <td><select name="select2" id="select2">
           <option value="">Select</option>
          <?php
		  $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[bloodgroup])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><select name="select3" id="select3">
           <option value="">Select</option>
          <?php
		  $arr = array("MALE","FEMALE");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[gender])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select></td>
        </tr>
        <tr>
          <td>Date Of Birth</td>
          <td><input type="date" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>" id="dateofbirth"  value="<?php echo $rsedit[dob]; ?>"/></td>
        </tr>
       
          
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<section id="footer_main" class="clearfix">
	 <div class="col-sm-12 space_all">
	  <div class="footer_main_1">
	  <h4> <a href="adminlogin.php">Admin Login Panel</a> | <a href="doctorlogin.php">Doctor Login Panel</a></h4>
	    <p>© 2021 Peradeniya Dentals. All Rights Reserved. Design by<a href=https://peradeniyadent.com/"> Y2S2G1</a> </p>
	  </div>
	 </div>
</section>
 </div>
</div>
</section>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmpatient.patientname.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmpatient.patientname.focus();
		return false;
	}
else if(!document.frmpatient.patientname.value.match(alphaspaceExp))
	{
		alert("Patient name not valid..");
		document.frmpatient.patientname.focus();
		return false;
	}
	else if(document.frmpatient.admissiondate.value == "")
	{
		alert("Admission date should not be empty..");
		document.frmpatient.admissiondate.focus();
		return false;
	}
	else if(document.frmpatient.admissiontme.value == "")
	{
		alert("Admission time should not be empty..");
		document.frmpatient.admissiontme.focus();
		return false;
	}
	else if(document.frmpatient.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmpatient.address.focus();
		return false;
	}
	else if(document.frmpatient.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(!document.frmpatient.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatient.city.value == "")
	{
		alert("City should not be empty..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(!document.frmpatient.city.value.match(alphaspaceExp))
	{
		alert("City not valid..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(document.frmpatient.pincode.value == "")
	{
		alert("Pincode should not be empty..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(!document.frmpatient.pincode.value.match(numericExpression))
	{
		alert("Pincode not valid..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(document.frmpatient.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(!document.frmpatient.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(document.frmpatient.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value != document.frmpatient.confirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmpatient.confirmpassword.focus();
		return false;
	}
	else if(document.frmpatient.select2.value == "")
	{
		alert("Blood Group should not be empty..");
		document.frmpatient.select2.focus();
		return false;
	}
	else if(document.frmpatient.select3.value == "")
	{
		alert("Gender should not be empty..");
		document.frmpatient.select3.focus();
		return false;
	}
	else if(document.frmpatient.dateofbirth.value == "")
	{
		alert("Date Of Birth should not be empty..");
		document.frmpatient.dateofbirth.focus();
		return false;
	}
	else if(document.frmpatient.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmpatient.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>