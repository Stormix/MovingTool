<?php 
/*
======================================================================
 Copyright : Copyright (c) 2016 Anas Mazouni - Stormix. All rights reserved.
 Version : 1.0
 Release Date : 28-07-2016
 License : The MIT License (MIT)
 "Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE."
----------------------------------------------------------------------
 http://www.Stormix.co/               
 http://www.facebook.com/stormiix
======================================================================
*/

//Unlimited max execution time
set_time_limit(0); 

//Config Me
$path = 'dummy.jpg'; //The path where to save the downloaded file.
$url = 'https://stormix.co/dummy.jpg'; //The file to download

//This controles how fast will the file be downloaded. 
//But you should know that the download speed varies from server to server and depends on how fast your server's internet connection is.
$step = 1024 * 100; //100Kb chunks are moved on each loop

/* HANDY FUNCTIONS */
//Ignore this and scroll to ligne : 91
 /**
 * Returns the size of a file without downloading it, or -1 if the file
 * size could not be determined.
 *
 * @param $url - The location of the remote file to download. Cannot
 * be null or empty.
 *
 * @return The size of the file referenced by $url, or -1 if the size
 * could not be determined.
 */

function curl_get_file_size( $url ) {
  // Assume failure.
  $result = -1;

  $curl = curl_init( $url );

  // Issue a HEAD request and follow any redirects.
  curl_setopt( $curl, CURLOPT_NOBODY, true );
  curl_setopt( $curl, CURLOPT_HEADER, true );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 // curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );

  $data = curl_exec( $curl );
  curl_close( $curl );

  if( $data ) {
    $content_length = "unknown";
    $status = "unknown";

    if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
      $status = (int)$matches[1];
    }

    if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
      $content_length = (int)$matches[1];
    }

    // http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
    if( $status == 200 || ($status > 300 && $status <= 308) ) {
      $result = $content_length;
    }
  }

  return $result;
} 
//Convert bytes to a Human Readable File Size 
function human_filesize($size, $precision = 2) {
    $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision).$units[$i];
}
/* MAIN FUNCTION */
$remote = fopen($url, 'r'); //Fopen remote file
$local = fopen($path, 'w'); //Fopen local file
//Set read_bytes to 0 for the first time
$read_bytes = 0;
// Read until the end of the remote file
  while(!feof($remote)) { 
    // Read 100KB and write them to the local file
    $buffer = fread($remote, $step);
    fwrite($local, $buffer);
    $read_bytes += $step; 
    // Get progress percentage from the read bytes and total length
    //$progress = round(min(100, 100 * $read_bytes / $filesize),2);
  } 
  // Close the handles of both files
fclose($remote);
fclose($local); 
 
?>
<!DOCTYPE html>
  <html>
    <head> 
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

    </head>

    <body>
     <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <br><br>
          <h1 class="header center purple-text">Done moving your <b><?= human_filesize(curl_get_file_size($url)); ?></b> file !</h1>
          <div class="row center">
            <h5 class="header col s12 light"><b><?= $url ?></b> was successfully moved to <b>/<?= $path ?></b> !</h5>
          </div>
          <div class="row center">
 
          </div>
          <br><br>

        </div>
      </div>


 <footer class="row center">
      <div class="footer-copyright">
      <div class="container">
      Made by <a class="purple-text text-lighten-3" href="https://stormix.co/">Stormix</a>
      </div>
    </div>
  </footer>   
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script> 
    </body>
  </html>
        