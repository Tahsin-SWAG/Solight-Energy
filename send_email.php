<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'tahsiinmahi@gmail.com'; // Your SMTP username
        $mail->Password = 'wltzvojonuppnvxg'; // Your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('tahsiinmahi@gmail.com', 'SOLIGHT');
        $mail->addAddress('islamtahsin919@gmail.com', 'Tahsin');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Message from SOLIGHT.IO';
        $mail->Body = "<p>Name: $name</p>
        <p>Phone : $phone </p>
        <p>Zip : $zip </p>
        <p>Email: $email</p>
        <p>Message: $message</p>";

        // Send email
        $mail->send();

        // Return success response
        echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully'));
    } catch (Exception $e) {
        // Return error response
        echo json_encode(array('status' => 'error', 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo));
    }
} else {
    // Return error response if accessed directly
    echo json_encode(array('status' => 'error', 'message' => 'Direct access to this script is not allowed'));
}
?>
