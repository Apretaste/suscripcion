<?php

class Suscripcion extends Service
{
	/**
	 * Function executed when the service is called
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		/*
		// make person inactive
		$connection = new Connection();
		$sql = "UPDATE person SET active=0 WHERE email='{$request->email}'";
		$connection->deepQuery($sql);

		// unsubscribe from the mailing list in Mailer Lite
		$utils = new Utils();
		$utils->unsubscribeFromEmailList($request->email);
*/
		// create response
		$response = new Response();
		$response->setResponseSubject("Usted ha sido excluido de Apretaste");
		$response->createFromTemplate("basic.tpl", array());
		return $response;
	}
}
