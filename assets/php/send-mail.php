<?php

	$errors = array();

	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Por favor insira seu nome.';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Por favor entre com um e-mail válido.';
	}

	//Check if message has been entered
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Por favor insira sua mensagem.';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$assunto = $_POST['subject'];
	$from = $email;
	$to = 'contato@marcelomotta.com';  //  change this email id
	$subject = 'contato.formulaplusrj.com.br : ' . $assunto;

	$body = "De: $name
		\n Formulário da Página de Contatos, contato.formulaplusrj.com.br
		\n Assunto: $assunto
		\n E-Mail: $email
		\n Menssagem:
		\n $message
	";

	$headers = "From: ".$from;


	//send the email
	$result = '';
	if (mail ($to, $subject, $body, $headers)) {
		// $result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		// $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'E-mail enviado com sucesso! Obrigado, entraremos em contato em breve';
		// $result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	// $result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	// $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Alguma coisa aconteceu errado enquanto seu e-mail era enviado. Por favor tente mais tarde';
	// $result .= '</div>';

	echo $result;
