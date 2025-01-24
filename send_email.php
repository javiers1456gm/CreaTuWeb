<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer
require 'PHPMailer-master/autoload.php';

// Validar que se envíen datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Configuración del correo
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'crea.tu.web.info12@gmail.com';
        $mail->Password = 'Daniel12*'; // Tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo electrónico
        $mail->setFrom('crea.tu.web.info12@gmail.com', 'CreaTuWeb');
        $mail->addAddress('crea.tu.web.info12@gmail.com', 'CreaTuWeb');
        $mail->addReplyTo($email, $name);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto: $name";
        $mail->Body = "<h3>Detalles del mensaje</h3>
                       <p><strong>Nombre:</strong> $name</p>
                       <p><strong>Correo:</strong> $email</p>
                       <p><strong>Mensaje:</strong><br>$message</p>";

        // Enviar el correo
        $mail->send();
        echo "<script>alert('¡Mensaje enviado exitosamente!'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    echo "<script>alert('Acceso no permitido'); window.location.href='index.html';</script>";
}
?>
