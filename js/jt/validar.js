 
          /*    $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messageci').hide('fast');

                $('#cedula').on('keyup', function () {
                	$('#messageci').show('fast');                   
                   $('.flash-msg').delay(500).fadeOut('slow');

                   $('.todovalidado').show('fast');
                   

                });
            }); */

/*Validar CI Ecuatoriana*/
 $(document).ready(function () {
 	 			
 				$('.todovalidado').hide('fast');
                $('#messageci').hide('fast');
                 var exnombre=/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/;
                $('#cedula').on('keyup', function () {
                    if ((exnombre.exec($('#cedula').val()))) {
                        $('#messageci').show('fast');
                        $('#messageci').html('<div class="alert alert-danger flash-msg"> Ingrese el número de cédula correcto <br>Ejm: 0603822412.</div>');
                        $('.flash-msg').delay(2000).fadeOut('slow');
                        $('.todovalidado').hide('fast');
                    } else {
                        if ($('#cedula').val().length == 10) {
                            var cedula = $('#cedula').val();
                            var array = cedula.split("");
                            var num = array.length;
                            var total = 0;
                            var digito = (array[9] * 1);
                            for (i = 0; i < (num - 1); i++)
                            {
                                var mult = 0;
                                if ((i % 2) != 0) {
                                    total = total + (array[i] * 1);
                                }
                                else
                                {
                                    mult = array[i] * 2;
                                    if (mult > 9)
                                        total = total + (mult - 9);
                                    else
                                        total = total + mult;
                                }
                            }
                            var decena = total / 10;
                            decena = Math.floor(decena);
                            decena = (decena + 1) * 10;
                            var final = (decena - total);
                            if(final==10)
                                final=final.toString().substr(1, 1);
                            //document.write('Valor de final es: '+final);
                            //document.write('Valor de digito es: '+digito);

                            $('#messageci').show('fast');

                            if (final == digito) {
                                $('#messageci').html('<div class="alert-success flash-msg"> Cédula Correcta.</div>');
                                $('.flash-msg').delay(2000).fadeOut('slow');
                                $('.todovalidado').show('fast');
                					
                            }
                            else {
                                $('#messageci').html('<div class="alert-danger flash-msg"> Cédula no valida.</div>');
                                $('.flash-msg').delay(2000).fadeOut('slow');
                                $('.todovalidado').hide('fast');
                            }
                        }
                    }
                });
            });
/*  $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messageapellidos').hide('fast');
                var exnombre=/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/;

                $('#apellidos').on('keyup', function () {
                    var apellido = document.getElementById("apellidos");
                    if (!(exnombre.exec(apellido.value)))
                    {
                         $('#messageapellidos').html('<div class="alert-danger flash-msg"> El campo apellidos solo aceptaletras y espacios en blanco</div>');
                         $('#messageapellidos').show('fast');                   
                         $('.flash-msg').delay(2000).fadeOut('slow');
                         $('.todovalidado').hide('fast');
                    }

                    else
                    {
                        $('.todovalidado').show('fast');
                        $('#messageapellidos').hide('fast'); 
                    }
                   

                });
            }); */
 /*Fin de validar CI Ecuatoriana*/

 /*Validar Nombre*/
 $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messagenombres').hide('fast');
                var exnombre=/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/;

                $('#nombres').on('keyup', function () {
                	var nombre = document.getElementById("nombres");
                	if (!(exnombre.exec(nombre.value)))
			    	{
			    		 $('#messagenombres').html('<div class="alert-danger flash-msg"> El campo nombres solo acepta letras y espacios en blanco</div>');
                		$('#messagenombres').show('fast');                   
                   		$('.flash-msg').delay(2000).fadeOut('slow');
                   		$('.todovalidado').hide('fast');
                   		}               
                   else
                	{
                		$('.todovalidado').show('fast');
                		$('#messagenombres').hide('fast'); 
                	}
                   

                });
            });

 /*Fin Validar Nombre*/

 /*Validar Apellidos*/
 $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messageapellidos').hide('fast');
                var exnombre=/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/;

                $('#apellidos').on('keyup', function () {
                	var apellido = document.getElementById("apellidos");
                	if (!(exnombre.exec(apellido.value)))
			    	{
			    		 $('#messageapellidos').html('<div class="alert-danger flash-msg"> El campo apellidos solo aceptaletras y espacios en blanco</div>');
			    		 $('#messageapellidos').show('fast');                   
                  		 $('.flash-msg').delay(2000).fadeOut('slow');
                  		 $('.todovalidado').hide('fast');
			    	}

                	else
                	{
                		$('.todovalidado').show('fast');
                		$('#messageapellidos').hide('fast'); 
                	}
                   

                });
            });

 /*Fin Validar Apellidos*/

 /*Inicia Validar Telefono*/
    $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messagetelefono').hide('fast');
                var extelefono=/^(09)[0-9]+$/;

                $('#telefono').on('keyup', function () {
                    var telefono = document.getElementById("telefono");
                    if (!(extelefono.exec(telefono.value)) && telefono.value.length>=3)
                    {
                     $('#messagetelefono').show('fast');  
                     $('#messagetelefono').html('<div class="alert-danger flash-msg"> El telefono debe ser solo numeros e iniciar con 09..</div>');
                         $('.flash-msg').delay(2000).fadeOut('slow');
                         $('.todovalidado').hide('fast');
                    }
                    else
                    { 
                        $('.todovalidado').show('fast'); 
                        $('#messagetelefono').hide('fast'); 
                    }
                   

                });
            });
 /*Fin Validar Telefono*/

 /* Validar Mail*/
   
  $(document).ready(function () {
                $('.todovalidado').hide('fast');
                $('#messagemail').hide('fast');
               
                var exmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

                $('#mail').on('keyup', function () {
                    var mail = document.getElementById("mail");
                    if (!(exmail.exec(mail.value)) && mail.value.length>=5)
                    {
                     $('#messagemail').show('fast');  
                     $('#messagemail').html('<div class="alert-danger flash-msg"> El mail debe tener un formato como usuario@ejemplo.com</div>');
                         $('.flash-msg').delay(2000).fadeOut('slow');
                         $('.todovalidado').hide('fast');
                    }
                    else
                    { 
                        $('.todovalidado').show('fast'); 
                        $('#messagemail').hide('fast'); 
                    }
                   

                });
            });

 /*Fin Validar Mail*/

