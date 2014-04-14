<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include 'lib.controller.php'; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Praxis Dr. Arndt - <?php echo ucfirst(current_page()); ?></title>
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
              $('.media-body a[href^="http://"]').click(function(event) {
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
    <?php include 'navigation.php'; ?>
    <div class="container">
        <?php 
        // add your new pages here.. 
        // @TODO: htaccess for this stuff
        switch(current_page()) {
            case 'home': 
                include 'content.facebook.php';
                break;
            case 'impressum':
                include 'content.impressum.php';
                break;
            case 'kontakt':
                include 'content.kontakt.php';
                break;
            default: 
                include 'content.facebook.php';
                break;
        }
            
        ?>
    </div>
  </body>
</html>
