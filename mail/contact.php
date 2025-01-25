<?php
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // 400 lebih tepat untuk kesalahan input pengguna
    echo "Invalid input.";
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "rizkiintipratamasinergi@gmail.com"; // Ganti dengan alamat email Anda
$subject = "$m_subject: $name";
$body = "You have received a new message from your website contact form.\n\n"
    . "Here are the details:\n\n"
    . "Name: $name\n\n"
    . "Email: $email\n\n"
    . "Subject: $m_subject\n\n"
    . "Message:\n$message";

$headers = "From: no-reply@yourdomain.com\r\n"; // Ganti dengan domain Anda
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (!mail($to, $subject, $body, $headers)) {
    error_log("Mail failed to send to $to");
    http_response_code(500); // Kesalahan server
    echo "Failed to send email.";
} else {
    http_response_code(200); // Sukses
    echo "Email sent successfully.";
}
?>
