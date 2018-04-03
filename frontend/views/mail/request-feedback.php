<?php if($language == 'en'): ?>
	<div>
		<div style="margin-bottom: 15px">Dear <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Thank you for traveling with The China Guide!</div>
		
		<div style="margin-bottom: 15px">My name is Emily France, Customer Experience Manager at The China Guide. I hope that you have had a fantastic trip and that all of our services have met your expectations.</div>
			
		<div style="margin-bottom: 15px">Since your trip has come to an end, we would like to take this opportunity to ask if you could take a few minutes to complete <a href="https://www.thechinaguide.com/feedback-form?cd=<?= $code; ?>" target="_blank">our online feedback form</a>. Not only does your feedback help us to keep improving our services, you will also receive a voucher to put towards a tour with The China Guide that you can use yourself or pass on to family and friends.</div>
		
		<div style="margin-bottom: 15px">Thank you in advance!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Customer Experience Manager</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Website: <a href="https://www.thechinaguide.com" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php elseif($language == 'fr'): ?>
	<div>
		<div style="margin-bottom: 15px">Bonjour M/Mme <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Nous vous remercions d'avoir voyagé avec The China Guide !</div>
		
		<div style="margin-bottom: 15px">Je m'appelle Emily France, et je suis le manager de l'expérience client. J'espère que vous avez fait un agréable voyage et que nos services ont été à la hauteur de vos attentes.</div>
			
		<div style="margin-bottom: 15px">Puisque votre voyage touche à sa fin, nous aimerions profiter de l'occasion pour vous demander si vous pourriez prendre quelques minutes pour remplir <a href="https://www.thechinaguide.com/fr/feedback-form?cd=<?= $code; ?>" target="_blank">notre formulaire de commentaires en ligne</a>. Non seulement vos commentaires nous aident à améliorer nos services, mais vous recevrez également un bon d'achat pour une visite guidée avec The China Guide que vous pouvez utiliser vous-même ou transmettre à votre famille et à vos amis.</div>
		
		<div style="margin-bottom: 15px">Je vous remercie d'avance,</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Manager de l'expérience client</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Site Internet: <a href="https://www.thechinaguide.com/fr" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php elseif($language == 'de'): ?>
	<div>
		<div style="margin-bottom: 15px">Liebe/r <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Danke für die Reise mit The China Guide!</div>
		
		<div style="margin-bottom: 15px">Mein Name ist Emily France, ich bin Customer Experience Manager bei The China Guide. Ich hoffe, Sie hatten eine fantastische Reise und alle unsere Dienstleistungen haben Ihre Erwartungen erfüllt.</div>
			
		<div style="margin-bottom: 15px">Ihre Reise ist nun zu Ende. Wir möchten diese Gelegenheit nutzen, um zu fragen, ob Sie sich ein paar Minuten Zeit nehmen können, <a href="https://www.thechinaguide.com/de/feedback-form?cd=<?= $code; ?>" target="_blank">um  uns zu bewerten</a>. Ihr Feedback hilft uns nicht nur unseren Service zu verbessern, sondern Sie erhalten auch einen Gutschein für eine Tour mit The China Guide, den Sie selbst verwenden oder an Familie und Freunde weitergeben können.</div>
		
		<div style="margin-bottom: 15px">Vielen Dank im Voraus!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Customer Experience Manager</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Webseite: <a href="https://www.thechinaguide.com/de" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php else: ?>
	<div>
		<div style="margin-bottom: 15px">Estimado/a <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">¡Gracias por elegir a The China Guide para su viaje!</div>
		
		<div style="margin-bottom: 15px">Mi nombre es Emily France y soy Gerente de experiencia al cliente en The China Guide. Espero que haya tenido un fantástico viaje y que todos nuestros servicios hayan encajado con sus expectativas. </div>
			
		<div style="margin-bottom: 15px">Ahora que su viaje ha terminado nos gustaría aprovechar esta oportunidad para preguntar si podría tomar unos minutos de su tiempo para completar <a href="https://www.thechinaguide.com/es/feedback-form?cd=<?= $code; ?>" target="_blank">nuestro feedback en línea</a>. Sus comentarios nos ayudan a mejorar nuestros servicios continuamente y le proporcionarán un cupón que puede emplear para un nuevo tour con The China Guide o que puede regalar a sus familiares o amigos.</div>
		
		<div style="margin-bottom: 15px">¡Gracias de antemano!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Gerente de experiencia al cliente</div>
		<div>Correo electrónico: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Página electrónica: <a href="https://www.thechinaguide.com/es" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php endif; ?>