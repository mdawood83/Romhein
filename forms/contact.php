<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        echo 'Please fill out all the Fields...';
    } else {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo "Invalid Sender's Email";
        } else {
            $email_subject = 'New Form Submission-' . $subject;

            $email_body =
                "Name: $name. \n" .
                "Email: $email. \n" .
                "Message: $message. \n";

            $recipient = 'mina.latif@live.com';

            $headers = "From: $email \r\n";
            $headers .= "Reply-To: $email \r\n";

            $message = wordwrap($message, 70);

            if (mail($recipient, $email_subject, $email_body, $headers)) {
                echo 'Your email has been sent successfuly! Thank you for your feedback';
            } else {
                echo 'We are sorry but the email did not go through.';
            }

            header('Location: index.html');
        }
    }
} else {
    echo 'Something went wrong!';
}

?>
