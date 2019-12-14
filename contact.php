<?php include 'includes/config.php';?>
<?php get_header()?>

<h2>Contact Us</h2>

<?php

$to = 'ahmmedth1@gmail.com';

$from = 'noreply@nony4coding.com';

if(isset($_POST["FirstName"])){//if data show it

$replyTo= $_POST["Email"];

$subject = 'ITC240 Contact Page ';

$message = $_POST["Comments"];
//$message = process_post();

$today = date('F j, Y, g:i:s a');

$message .= " " . $today;

$headers = 'From: '. $from . PHP_EOL .

'Reply-To: ' . $replyTo . PHP_EOL .

'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
//echo 'Email sent? ' . $today;
echo '
<div class="form-group col-lg-12">
<p>We\'ll get back to you shortly!</p>
<p><a href="">BACK</a></p>
</div>
'
;

}else{//no data, show form
echo '

<form action="" method="post">
<div class="row">
<div class="form-group col-lg-4">
    <label class="text-heading" for="FirstName">First Name</label>
<input class="form-control" type="text" name="FirstName" id="FirstName" autofocus required />
    </label>
</div>

<div class="form-group col-lg-4">
<label class="text-heading" for="LastName">Last Name</label>
<input class="form-control" type="text" name="Last_Name" id="LastName" required />
</div>

<div class="form-group col-lg-12">
<label class="text-heading" for="Email">Email</label>
<input class="form-control" type="email" name="Email" id="Email" required />
</div>

<div class="form-group col-lg-12 text-left">	
    
        <legend>Select your gender:</legend>
        
        <input type="radio" name="gender" value="Male"> Male<br>
        <input type="radio" name="gender" value="Female"> Female<br>
           
</div>
<div class="form-group col-lg-12 text-left">	
    
        <legend>Field of Interest:</legend>
        <input type="checkbox" name="chb-1" value="webdesign">Web Design<br>
        <input type="checkbox" name="chb-1" value="webdev"> Web Development<br>
        <input type="checkbox" name="chb-1" value="dbadmin"> Database Administartion<br><br>
            
</div>
   
<div class="form-group col-lg-12">
<label class="text-heading" for="Comments">Comments</label>
<textarea class="form-control" name="Comments" id="Comments"></textarea>
</div>
<div class="g-recaptcha" data-sitekey="6LfG5sIUAAAAAJw-lyfMfB2rQQ0Tc2kTtGRXZtTd"></div>
<div class="form-group col-lg-12">
    
<button type="submit" class="btn btn-secondary">Submit</button>
</div>
</div>
</form>';
}
    ?>

<?php get_footer()?>
