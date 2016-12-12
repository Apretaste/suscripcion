<h1>Estado de sus suscripciones</h1>
<p>A continuaci&oacute;n la lista de suscripciones en Apretaste y su estado.</p>

{space10}

<h2>Lista de correo</h2>
<p><small>Si est&aacute; suscrito a la lista de correos le dejaremos saber de nuevos servicios que saquemos, le enviaremos invitaciones a participar en nuestra rifa e informaci&oacute;n sobre los  ganadores de nuestras rifa y concursos, entre otras.</small></p>
<p>Estado:
	{if $maillist}
		<font color="green">SUSCRITO</font> {button href="SUSCRIPCION LISTA salir" caption="Desuscribirse" size="small" color="red"}
	{else}
		<font color="red">UNSUSCRITO</font> {button href="SUSCRIPCION LISTA entrar" caption="Suscribirse" size="small" color="green"}
	{/if}
</p>

{space10}

<h2>Apretaste</h2>
<p><small>Si no deseas usar m&aacute;s Apretaste puedes cerrar tu cuenta por esta v&iacute;a. <b>Una vez que cierre su cuenta no recibira ning&uacute;n email de nosotros.</b> Si usas Apretaste en un futuro tu cuenta se volver&aacute; a abrir autom&aacute;ticamente.</small></p>
{button href="SUSCRIPCION EXCLUYEME" caption="Cerrar cuenta" size="small" color="red"}</p>
