<?php

// Default process POST function
// --
function process_post(){
  if( isset( $_POST['send'] )){
    $send = $_POST['send'];
    if( $send == "Envoyer" ){
      $file = process_file();
      $link = create_link($file);
      if( ! $_POST['sender'] == '' ){
      	sendMyMail($_POST['sender'], $link);
      }
      print_link($link);
    }
  }
}

// Generate random string to encode url
// --
function getRandomName($length = 18) {
  $validCharacters = "abcdefghijklmnopqrstuxyvwz0123456789";
  $validCharNumber = strlen($validCharacters);
  $result = "";

  // Randomize then put a uniq string
  for ($i = 0; $i < $length; $i++) {
    $index = mt_rand(0, $validCharNumber - 1);
    $result .= $validCharacters[$index];
  }

  return $result;
}

// Processing input file
// --
function process_file(){
  global $config;
  global $allowed;
  $f = $_FILES['fileName'];
  // Check if any file is given
  if( ! $f['name'] == "" ){
    // Check if the standard variables of file has been set
    if (( isset( $f['tmp_name'] )&&( $f['error'] == UPLOAD_ERR_OK ) )){
      $ext = substr($f['name'], strrpos($f['name'], '.') + 1);
      $type = $f['type'];
      $fileAllowed = 0;
      foreach ( $allowed as $key => $value ){
      	if ( ( $ext == $value ) || ( $type == $key ) ){
      	  $fileAllowed = 1;
      	  break;
      	}
      }
      // Check if file name content some spaces
      if ( preg_match( "/\s/", $f['name'] ) ){
      	echo '<div id="uploadError6" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
        echo '<font color="red">'."Cannot add this file, a white space was detected.<br/>";
        echo 'Please check.</font><br/>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
      	die;
      }
      // Check that the file type is authorized
      // if it's needed, some types can be added on config.php
      if ( ! $fileAllowed == 1 ){
      	echo '<div id="uploadError5" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
      	echo '<font color="red">'."Cannot add this file, the filetype is not allowed.<br/>";
      	echo 'Please check.</font><br/>';
      	echo '</div>';
      	echo '</body>';
      	echo '</html>';
      	die;
      }
      // Check if the the size of file is authorized
      if ( $f['size'] >= $config['maxFileSize'] ){
      	echo '<div id="uploadError4" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
        echo '<font color="red">'."Cannot add this file, it's too big.<br/>";
        echo 'Please check it\'s size, it cannot be more than '.( $config['maxFileSize'] / 1000000).'Mo.</font><br/>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
        die;
      }
      // Move the temporary file to the definitive path
      $uploadFile = $config['uploadDir'].'/'.$f['name'];
      if ( ! move_uploaded_file( $f['tmp_name'], $uploadFile )){
      	echo '<div id="uploadError3" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
      	echo '<font color="red">'."Cannot add this file, there was a problem during deplacement.<br/>";
      	echo 'Please contact technical support.</font><br/>';
      	echo '</div>';
      	echo '</body>';
      	echo '</html>';
      	die;
      }else{
      	return $f['name'];
      }
    }else{
      echo '<div id="uploadError2" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
      echo '<font color="red">Cannot process this file.<br/>';
      echo 'Please check.</font><br/>';
      echo '</div>';
      echo '</body>';
      echo '</html>';
      die;
    }
  }else{
    echo '<div id="uploadError1" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
    echo '<font color="red">There is no file to upload !<br/>';
    echo 'Please check your input.</font><br/>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    die;
  }
}

// Create the link to the file
// --
function create_link($file_name){
  global $config;
  $randName = getRandomName();
  // Create directory named by the previously generated random string
  if ( mkdir( $config['linkDir'].'/'.$randName ) ){
    $config['linkDir'] = $config['linkDir'].'/'.$randName;
  }else{
    echo '<div id="linkError2" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
    echo '<font color="red">'."Cannot upload your file.<br/>";
    echo "Please contact technical team.</font><br/>";
    echo '</div>';
    echo '</body>';
    echo '</html>';
    die;
  }
  // Create symbolic link to the real path of the file
  if ( symlink( $config['uploadDir'].'/'.$file_name, $config['linkDir'].'/'.$file_name ) ){
    if ( ! $config['port'] == "" ){
      $linkUrl = $config['url'].$config['port'].'/'.$config['urlDir'].'/'.$randName.'/'.$file_name;
    }else{
      $linkUrl = $config['url'].'/'.$config['urlDir'].'/'.$randName.'/'.$file_name;
    }
    return $linkUrl;
  }else{
    echo '<div id="linkError1" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
    echo '<font color="red">'."Cannot create your link.<br/>";
    echo "Please contact technical team.</font><br/>";
    echo '</div>';
    echo '</body>';
    echo '</html>';
    die;
  }
}

// Print the link to the user
// --
function print_link($linkUrl){
  echo '<div id="linkBox" align=center style="padding:30px;margin:30px;border-radius:10px 10px;">';
  echo "Below, you can find your download link<br/>";
  echo '<br/>';
  echo "<a href=$linkUrl>".$linkUrl."</a>";
  echo '<br/><br/>';
  echo "Thanks for using this service.</font><br/>";
  echo '<br/>';
  echo '<a href="'.$_SERVER['PHP_SELF'].'">'."Back to home".'</a>';
  echo '</div>';
  echo '</body>';
  echo '</html>';
  die;
}
?>
