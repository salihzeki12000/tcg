<?php if($language == 'en'): ?>
	<div>
		<div style="margin-bottom: 15px">Dear <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Thank you for taking the time to give us your feedback. Below is your voucher information.</div>
		
		<div style="margin-bottom: 15px">Code: <?= $voucher->code ?><br>Value: CNY <?= $voucher->value ?></div>
			
		<div style="margin-bottom: 15px">Terms and Conditions: You can use this voucher for your next tour with us or pass it on to family and friends. This voucher can be used on tours with a duration of two or more days. Only one voucher may be used per tour.</div>
		
		<div style="margin-bottom: 15px">To use the voucher, simply mention the code to your travel specialist at the time of booking.</div>
		
		<div style="margin-bottom: 15px">We hope to see you again soon!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Customer Experience Manager</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Website: <a href="https://www.thechinaguide.com" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php elseif($language == 'fr'): ?>
	<div>
		<div style="margin-bottom: 15px">Bonjour M/Mme <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Merci d'avoir pris le temps de donner votre avis. Voici les informations de votre bon.</div>
		
		<div style="margin-bottom: 15px">Code: <?= $voucher->code ?><br>Valeur: CNY <?= $voucher->value ?></div>
			
		<div style="margin-bottom: 15px">Termes et conditions: vous pouvez utiliser ce bon pour votre prochain circuit ou le donner à votre famille ou amis. Ce bon peut être utilisé sur des circuits de deux jours ou plus. Un seul coupon peut être utilisé par circuit.</div>
		
		<div style="margin-bottom: 15px">Pour utiliser le coupon, il suffit de mentionner le code à votre agent de voyage au moment de la réservation.</div>
		
		<div style="margin-bottom: 15px">Nous espérons vous revoir bientôt !</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Manager de l'expérience client</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Site Internet: <a href="https://www.thechinaguide.com/fr" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php elseif($language == 'de'): ?>
	<div>
		<div style="margin-bottom: 15px">Liebe/r <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Vielen Dank, dass Sie sich die Zeit genommen haben, uns Ihr Feedback zu geben. Im Folgenden finden Sie Ihre Gutscheininformationen.</div>
		
		<div style="margin-bottom: 15px">Code: <?= $voucher->code ?><br>Wert: CNY <?= $voucher->value ?></div>
			
		<div style="margin-bottom: 15px">Allgemeine Geschäftsbedingungen: Sie können diesen Gutschein für Ihre nächste Tour mit uns nutzen oder an Familie und Freunde weitergeben. Dieser Gutschein kann für Touren mit einer Dauer von zwei oder mehr Tagen verwendet werden. Pro Tour kann nur ein Gutschein verwendet werden.</div>
		
		<div style="margin-bottom: 15px">Um den Gutschein einzulösen, teilen Sie den Code einfach bei der nächsten Buchung Ihrem Reiseberater mit.</div>
		
		<div style="margin-bottom: 15px">Wir hoffen, Sie bald wiederzusehen!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Customer Experience Manager</div>
		<div>Email: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Webseite: <a href="https://www.thechinaguide.com/de" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php else: ?>
	<div>
		<div style="margin-bottom: 15px">Estimado/a <?= $contact ?>,</div>
		
		<div style="margin-bottom: 15px">Gracias por ofrecernos sus valiosos comentarios. Debajo puede encontrar la información de su cupón.</div>
		
		<div style="margin-bottom: 15px">Código: <?= $voucher->code ?><br>Valor: CNY <?= $voucher->value ?></div>
			
		<div style="margin-bottom: 15px">Términos y condiciones: Puede emplear este cupón para su siguiente tour con nosotros o bien, cederlo a sus familiares y amigos. Este cupón puede utilizarse para tours de dos días o más de duración. Solamente se puede utilizar un cupón por tour.</div>
		
		<div style="margin-bottom: 15px">Para utilizar el cupón simplemente debe mencionar el código a su especialista de viajes al momento de hacer una reserva.</div>
		
		<div style="margin-bottom: 15px">¡Esperamos verlos de nuevo pronto!</div>
		
		<div style="margin-bottom: 15px">Emily France</div>
		
		<div>Gerente de experiencia al cliente</div>
		<div>Correo electrónico: <a href="mailto:feedback@thechinaguide.com">feedback@thechinaguide.com</a></div>
		<div>Página electrónica: <a href="https://www.thechinaguide.com/es" target="_blank">www.thechinaguide.com</a></div>
	</div>
<?php endif; ?>