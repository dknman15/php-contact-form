<?php 

if(isset($_POST['submit'])){
	
	$errors = '';
	
	if ($_POST['fname'] != '') {
		$_POST['fname'] = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
		if ($_POST['fname'] == '') {
			$errors .= 'Please enter a valid name.<br/><br/>';
		}
	} else {
		$errors .= 'Please enter your name.<br/>';
	}
	
	if ($_POST['email'] != '') {
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors .= 'Please enter a valid email address.<br/><br/>';
		}
	} else {
		$errors .= 'Please enter your email address.<br/>';
	}
	
	if ($_POST['phone'] != '') {
		$_POST['phone'] = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
		if ($_POST['phone'] == '') {
			$errors .= 'Please enter a valid phone number.<br/><br/>';
		}
	} else {
		$errors .= 'Please enter your phone number.<br/>';
	}
	
	if ($_POST['comments'] != '') {
		$comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);
		if ($comments == '') {
			$errors .= 'Please enter comments to send.<br/>';
		}
	} 
	
	if($_POST['honeypot'] != ''){
		$errors .= 'You spammer!';
	}
	
	if(!$errors) {
		$mail_to = 'enter your emaill address here';
		$subject = 'Contact Us Submission';
		$message = 'Full Name: ' . $_POST['fname'] . "\n";
		$message .= 'Email: ' . $_POST['email'] . "\n";
		$message .= 'Phone: ' . $_POST['phone'] . "\n";
		$message .= "Comments:\n" . $_POST['comments'] . "\n\n";

		$mail = mail($mail_to, $subject, $message);
		if($mail){
			$msg = 'Message sent!';
		}
	}
}

?>

<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="en"><![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!--><html lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Contact Form</title>
</head>

<body>


<?php if(isset($_POST['submit'])): ?>
	<?php if(isset($_POST['submit']) && $errors): ?>
		<div class="errors">
			<?php echo $errors; ?>
		</div>
	<?php else: ?>
		<div class="success">
			<?php echo $msg; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<ul>
		<li><input type="text" name="fname" value="" placeholder="Full Name*" /></li>
		<li><input type="text" name="email" value="" placeholder="Email*" /></li>
		<li><input type="text" name="phone" value="" placeholder="Phone*" /></li>
		<li><textarea name="comments" cols="50" rows="10" placeholder="Comments"></textarea></li>
		<li>
			<input type="submit" name="submit" value="Contact Us" />
			<input type="text" class="honeypot" name="honeypot" placeholder="Leave Blank If Human" autocomplete="off">
		</li>
	</ul>
</form>

</body>
</html>