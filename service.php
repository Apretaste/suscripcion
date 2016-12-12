<?php

class Suscripcion extends Service
{
	/**
	 * Display the status of your suscriptions
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		// get the status of the mail list
		$connection = new Connection();
		$status = $connection->deepQuery("SELECT mail_list FROM person WHERE email = '{$request->email}'");
		$status = array("maillist"=>$status[0]->mail_list);

		// create response
		$response = new Response();
		$response->setResponseSubject("Usted ha sido excluido de Apretaste");
		$response->createFromTemplate("basic.tpl", $status);
		return $response;
	}

	/**
	 * Start your suscription to the email list
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _lista(Request $request)
	{
		// default case
		$text = 'Su estado en la lista de correo no ha cambiado. Envie un email con asunto "SUSCRIPCION LISTA salir" para salr de la lista o "SUSCRIPCION LISTA entrar" para formar parte.';

		// for the case unsubscribing to the list
		if($request->query == "salir")
		{
			$this->utils->unsubscribeFromEmailList($request->email);
			$text = 'Le hemos eliminado de la lista de correo. Ahora no recibira mas nuestra correspondencia';

		}

		// for the case subscribing to the list
		if($request->query == "entrar")
		{
			$this->utils->subscribeToEmailList($request->email);
			$text = 'Le hemos agregado a nuestra lista de correo. Ahora debera empezar a recibir nuestra correspondencia';
		}

		// create response
		$response = new Response();
		$response->setResponseSubject("Estado de la lista de correo");
		$response->createFromText($text);
		return $response;
	}

	/**
	 * Exlude a user from Apretaste and close his/her account
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _excluyeme(Request $request)
	{
		// make person inactive
		$connection = new Connection();
		$connection->deepQuery("UPDATE person SET active=0 WHERE email='{$request->email}'");

		// create response
		$response = new Response();
		$response->setEmailLayout("email_simple.tpl");
		$response->setResponseSubject("Hemos cerrado su cuenta");
		$response->createFromText("<b>Hemos cerrado su cuenta de Apretaste.</b> Usted no recibira ningun otro email de nosotros. Tampoco mostraremos su perfil a otros usuarios. Si quiere reabrir su cuenta, utilice Apretaste nuevamente y sera abierta de manera automatica.");
		return $response;
	}
}
