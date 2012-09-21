<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" class="no-js <?php print $classes; ?>">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# hidecache: http://ogp.me/ns/fb/hidecache#">
  <meta charset="utf-8" />
  <meta property="fb:app_id" content="140232946122321" />
  <meta property="og:image"  content="http://hide.mellenger.com/mystery_box.jpg">
  <?php echo $head; ?>

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

  <title><?php echo $head_title; ?></title>

  <!-- Included CSS Files -->
  <?php echo $styles; ?>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Included JS Files -->
  <?php echo $scripts; ?>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyA-Q-RL7EqqBD7Ni9xF1kYyaNgyLybhe6g&sensor=true"></script>
</head>

<body <?php print $attributes;?>>
	<?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>