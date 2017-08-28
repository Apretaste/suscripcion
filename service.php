<?php

class Suscripcion extends Service
{
	/**
	 * Display the status of your suscriptions
	 *
	 * @param Request
	 * @return Response
	 */
	public function _main(Request $request)
	{
		// get the status of the mail list
		$connection = new Connection();
		$status = $connection->query("SELECT mail_list FROM person WHERE email = '{$request->email}'");
		$status = array("maillist"=>$status[0]->mail_list);

		// create response
		$response = new Response();
		$response->setResponseSubject("Sus suscripciones actuales");
		$response->createFromTemplate("basic.tpl", $status);
		return $response;
	}

	/**
	 * Start your suscription to the email list
	 *
	 * @param Request
	 * @return Response
	 */
	public function _lista(Request $request)
	{
		// subscribe/unsubscribe to the email list
		if(strtoupper($request->query) == "SALIR") $this->utils->unsubscribeFromEmailList($request->email);
		else $this->utils->subscribeToEmailList($request->email);

		// create response
		return new Response();
	}

	/**
	 * Exlude a user from Apretaste and close his/her account
	 *
	 * @param Request
	 * @return Response
	 */
	public function _excluyeme(Request $request)
	{
		// make person inactive
		$connection = new Connection();
		$connection->query("UPDATE person SET active=0 WHERE email='{$request->email}'");

		// do not respond if person comes from the app
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		if($di->get('environment') == "app") return new Response();

		// create response
		$response = new Response();
		$response->setEmailLayout("email_simple.tpl");
		$response->setResponseSubject("Hemos cerrado su cuenta");
		$response->createFromText("<b>Hemos cerrado su cuenta de Apretaste.</b> Usted no recibira ningun otro email de nosotros. Tampoco mostraremos su perfil a otros usuarios. Si quiere reabrir su cuenta, utilice Apretaste nuevamente y sera abierta de manera automatica.");
		return $response;
	}
}
