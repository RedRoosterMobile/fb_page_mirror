<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
      <a class="navbar-brand" href="index.php">Praxis Dr. Arndt</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php echo (current_page()=='home') ? 'class="active"':''; ?>><a href="index.php">Neuigkeiten</a></li>
        <li <?php echo (current_page()=='impressum') ? 'class="active"':''; ?>><a href="index.php?page=impressum">Impressum</a></li>
        <li <?php echo (current_page()=='kontakt') ? 'class="active"':''; ?>><a href="index.php?page=kontakt">Kontakt</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
