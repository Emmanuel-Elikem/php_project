<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();

if (!file_exists('vendor/autoload.php')) {
    die("<h2>Composer not installed</h2><p>Please run 'composer install' in your project root to install dependencies.</p>");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    $errors = [];

    if (empty($name)) $errors['name'] = "Full Name is required.";
    if (empty($email)) {
        $errors['email'] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }
    if (empty($subject)) $errors['subject'] = "Subject is required.";
    if (empty($message)) $errors['message'] = "Message is required.";


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: index.php");
        exit;
    }

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'leunammeyetten@gmail.com'; 
        $mail->Password   = 'xqkd lqet ntjj xixy'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; 

        // --- RECIPIENTS ---
        $mail->setFrom($email, htmlspecialchars($name)); 
        $mail->addAddress('leunammelikem@gmail.com', 'Your Name'); 
        $mail->addReplyTo($email, htmlspecialchars($name)); 

        // --- CONTENT ---
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission: ' . htmlspecialchars($subject);
        $mail->Body    = "
            <html>
            <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <h2>New Message from Contact Form</h2>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
                <hr>
                <p><strong>Message:</strong></p>
                <p>" . nl2br(htmlspecialchars($message)) . "</p>
            </body>
            </html>";
        $mail->AltBody = "Name: " . $name . "\nEmail: " . $email . "\nSubject: " . $subject . "\n\nMessage:\n" . $message;

        $mail->send();


        echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Message Sent!</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
                <style> body { font-family: "Inter", sans-serif; } </style>
            </head>
            <body class="bg-gray-100">
                <div class="container mx-auto max-w-2xl px-4 py-12">
                    <div class="bg-white rounded-lg shadow-xl p-8 md:p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <h1 class="text-3xl font-bold text-gray-800 mt-4">Thank You, ' . htmlspecialchars($name) . '!</h1>
                        <p class="text-gray-600 mt-2 mb-6">Your message has been sent successfully. We will get back to you shortly.</p>
                        <div class="mt-8"><a href="index.php" class="text-blue-600 hover:underline">&larr; Go Back</a></div>
                    </div>
                </div>
            </body>
            </html>';

    } catch (Exception $e) {
        $_SESSION['errors']['mail'] = "Message could not be sent. Please try again later.";
        $_SESSION['old_data'] = $_POST;
        header("Location: index.php");
        exit;
    }

} else {
    header("Location: index.php");
    exit;
}

