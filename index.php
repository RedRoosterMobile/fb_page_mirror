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
                //console.log($(event.target).parent()[0].href);
                //console.log(this.href);
                $href = this.href;
                $.get( 'crossdomain.php',{url: $href}, function( data ) {
                  $.fancybox.open( {href : data, title : null})
                });
                return false;
              });
            });
        </script> 
  </head>
  <body>
<?php 
 include 'navigation.facebook.php';
?>
<div class="container">
<?php
include 'content.facebook.php';

?>
</div>

  </body>
</html>