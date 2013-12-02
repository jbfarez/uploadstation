<?php
## Global configuration
## --
$config = array( 	'url' 		=> 'http://<URL>',		# Base URL (http://dl.mysite.com)
			'port' 		=> '<PORT>',			# If different of 80
			'uploadDir' 	=> '/data/uploader',		# Root directory for uploads
			'linkDir' 	=> '/sites/uploader/links',	# Links storage
			'urlDir' 	=> 'links',			# Directory url
			'maxFileSize'	=> '104857600',			# Define max upload file size
				);

## Upload configuration
## --

# Allowed file type
$allowed = array(  'application/vnd.ms-word'							=> 'doc',
		   'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 	=> 'docx',
		   'application/vnd.ms-excel'							=> 'xls',
		   'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'		=> 'xlsx',
		   'application/vnd.ms-powerpoint'						=> 'ppt',
		   'application/vnd.openxmlformats-officedocument.presentationml.presentation' 	=> 'pptx',
		   'application/pdf' 								=> 'pdf',
		   'application/x-pdf'								=> 'pdf',
		   'image/jpeg'									=> 'jpg',
		   'image/gif'									=> 'gif',
		   'image/png'									=> 'png',
		   'application/zip'								=> 'zip',
);

?>
