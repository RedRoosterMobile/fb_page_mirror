

<?php
    //THEN CALL THE FUNCTION        
    // example: http://www.facebook.com/feeds/page.php?id=623586034357850&format=rss20
    fb_parse_feed('623586034357850', 100);
?> 

<?php
// http://stackoverflow.com/questions/9663700/how-to-show-facebook-feed-messages-from-my-site-without-access-token/9663836#9663836
/**
 * Facebook Page Feed Parser 
 * 
 * @using cURL
 */
function fb_parse_feed( $page_id, $no = 5 ) {
  
  // URL to the Facebook page's RSS feed.
  $rss_url = 'http://www.facebook.com/feeds/page.php?id=' . $page_id . '&format=rss20';
  
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
 
  curl_setopt($curl, CURLOPT_URL, $rss_url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla');
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, '');
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
 
  $raw_xml = curl_exec($curl); // execute the curl command
  curl_close($curl); // close the connection
  
  $xml = simplexml_load_string( $raw_xml);
  
  $out = ''; 
  $i = 1;
  foreach( $xml->channel->item as $item ) {
    $desc= str_replace('<img class="img" ', '<img class="img-rounded" style="margin-right:5px;"', $item->description);
    $out .='<div class="jumbotron media">';
    $out .= '<div class="entry">';
    $out .= '<h3 class="media-heading"><a href="' . get_page_url($item->link) . '">' . $item->title . '</a></h3><br/>';
    $out .= '<div class="badge">' . date("d.m.Y - H:i:s",strtotime($item->pubDate)) . ' von '. $item->author .'</div><br/><br/>';
    $out .= '<div class="media-body">' . $desc . '</div></div>';
    $out .='</div>';

    if( $i == $no ) break;
    $i++;
  }
  echo $out;
}

function get_page_url($link) {
  #s$link='https://www.facebook.com/Dr.MichaelArndt/photos/a.623879234328530.1073741827.623586034357850/626118157437971/?type=1'
  $parts = explode('/', ''.$link);
  $page_alias = $parts[3];
  return "https://www.facebook.com/$page_alias";
}
?>