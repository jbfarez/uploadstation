<?php

require('config.php');
require('upload.php');
require('mail.php');

?><!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="./favicon.ico">

  <link rel="stylesheet" href="css/global.css" type="text/css">

  <script type="text/javascript" src="functions.js"></script>

  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>Upload Station</title>
</head>
<body>

  <div id="main">
  <?php
	try{
		process_post();
	}catch(Exception $e){
		echo '<div id=error>'.$e->getMessage().'</div>';
	}
  ?>
  <div id="header">
    <a href="index.php"></a>
  </div>
  <div id="uploadForm">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
  	<table border=0 align=center>
  	  <tr>
  		<td colspan=2 align=center bgcolor="#aba49e" style="padding:10px;margin:10px;border-radius:10px 10px;">
  		<font color="white" size="5">File Store</font>
  		</td>
  	  </tr>
  	  <tr>
  		<td border=1 colspan=2 style="padding:10px;margin:10px;" bgcolor="white">
  		  <font color="#aba49e" size="5">File informations</font><br/>
  		  <li>Max file size : <b>100 Mo</b></li>
  		  <li>Max files : <b>Illimit&eacute;</b></li>
  		  <li>Max retention time : <b>15 Days</b></li>
  		  <li>Authorized file type : <b>Office documents (doc[x],xls[x],ppt[x]), PDFs, Images, Archives .zip</b></li>
  		  <font color="red" size="1">* Warning : File name cannot contain any blank spaces, you can substitute it by - or _ .</font>
  		</td>
  	  </tr>
  	  <tr>
  		<td colspan=2 style="padding:10px;margin:10px;"  bgcolor="white">
  		  <b>File to upload<font color="red"> *</font> :</b> 
  		  <input id="fileName" type="file" name="fileName">
  		</td>
  	  </tr>
  	  <tr>
  		<td colspan=2 style="padding:10px;margin:10px;" bgcolor="white">
  		  <font color="#aba49e" size="5">Contact informations</font><br/>
  		  E-Mail : <input id="mail" type="text" name="sender" size="40" maxlength="100"><br/>
  		  <br/>
  		</td>
  	  </tr>
  	  <tr>
  		<td align=center style="padding:10px;margin:10px;">
  		<input type="submit" name="send" value="Envoyer"></td>
  	  </tr>
  	</table>
    </form>
  </div>
  <div id="footer">
          &copy; <b>#YOUR_SIGN#</b> <?php echo date('Y'); ?> - <a href="<A_CONTACT_FORM>">Contact</a>
  </div>
  </div>
</body>
</html>
