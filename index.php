<?php
    $popupMsg = '';
    $popupMsgClass = '';

    if(filter_has_var(INPUT_POST, 'submit')) {
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['name']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $popupMsg = "Email is invalid! ";
                $popupMsgClass = "alert-danger";
            } else {
                $recipient = 'recipient@example.com';
                $emailSubject = $name .' ' .$subject;
                $headers = array(
                    'From' => $email,
                    'Reply-To' => $email,
                    'X-Mailer' => 'PHP/' . phpversion()
                );

                if(mail($recipient, $emailSubject, $message, $headers)) {
                    $popupMsg = "Form has been submitted!";
                    $popupMsgClass = "alert-success";
                } else {
                    $popupMsg = "Error while sending email.";
                    $popupMsgClass = "alert-danger";
                }
            }
        } else {
            $popupMsg = "All fields are required!";
            $popupMsgClass = "alert-danger";
        }
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Contact Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Contact form</a>
        </nav>
        <div class="container">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <fieldset>
                    <legend>Contact Us:</legend>
                    <?php if($popupMsg != ''): ?>
                    <div class="alert <?php echo $popupMsgClass; ?>">
                        <?php echo $popupMsg; ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="Email">Email address:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Subject">Subject:</label>
                        <input type="" class="form-control" name="subject" placeholder="Subject" value="<?php echo isset($_POST['subject']) ? $subject : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Message">Message:</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Please type in your message..."><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>
        </div>
    </body>

</html>