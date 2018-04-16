<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>PRNewswire</title>
 
	<script>
		var news = <?=$news?>;
		numberOfEmails = 1;			
	</script>
 	 <!-- Latest compiled and minified JavaScript -->	
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/scripts.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">


	
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetModal()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Lista de Emails</h4>
      </div>
      <div class="modal-body" id="modalBody">
        <form class="form-inline" id="formEmails" name="formEmails">
		  <div class="form-group">
		    <label for="email1">Email 1</label>
		    <input type="email" name="email1" class="form-control" id="email1" placeholder="email de destino">
		  </div>	  
		</form>
		<a onclick="addFieldEmail()" style="cursor: pointer;">Adionar outro email...</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetModal()">Fechar</button>
        <button type="button" class="btn btn-primary"  onclick="sendEmail()">Enviar Emails</button>
      </div>
    </div>
  </div>
</div>

<div id="container1">
	<h1>Adminitrador de Notícias</h1>

	<div id="body">
		<p>Escolha as Not&iacute;cias:</p>

		<div id="listNews">
			<ul id="optionsList">
			</ul>
    	</div>
    </div>
</div>


<div id="container2"	>	
	<h1>Prévia da newsletter
		<div  style="display: flex; float: right;">			
			<button type="button" class="btn btn-primary" style="padding: 3px 6px; width: 200px;" data-toggle="modal" data-target="#myModal">
			  Enviar Emails
			</button>
		</div>
	</h1>
	
	<div id="holder-previa">
		<div id="previa" style="width: 500px;">
			<div style="width: 100%;	">
				<h1 style=" height: 40px; text-align: center;">CORPO DO EMAIL</h1>
			</div>
			<div id="emailBody">
    			<div id="emailBanner">
    				<img src="assets/img/newsletter.jpg" alt="banner do email" id="img-banner" >
    			</div>
    			<div id="emailContent"> 
    			</div>
			</div>			
		</div>
	</div>
</div>
</body>
</html>

