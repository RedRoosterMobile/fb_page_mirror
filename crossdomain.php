<?php
$url = urldecode($_GET['url']);
#echo $url;
#$url='http://www.facebook.com/Dr.MichaelArndt/photos/a.623879234328530.1073741827.623586034357850/631667260216394/?type=1&relevant_count=1';

  $url= str_replace('http:', 'https:', $url);  
  $curl = curl_init();
 
  // You need to query the feed as a browser.
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.
 
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla');
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, '');
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 100);
 
  $result = curl_exec($curl); // execute the curl command
  
  header('Content-type: text/plain');
  if (isset($result)) {
    echo get_large_image($result);
  } else {
    // curl not working in xamppp on windows.. no error msg whatsoever
    $result = 'https://scontent-b.xx.fbcdn.net/hphotos-ash3/t1.0-9/p180x540/10177434_632082720174848_1989970656143966028_n.jpg';
    echo result;
  }
  curl_close($curl); // close the connection
  
  /**
   * This is the most vulnerable part for changes on facebook side
   * @param html-String $html
   * @return String 
   */
  function get_large_image($html) {
        $start=strpos($html, 'id="fbPhotoImage" src="'); 
  	$parts=explode('"',substr($html, $start));
  	return $parts[3];
  }
?>