<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fromName = trim($_POST["fromName"]);
    $fromEmail = trim($_POST["fromEmail"]);
    $toEmails = explode(',', $_POST['toEmail']);
    $subjectLine = trim($_POST["subjectLine"]);
    $message = $_POST['message'];

    foreach ($toEmails as $toEmail) {
        $toEmail = trim($toEmail);
        if (filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
            // Enviar el mensaje
            $headers = "From: $fromName <$fromEmail>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            if (mail($toEmail, $subjectLine, $message, $headers)) {
                echo "Mensaje enviado a $toEmail <br>";
            } else {
                echo "Error al enviar el mensaje a $toEmail <br>";
            }
        } else {
            echo "Dirección de correo no válida: $toEmail <br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Enviar mensaje a múltiples correos</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />
    </head>
    <body class="bg-blue-200">
        <div class="flex justify-center items-center h-screen">
            <div class="max-w-md mx-auto bg-white p-8 border rounded shadow sm:w-full md:w-1/2">
                <div class="flex justify-between items-center mb-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Logo" class="w-12 h-12" />
                    <h1 class="text-2xl leading-6 font-bold">Enviar mensaje a múltiples correos (Jus Emails)</h1>
                </div>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fromName">Nombre remitente:</label>
                        <input class="w-full p-2 border border-gray-300 rounded" type="text" name="fromName" placeholder="Joe" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fromEmail">Correo remitente:</label>
                        <input class="w-full p-2 border border-gray-300 rounded" type="email" name="fromEmail" placeholder="correo@ejemplo.com" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="toEmail">Correos destinatarios (separados por comas):</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded" name="toEmail" placeholder="********@*****.**" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="subjectLine">Asunto:</label>
                        <input class="w-full p-2 border border-gray-300 rounded" type="text" name="subjectLine" placeholder="Importante email" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Mensaje (Email Template HTML):</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded" name="message" placeholder="Contenido HTML" required></textarea>
                    </div>

                    <div>
                        <input class="bg-blue-500 hover:bg-blue-600 w-full text-white font-bold py-2 px-4 rounded" type="submit" value="Enviar" />
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <a class="text-blue-500 underline font-bold hover:text-blue-darker" href="https://jusapp.000webhostapp.com/">Enviar otro email</a>
                </div>
            </div>
        </div>
    </body>
</html>

