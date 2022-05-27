<?php
	ini_set('display_errors', 1);
	error_reporting( E_ALL );
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$to = 'admin@jswyasociados.com';
		$from = 'admin@jswyasociados.com';
		$name = trim($_POST["name"]);
        $phone = trim($_POST["phone"]);
		$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
		$subject = "Mensaje de jswyasociados.com";
		$message = trim($_POST["message"]);

		if(empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)){
			http_response_code(400);
			echo 'Complete el formulario e inténtelo nuevamente.';
			exit;
		}

		$content = '<div style="
						width: 100%; 
						max-width: 600px; 
						color: #333333; 
						padding: 2rem; 
						border: 1px solid #b5b5b5; 
						box-sizing: border-box;">
					<h1>JSW y Asociados</h1>
					<p><strong>Asunto:</strong> ' . $subject . '</p>
					<p><strong>Nombre:</strong> ' . $name . '</p>
					<p><strong>Teléfono:</strong> ' . $phone . '</p>
					<p><strong>Correo electrónico:</strong> <a href="mailto:"' . $email . '">' . $email . '</a></p>
					<p><strong>Mensaje:</strong> ' . $message . '</p>
					<hr>
					<small>Correo electrónico enviado desde el sitio web.</small>
					</div>';
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From:' . $from . "\r\n";

		$success = mail($to, $subject, $content, $headers);

		if($success){
			http_response_code(200);
			echo 'El mensaje ha sido enviado con éxito';
		} else{
			http_response_code(500);
			echo 'Hubo un problema al enviar el mensaje.';
		}
	}
	else{
		http_response_code(403);
		echo 'Hubo un problema al enviar el mensaje.';
	}
?>