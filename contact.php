<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link href="bootstrap.css" rel="stylesheet" type="text/css">
  <script src="script.js"></script>
  <title>Maison</title>
</head>
<body>
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="navbar-inner">
		<ul class="nav nav-tabs">
  <li><a href="index.php">Home</a></li>
  <li><a href="media.php">Média</a></li>
  <li class="active"><a href="contact.php">Contact</a></li>
</ul>
			</div>
		</nav>
<div>
<?php
//If the form is submitted
if(isset($_POST['submit'])) {

  //Check to make sure that the name field is not empty
  if(trim($_POST['contactname']) == '') {
    $hasError = true;
  } else {
    $name = trim($_POST['contactname']);
  }

  //Check to make sure that the phone field is not empty
  if(trim($_POST['phone']) == '') {
    $hasError = true;
  } else {
    $phone = trim($_POST['phone']);
  }

  //Check to make sure that the name field is not empty
  if(trim($_POST['weburl']) == '') {
    $hasError = true;
  } else {
    $weburl = trim($_POST['weburl']);
  }

  //Check to make sure that the subject field is not empty
  if(trim($_POST['subject']) == '') {
    $hasError = true;
  } else {
    $subject = trim($_POST['subject']);
  }

  //Check to make sure sure that a valid email address is submitted
  if(trim($_POST['email']) == '')  {
    $hasError = true;
  } else if (!filter_var( trim($_POST['email'], FILTER_VALIDATE_EMAIL ))) {
    $hasError = true;
  } else {
    $email = trim($_POST['email']);
  }

  //Check to make sure comments were entered
  if(trim($_POST['message']) == '') {
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['message']));
    } else {
      $comments = trim($_POST['message']);
    }
  }

  //If there is no error, send the email
  if(!isset($hasError)) {
    $emailTo = 'remy.mazabraud@gmail.com'; // Put your own email address here
    $body = "Name: $name \n\nEmail: $email \n\nPhone Number: $phone \n\nSubject: $subject \n\nComments:\n $comments";
    $headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

    mail($emailTo, $subject, $body, $headers);
    $emailSent = true;
  }
}
?>

  <div class="jumbotron">

    <div class="row">
      <div class="col-md-6 col-md-push-3">
        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
          <fieldset>
            <legend>Envoyé moi un petit mot !</legend>

            <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Verifié les champs que vous avez remplie. Merci.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Message envoyé par un petit chinois!</strong></p>
                <p>Merci pour le petit mot, <strong><?php echo $name;?></strong>! Ton message ma bien était transmie par le livreur chinois je répondrais au plus vite.</p>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="name">Ton Nom/Prenom<span class="help-required">*</span></label>
              <input type="text" name="contactname" id="contactname" value="" class="form-control required" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="phone">Ton numéro de téléphone<span class="help-required">*</span></label>
              <input type="text" name="phone" id="phone" value="" class="form-control required" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="email">Ton Email<span class="help-required">*</span></label>
              <input type="text" name="email" id="email" value="" class="form-control required email" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="weburl">Ton Site Web<span class="help-required">*</span></label>
              <input type="text" name="weburl" id="weburl" value="" class="form-control required url" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="subject">Subject<span class="help-required">*</span></label>
              <select name="subject" id="subject" class="form-control required" role="select" aria-required="true">
                <option></option>
                <option>Une sugestion ?</option>
                <option>Un projet ?</option>
                <option>Une demande de mariage ?</option>
                <option>Un contrat pro ?</option>
                <option>Autre?</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Message<span class="help-required">*</span></label>
              <textarea rows="8" name="message" id="message" class="form-control required" role="textbox" aria-required="true"></textarea>
            </div>

            <div class="actions">
              <input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-primary" title="Click here to submit your message!" />
              <input type="reset" value="Clear Form" class="btn btn-danger" title="Remove all the data from the form." />
            </div>
          </fieldset>
        </form>
      </div><!-- col -->
    </div><!-- row -->
</div>

</div>
		</body>
</html>