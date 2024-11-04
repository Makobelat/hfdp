<?php
$email_to = "you@company.pw"; 
$email_from = "webmaster@company.pw";
$email_subject = "New Donation Form Submission";

if(isset($_POST['donateNow'])) {
    // Collect and sanitize form data
    $amount = htmlspecialchars(trim($_POST['amount']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $note = htmlspecialchars(trim($_POST['note']));

    // Validate required fields
    if (!empty($amount) && !empty($firstName) && !empty($lastName) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Construct the email message
        $email_message = "Donation Form Details:\n\n";
        $email_message .= "Amount: R" . $amount . "\n";
        $email_message .= "Name: " . $firstName . " " . $lastName . "\n";
        $email_message .= "Email: " . $email . "\n";
        $email_message .= "Phone: " . $phone . "\n";
        $email_message .= "Address: " . $address . "\n";
        $email_message .= "Note: " . $note . "\n\n";
        $email_message .= "Bank Account Details for Donation:\n";
        $email_message .= "Bank: First National Bank\n";
        $email_message .= "Account Name: Haven for Disabled\n";
        $email_message .= "Account Number: 12345678910\n";
        $email_message .= "Branch Code: 250655\n";
        $email_message .= "Reference: " . $firstName . $lastName . "\n";

        // Set email headers
        $headers = 'From: ' . $email_from . "\r\n" .
                   'Reply-To: ' . $email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Send the email
        if (mail($email_to, $email_subject, $email_message, $headers) && mail($email, $email_subject, $email_message, $headers)) {
            echo "Thank you for your donation! A confirmation email has been sent to you.";
        } else {
            echo "There was an error sending your donation. Please try again later.";
        }
    } else {
        echo "Please fill in all required fields correctly.";
    }
}
?>
