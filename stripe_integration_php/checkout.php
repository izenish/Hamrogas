   <?php
  $gmail= @$_GET['id'];
  $gasname= @$_GET['gas'];

  error_reporting(0);

  if (isset($_POST['add_order'])) {
    error_reporting(0);
    if(isset($_FILES['image'])){
     // echo "<pre>";print_r($_FILES['image']);echo "</pre>";
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }           

     if($file_size > 2097152){
       $errors[]='File size must be less than or equal to 2 MB';
     }

     if(empty($errors)==true){
       move_uploaded_file($file_tmp,"files/".$file_name);

     }else{
       print_r($errors);
     }
   }

   if(isset($_FILES['image1'])){
      //echo "<pre>";print_r($_FILES['image1']);exit;
    $errors= array();
    $file_name1 = $_FILES['image1']['name'];
    $file_size1 =$_FILES['image1']['size'];
    $file_tmp1 =$_FILES['image1']['tmp_name'];
    $file_type1=$_FILES['image1']['type'];
    $file_ext1=strtolower(end(explode('.',$_FILES['image1']['name'])));

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext1,$extensions)=== false){
     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
   }

   if($file_size1 > 2097152){
     $errors[]='File size must be less than or equal to 2 MB';
   }

   if(empty($errors)==true){
     move_uploaded_file($file_tmp1,"files/".$file_name1);



   }else{
     print_r($errors);
   }
 }
 $otp="";
while ($otp=='')
 { 
  $otp=random_int(100000, 999999); //This is one time password generator.

require_once("dbConnect.php");

$sqlq = "SELECT code FROM `customer` WHERE `code`= '$otp'";
$resultq = mysqli_query($conn, $sqlq);
$rowq = mysqli_fetch_assoc($resultq);
//$data = mysqli_num_rows($result);
 //echo "<pre>"; print_r($result); 
if (mysqli_num_rows($resultq) > 0){
 $otp="";
}

}


  // echo "Nepal";exit();
    $u = $_POST['first_name'];
    $e = $_POST['email'];
    $p = $_POST['last_name'];
    $a = $_POST['item'];
    $b = $_POST['purpose'];
    $c = $_POST['paymentMethod'];
    $d = $_POST['quantity'];
    $f = $_POST['phone_number'];
    $g = $file_name;
    $h = $_POST['address'];
    $i = $file_name1;
    $j = $otp;
    $lat=$_POST['latitude'];
    $long=$_POST['longitude'];
  
//   // echo "Nepal";exit();


    $sql = "INSERT INTO `customer` (`first_name`, `email`,`last_name`,`item`,`purpose`,`payment`,`quantity`,`phone_number`,`profile`,`address`,`citizenship_card`,`code`,`latitude`,`longitude`)
    VALUES ('$u', '$e', '$p', '$a', '$b', '$c', '$d', '$f', '$g', '$h', '$i', '$j','$lat','$long');";
  //echo $sql;

  require_once("DBConnect.php");

    if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully.


  // ---------To send an email-----------
  $message_body = "Use this code to confirm your order. :<br/><br/>" . $otp;
  require_once('phpmailer\otp-mail.php');
  $mail->MsgHTML($message_body);      
echo $e;
  // $mail->Body= "This is plain text email body";
  $mail->addAddress($e);
  $mail->SMTPDebug =0;

  if($mail->Send())
  {
    echo "<script>alert('We have sent you an email to confirm your order.');</script>";
  }
  else
  {
    echo "<script>alert('Error occured');</script>";
  }
  $mail->smtpClose();
  // -----mail part close----



      if($c=="COD"){
       echo "<script>alert('Cash on delivery');</script>";
       header("Location: order_confirmcode.php?id=$e");
     //header("Location: Cash_on_delivery.php?id=$e");
     }
     else
     {
  // echo "<script>window.location:'../../stripe_integration_php';</script>";
  
     //header("Location: ../../stripe_integration_php/get_customer.php?id= $e");
    // header("Location: orderpage.php?id=$e");
      header("Location: order_confirmcode.php?id=$e");
    }
  } else {
    echo "<script>alert('please enter another email address')</script> ";
    // header("location:'checkout.php'");
  }
  mysqli_close($conn);
}
?>

<?php
  // echo "Nepal";exit();
require_once("DBConnect.php");

$sql = "SELECT purpose FROM `item` WHERE 1 Limit 0, 10";
$result = mysqli_query($conn, $sql);
// $data = mysqli_num_rows($result);
//   echo "<pre>"; print_r($result); 
//   exit(0);
$sql1 = "SELECT title FROM `gas_cylinders` WHERE stock>='5'";
$result1 = mysqli_query($conn, $sql1);
// $data = mysqli_num_rows($result1);
//   echo "<pre>"; print_r($result1);
$sql2 = "SELECT type FROM `item` WHERE 1 Limit 0, 10";
$result2 = mysqli_query($conn, $sql2);
  //$data = mysqli_num_rows($result);
  //echo "<pre>"; print_r($result); exit();
?>


<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="sty.css">
       <!-- Custom css -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="../css/responsive.css">

<title>checkout</title>
<style type="text/css">
  @media (max-width: 1992px)
  {
   body{   
    background: url("images/statement1.jpg");
    background-size: cover;
    height: 110vh;
    width: 100%;
    z-index: -2;

  }
}

@media (max-width: 768px)
{
 body{   
 /* background: url("images/statement1.jpg");*/
  background-size: cover;
  height: 110vh;
  width: 100%;
  z-index: -2;

}
}
@media (min-width: 0px) and (max-width: 576px)
{
 body{   
  background:none;
}
}
</style>
</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--Google Maps api-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA3ovAd7G1vbAbnK40sYZid-zhBFmaf5rY"></script>
<script>
var searchInput = 'search_input';
// this is for the autofillup suggestion
$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
  
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();
    
        document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
        document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
    });
    $(document).on('change', '#'+searchInput, function () {
    document.getElementById('latitude_input').value = '';
    document.getElementById('longitude_input').value = '';
  
    document.getElementById('latitude_view').innerHTML = '';
    document.getElementById('longitude_view').innerHTML = '';
});
});
</script> 
  <!-- header -->
    <header>
        
     <nav class="navbar navbar-expand-lg fixed-top" >   
        <div class="container-fluid ">
            <div class="site-nav-wrapper">
                <div class="navbar-header">

                    <!-- mobile menu open button -->
                    <span id="mobile-nav-open-btn">&#9776;</span>

                    <!-- LOGO -->
                    <a class="navbar-brand smooth-scroll" href="index.php">
                        <img src="../images/favicon/burn.png" alt="logo">
                    </a>

                    <svg id="darkMode" class="DM" width="55" height="55" viewBox="0 0 55 55" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="sun"
                            d="M55 27.5C55 42.6878 42.6878 55 27.5 55C12.3122 55 0 42.6878 0 27.5C0 12.3122 12.3122 0 27.5 0C42.6878 0 55 12.3122 55 27.5Z"
                            fill="#FFD600" />
                    </svg>
                </div>
        <div class="container">
        <div class="collapse navbar-collapse" >
          <ul class="nav navbar-nav ">
            <li><a  class="nav-link smooth-scroll" href="../index.php#home">Home</a></li>
            <li><a  class="nav-link smooth-scroll" href="../index.php#about">About</a></li>
            <li><a  class="nav-link smooth-scroll" href="../index.php#team">Team</a></li>
            <li><a  class="nav-link smooth-scroll" href="../index.php#services">Services</a></li>
            <li><a class="nav-link smooth-scroll"  href="../index.php#contact">Contact</a></li>
            <!-- <li><a class="nav-link "  href="php/login/signIn.php">Login</a></li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="HamroGas/php/login/staff_signin.php">Delivery Boy</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="HamroGas/php/login/admin_signIn.php">Admin</a>
                </div>
            </li>
          </ul>
        </div>
        </div>

        <!-- mobile menu -->
        <div id="mobile-nav">
            <span id="mobile-nav-close-btn">&times;</span>
            
            <div id="mobile-nav-content">
                <ul class="nav">
                    <li><a  class="nav-link smooth-scroll" href="../index.php#home">Home</a></li>
                    <li><a  class="nav-link smooth-scroll" href="../index.php#about">About</a></li>
                    <li><a  class="nav-link smooth-scroll" href="../index.php#team">Team</a></li>
                    <li><a  class="nav-link smooth-scroll" href="../index.php#services">Services</a></li>
                    <li><a class="nav-link smooth-scroll"  href="../index.php#contact">Contact</a></li>
                            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="HamroGas/php/login/staff_signin.php">Delivery Boy</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="HamroGas/php/login/admin_signIn.php">Admin</a>
                </div>
            </li>
                    
                    
                </ul>
            </div>
        </div>

        </div> 
        </div>
      </nav> 

      <!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">  
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#home">Section 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">Section 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Section 3</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Section 4
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#section41">Link 1</a>
              <a class="dropdown-item" href="#section42">Link 2</a>
            </div>
          </li>
        </ul>
      </nav> -->
    </header>
    <!-- Header ends -->
<body class="bg-light">
    <div class="container py-5 bg-light my-5">
    

    <div class="py-2 text-center">
      <h2>Checkout form</h2>
      <hr class="mb-4 w-50">
    </div>


    <div class="col-md-12">
      <form class="needs-validation wow fadeInUp" data-wow-duration="2s" novalidate=""  method="POST" name="customer" action="" enctype="multipart/form-data">
        <div class="row"> 
         <div class="col-md-4">
          <div class="mb-3 text-center" >
            <label for="file"> <img  id="preimage" class="img-fluid mt-3 rounded-circle" src="images/def.png" alt="" width="192" height="192" for="file" required="" border="2px" name="image">
            </label>

            <input type="file"  class="form-control" onchange="loadfile(event)" name="image" required="required" style="visibility: hidden;" id="file" />
            <div class="invalid-feedback">
              Valid photo is required.
            </div>
          </div>
          <hr class="mb-4 w-75">
          <div class="mb-3 text-center">
            <label for="file1"> <img  id="preimage1" class="mt-3 img-thumbnail" src="images/citi.png" alt="" width="222" height="142" for="file1" name="image1"required="" border="2px">
            </label>
            <input type="file"  class="form-control" onchange="loadfile1(event)" name="image1" required="required" style="visibility: hidden;" id="file1" />
            <div class="invalid-feedback">
              Valid citizenship photo is required.
            </div>
          </div>  

        </div>
        <div class="col-md-8 py-2 mb-4  mx-auto border border-light">
         <div class="container-sm bg-light px-5 py-2 border border-light rounded-lg shadow-lg"> 
          <div class="row text-muted">  
            <div class="col-md-6 mb-3">
              <label for="firstName" class="text-muted">First name</label>
              <input type="text" class="form-control form-control-sm" name="first_name" placeholder="" value="" required="">
              <div class="invalid-feedback">Valid first name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control form-control-sm" name="last_name" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control form-control-sm" name="email" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class=" col-md-12 mb-3">
              <label for="address">Address</label>
               <input type="text" class="form-control form-control-sm" id="search_input" name="address" placeholder="Type address..." required="" />
    <input type="hidden" id="loc_lat" />
    <input type="hidden" id="loc_long" />
    <br>
    <p>Click the button to get your current location.</p>
    <button onclick="getLocation()">Locate Me</button>
    <p id="demo"></p>
        <input type="hidden" class="form-control" id="lat" name="latitude" required="" />
    <input type="hidden" class="form-control" id="long" name="longitude" required="" />
    <!--Pinning Location-->
<script>
//THis is for the location
var x = document.getElementById("demo");
var long = document.getElementById("long");
var lat = document.getElementById("lat");
// var latt;
// var longg;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}


function showPosition(position) {
 
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  // latt=position.coords.latitude;
  // longg=position.coords.longitude;
  long.value = position.coords.longitude;
    lat.value=position.coords.latitude;

  console.clear();
  console.log(latt);
  console.log(longg);  
   //<input type="text"id="named" name="named" hidden="hidden" value=""  style="width: 13%;"><br>
}

</script>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>



            <div class=" col-md-6 mb-3">
              <label for="phone">Phone number:</label>

              <input type="tel" placeholder="98********" class="form-control form-control-sm" id="phone" name="phone_number"
              pattern="[0-9]{10}"
              required>
              <div class="invalid-feedback">
                Please enter your phone number.
              </div>
            </div>
            <div class=" col-md-6 mb-3">
             <label for="type">Type</label>
             <select class="custom-select-sm  form-control form-control-sm " name="type" required="">

              <?php
              if (mysqli_num_rows($result2) > 0) {
          // output data of each row
          //$user_list = mysqli_fetch_assoc($result);
          // echo "<pre>"; print_r($user_list);exit;

                while($row = mysqli_fetch_assoc($result2)) {
              // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["email"]. "<br>";
                  ?>

                  <option value="<?= $row["type"];?>"  ><?= $row["type"];?></option>
                  <?php
                }    
              } else {
                ?>
                <tr>
                  <td colspan="3">No Record(s) found.</td>
                </tr>
                <?php
              }
              ?>
              <?php 
              mysqli_close($conn);
              ?>

            </select>
          </div>

          <script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
		 $("#div_refresh").load("stockrefresh.php");
        setInterval(function() {
            $("#div_refresh").load("stockrefresh.php");
        }, 20000);
    });
 
</script>
<div class="col-md-4 mb-4">
<div id="div_refresh"></div>
</div>
        <div class="col-md-4 mb-4">
          <label for="purpose">Purpose</label>
          <select class="custom-select-sm  form-control" name="purpose" required="" id="purpose" onselect="purposeSelected(this.value);"  onchange="purposeSelected(this.value);" >
<option style="display: none" disabled selected value> purpose</option>  
     
            <?php
            if (mysqli_num_rows($result) > 0) {
          // output data of each row
          //$user_list = mysqli_fetch_assoc($result);
          // echo "<pre>"; print_r($user_list);exit;

              while($row = mysqli_fetch_assoc($result)) {
              // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["email"]. "<br>";
                ?>
                <option value="<?= $row["purpose"];?>"><?= $row["purpose"];?></option>
                <?php
              }   
            } else {
              ?>
              <tr>
                <td colspan="3">No Record(s) found.</td>
              </tr>
              <?php
            }
            ?>
            <?php 
            mysqli_close($conn);
            ?>                
          </select>

          <div class="invalid-feedback">
            Please provide a purpose.
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <label >Quantity <span class="text-muted"></span></label>
          <!-- <input type="number" id="quantity" class="form-control form-control-sm"  placeholder="1" required="" name="quantity" min="1" max="5"> -->
          <select class="custom-select-sm form-control" name="quantity" required="" id="quantity" >
          </select>

          <div class="invalid-feedback">
            Please enter purpose first.
          </div>
        </div>
      </div>

      <hr class="mb-4 w-100">
      <h4 class="col-md-12 mb-3">Payment</h4>
      <div class="d-block my-3">
        <div class="custom-control custom-radio">
          <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="COD" checked required>
          <label class="custom-control-label" for="credit">COD</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" value="Pay Online" required>
          <label class="custom-control-label" for="debit">Pay Online</label>
        </div>
      </div>

      <hr class="mb-4">
      <center>
        <input class="btn btn-danger btn-lg mb-4 text-center" type="submit" name="add_order" value="Continue to checkout">
      </center>
    </div>
  </div>
</div>
</form>  
</div>

</div>
</body>
</html>

    <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->

      <!-- wow Js -->
      <script src="../js/wow/wow.min.js"></script>
      <script type="text/javascript">
    new WOW().init();
</script>


      <script>
      //Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <!-- --To pre-load images-- -->
    <script type="text/javascript">
      function loadfile(event)
      {
        var output=document.getElementById('preimage');
        output.src=URL.createObjectURL(event.target.files[0]);
      }
    </script>
    <script type="text/javascript">
      function loadfile1(event)
      {
        var output=document.getElementById('preimage1');
        output.src=URL.createObjectURL(event.target.files[0]);
      }
    </script>

    <!-- To manage the quantites of domestic and commercial purpose   -->
    <script type="text/javascript">
      var data = 
      {
        "domestic":[
        "2"
        ], 
        "comercial":[
        "2",
        "3",
        "4",
        "5"
        ]
      };

      var purposes = [ "domestic","comercial"];

      function purposeSelected(selected){       
        // get placeholder
        var quantity = document.getElementById("quantity");

        // first clear everything
        while(quantity.firstChild)
        {
          quantity.removeChild(quantity.firstChild);
        }

        // first node is always select individual
        createOption("1");

        // here we need to generate listbox
        for(i=0; i<data[selected].length;i++)
        {
          var a = data[selected][i];

          createOption(a);
        }
      }

      function createOption(value){
            // attribute storing color value
            c = document.createAttribute("value");
            c.value=value;

            // textnode for storing color value
            cText = document.createTextNode(value);

            // append attribute node
            option = document.createElement("option");
            option.setAttributeNode(c);

            option.appendChild(cText);

            // append child
            quantity.appendChild(option);
          }
        </script>

        <!-- ....To alert.... -->
        <script>

          document.getElementById("demo").innerHTML = txt;

        </script> 

           <script src="../js/shopnav.js"></script>
     <!-- <script src="js/anime/darkmode.js"></script>    --> 






