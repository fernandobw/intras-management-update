<div class="moduletable">
						<div class="acymailing_module" id="acymailing_module_formAcymailing57401">
	<div class="acymailing_fulldiv" id="acymailing_fulldiv_formAcymailing57401">
		<form id="formAcymailing57401" action="{{ url('/suscribir') }}" onsubmit="return submitacymailingform('optin','formAcymailing57401')" method="post" name="formAcymailing57401">
			@csrf
		<div class="acymailing_module_form">
						<table class="acymailing_form">
				<tbody><tr>
												<td class="acyfield_email acy_requiredField">
								<input id="user_email_formAcymailing57401" onfocus="if(this.value == 'Correo electrónico') this.value = '';" onblur="if(this.value=='') this.value='Correo electrónico';" class="inputbox" type="text" name="email" style="width:96%" value="Correo electrónico" title="Correo electrónico">
							</td> 
					
					<td class="acysubbuttons">
												<input class="button subbutton btn btn-primary" type="button" value="Enviar" onclick="newSubscriber()">
											</td>
				</tr>
			</tbody></table>
					
			
									</div>
		</form>
	</div>
	</div>

		</div>


		<script>
			function newSubscriber(){
				$.post( "/suscribir", $( "#formAcymailing57401" ).serialize() )
			      .done(function( data ) {
			      	 if(data.errors){
			         var mensaje = data.errors.email;
			         alert(mensaje);
			     	}
			     	else {
			     	 var mensaje = data.success;
			     	 $('.acymailing_module_form').html('<div class="responseContainer acymailing_module_success slide_open">' + mensaje + '</div>');
			     	}
				}); 
			}
		</script>