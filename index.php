<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Praxis Dr. Arndt</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>

        
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' type='text/css'>

        <script type="text/javascript">
            $(document).ready(function() {
              console.log('ass');
              $('.media-body a[href^="http://"]').click(function(event){
                event.preventDefault();
                console.log($(event.target).parent()[0].href);
                console.log(this.href);
                $href=this.href;
                $.get( 'crossdomain.php',{url: $href}, function( data ) {
                  $.fancybox.open( {href : data, title : null})
                });
                return false;
              });
            });
        </script> 
  </head>
  <body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Praxis Dr. Arndt</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Neuigkeiten</a></li>
        <li><a href="#">Impressum</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">

<?php
//THEN CALL THE FUNCTION        

//http://www.facebook.com/feeds/page.php?id=623586034357850&format=rss20
fb_parse_feed('623586034357850', 10);
?> 
</div>

  </body>
</html>
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
// <img class="img-rounded" src="http://photos-a.ak.fbcdn.net/hphotos-ak-prn1/t1.0-0/10177521_631039060279214_2025727403000335029_s.jpg" alt="">
    $desc= str_replace('<img class="img" ', '<img class="img-rounded" style="margin-right:5px;"', $item->description);
    $out .='<div class="jumbotron media">';
    $out .= '<div class="entry">';
    $out .= '<h3 class="media-heading"><a href="' . get_page_url($item->link) . '">' . $item->title . '</a></h3><br/>';
    $out .= '<div class="badge">' . date("d.m.Y - H:i:s",strtotime($item->pubDate)) . ' von '. $item->author .'</div><br/><br/>';
    $out .= '<div class="media-body">' . $desc . '</div></div>';
    $out .='</div>';
    /*
    $out.='<div class="panel panel-default">';
    $out.='  <div class="panel-heading"><a href="' . get_page_url($item->link) . '">' . $item->title . '</a></h3><br/></div>';
    $out.='  <div class="panel-body">';
    $out .= '<div class="media-body">' . $desc . '</div></div>';
    $out.='  </div>';
    $out.='</div>';
*/

    if( $i == $no ) break;
    $i++;
  }
  
  echo $out;


}
function get_page_url($link) {
  #s$link='https://www.facebook.com/Dr.MichaelArndt/photos/a.623879234328530.1073741827.623586034357850/626118157437971/?type=1'
  $parts=explode('/', ''.$link);
  $page_alias=$parts[3];
  return "https://www.facebook.com/$page_alias";
}



?>