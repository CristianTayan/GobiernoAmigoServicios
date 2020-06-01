<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<!-- provide the csrf token -->
 <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<title>Reseet Password</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
	rel="stylesheet">

<!-- Styles -->
<style>
html, body {
	background-color: #fff;
	color: #636b6f;
	font-family: 'Nunito', sans-serif;
	font-weight: 200;
	height: 100vh;
	margin: 0;
}

.full-height {
	height: 100vh;
}

.flex-center {
	align-items: center;
	display: flex;
	justify-content: center;
}

.position-ref {
	position: relative;
}

.top-right {
	position: absolute;
	right: 10px;
	top: 18px;
}

.content {
	text-align: center;
}

.title {
	font-size: 84px;
}

.links>a {
	color: #636b6f;
	padding: 0 25px;
	font-size: 13px;
	font-weight: 600;
	letter-spacing: .1rem;
	text-decoration: none;
	text-transform: uppercase;
}

.m-b-md {
	margin-bottom: 30px;
}
</style>
</head>
<body>
	<script type="text/javascript"> 
	$( document ).ready(function() {
		 $("#send-form").click(function(e){
		    	e.preventDefault();
	 	var forms = $('.needs-validation');
	  // Loop over them and prevent submission
	  var validation = Array.prototype.filter.call(forms, function(form) {
	     if (form.checkValidity() === false) {	
	        return false;//no se valuda
	        console.log("no valido");
	      }else{
	    	  console.log("valido");
	      	 form.classList.add('was-validated');
	      	    var email = $("#email").val();
	      	   	var pass = $("#pass").val();
	      	   	var repass = $("#repass").val();

	      	   

	      	   	if(pass!=repass){
	      	   	alertaShow('men-contac-err');
	          	   	return;
	      	   	}else{
	      	   	var ruta=$("#accion-form").val();
	     		 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	             
	              var DTO={_token:CSRF_TOKEN,  correo:email, pass:pass, repass:repass}
	              
	              
	              $.ajax({
	     	           url: ruta,
	     	           type:'POST',
	     	           dataType: 'JSON',
	     	           data: DTO,
	     	           success: function(data, textStatus) {
	     	        	  if(textStatus === 'success') {
	     	        		 alertaShow('men-contac-sus');
	     	                	$('.needs-validation').trigger("reset");
	     	                	$('.needs-validation').removeClass('was-validated');
	     	                }else{
	     	        	    	 alertaShow('men-contac-err');
	     	        	   }
	     	           },
	     	           error: function (data, textStatus, errorThrown) {
	     	        	   if(data.status === 422) {
	     	        		  alertaShow('men-contac-err');
	     	                }else if(data.statusText=='OK'){
	     	                	alertaShow('men-contac-sus');
	     	                	$('.needs-validation').trigger("reset");
	     	                	$('.needs-validation').removeClass('was-validated');
	     	        	      }else{
	     	        	    	 alertaShow('men-contac-err');
	     	        	   }
	     	        	   
	     	        	   }
	     	       }); 	
	      	   	}
	      	   	

	      	   }
	      });
	 });
		
		});
	
 	function alertaShow(alerta){
 		  console.log(alerta);
 		  console.log($("."+alerta));
 		  $("."+alerta).attr('hidden',false);
 		  setTimeout( function(){ 
 			  $("."+alerta).attr('hidden',true);
 			  }  , 10000 );
 	  }

	 
	 

</script>
	<div class="row" style="padding-left: 15%; padding-right: 15%;">
		<div
			class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center"
			style="height: 30px;"></div>
	</div>
	<div class="row" style="padding-left: 15%; padding-right: 15%;">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-left">
			<div class="card shadow bg-white rounded">
				<div class="card-body">
					<h3 class="card-title text-center">Formulario de Recuperación de
						Password</h3>
					<form class="needs-validation" novalidate>
						<input id="accion-form" hidden="true" type="text"
							value="{{ route('reset') }}">
							<input id="email" hidden="true" type="text"
							value="{{$imail}}">
						<div class="form-group">
							<label for="pass">Password:</label> <input type="password"
								class="form-control" id="pass" name="pass" required
								maxlength="250">
							<div class="invalid-feedback">Por favor ingrese Password</div>
						</div>
						<div class="form-group">
							<label for="repass">Re-password:</label> <input type="password"
								class="form-control" id="repass" name="repass" required
								maxlength="250">
							<div class="invalid-feedback">Por favor ingrese Re-password</div>
						</div>


						<div id="content-btn"
							style="height: 50px; background-color: #74c344; display: flex; margin-top: 3px;">

							<button id="send-form" type="button"
								class="btn-buy text-uppercase" style="width: 100%;">Enviar</button>
						</div>
						<div hidden="true" class="alert alert-success men-contac-sus"
							role="alert">Tu password ha sido cambiado correctamente.</div>
						<div hidden="true" class="alert alert-danger men-contac-err"
							role="alert">Algo sucedió, tu password intente de nuevo mas tarde.</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="row" style="padding-left: 15%; padding-right: 15%;">
		<div class="col-lg-12 text-center" style="height: 50px;"></div>
	</div>
</body>
</html>
