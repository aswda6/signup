<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'wargame00101@gmail.com';
        $mail->Password   = 'brgslvpilwtkfbyv'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // or 465 for SSL

        // Recipients
        $mail->setFrom('wargame00101@gmail.com', 'Your Name');
        $mail->addAddress($email); // Add the user's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Please verify your email by clicking this link: <a href="http://yourwebsite.com/verify.php?email=' . urlencode($email) . '">Verify Email</a>';
        $mail->AltBody = 'Please verify your email by copying this link: http://yourwebsite.com/verify.php?email=' . urlencode($email);

        $mail->send();
        echo 'Verification email has been sent to ' . htmlspecialchars($email);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Display the signup form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup Form</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .signup-form {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 300px;
            }
            .signup-form h2 {
                margin-bottom: 20px;
            }
            .signup-form input[type="email"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 3px;
            }
            .signup-form input[type="submit"] {
                background: #5cb85c;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 3px;
                cursor: pointer;
                width: 100%;
            }
            .signup-form input[type="submit"]:hover {
                background: #4cae4c;
            }
        </style>
    </head>
    <body>

        <div class="signup-form">
            <h2>Signup</h2>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="submit" value="Sign Up">
            </form>
        </div>

    </body>
    </html>
    <?php
}
?>
