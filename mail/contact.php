<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika menggunakan Composer

$mail = new PHPMailer(true);

// Ambil Data dari Form
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = nl2br(strip_tags(htmlspecialchars($_POST['message'])));

if (!$email) {
    die("Alamat email tidak valid!");
}

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host       = 'mail.teknoonline.id';  // SMTP server dari penyedia email
    $mail->SMTPAuth   = true;
    $mail->Username   = 'admin@teknoonline.id'; // Email pengirim
    $mail->Password   = 'password_email_anda';  // Ganti dengan password email
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Gunakan SSL
    $mail->Port       = 465;  // Port SMTP sesuai konfigurasi

    // Pengaturan Email
    $mail->setFrom($email, $name); // Pengirim
    $mail->addAddress('admin@teknoonline.id', 'Tekno Online'); // Penerima

    $mail->Subject = $m_subject;
    $mail->isHTML(true);
    $mail->Body    = "<html><body>
                        <h3>Pesan dari: $name ($email)</h3>
                        <p>$message</p>
                      </body></html>";

    // Kirim Email
    $mail->send();
    echo "Email berhasil dikirim!";
} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
?>
