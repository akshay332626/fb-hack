<?php
  setcookie("fb_access_token", $_GET['access_token'], time()+7200,"/",".mellenger.com");  /* expire in 1 hour */
  //print $_GET['access_token'].'   :::    '.$_COOKIE['fb_access_token'];
?>
<div class="row">
  <div class="twelve columns">
    <?php if ( $page['header'] ): ?>
      <?php print render($page['header']); ?>
    <?php elseif ($is_front): ?>
      <h1><?php print $site_name; ?></h1>
      <h4 class="subheader"><?php print $site_slogan; ?></h4>
    <?php else: ?>
      <h1><a href="<?php print $front_page; ?>"><?php print $site_name; ?></a></h1>
      <h4 class="subheader"><?php print $site_slogan; ?></h4>
    <?php endif; ?>
  </div>
</div>
<!-- Header -->

<?php if ($page['nav']): ?>
	<div class="row">
		<div class="four columns">
			<hr>
			<?php print render($page['nav']); ?>
		</div>
	</div>
	<!-- Main Navigation -->
<?php endif; ?>

<div class="row"><div class="twelve columns"><hr></div></div>

<div class="row">

	<?php if ($page['left']): ?>
    <div class="three columns">
      <?php print render($page['left']); ?>
    </div>
		<!-- Left sidebar -->
  <?php endif; ?>


  <div class="<?php print $main_columns; ?> columns">

    <?php print $messages; ?>

		<?php if ($tabs): ?>
    	<div class="tabs"><?php print render($tabs); ?></div>
    <?php endif; ?>

    <?php print render($title_prefix); ?>
    <h2><?php print $title; ?></h2>
    <?php print render($title_suffix); ?>

    <?php if ($action_links): ?>
    	<ul class="action-links">
    		<?php print render($action_links); ?>
    	</ul>
    <?php endif; ?>

    <?php print render($page['content']); ?>
  </div>
  <!-- Main content area -->

  <?php if ($page['right']): ?>
    <div class="three columns">
      <?php print render($page['right']); ?>
    </div>
		<!-- Right sidebar -->
  <?php endif; ?>

</div>

<?php if ($page['footer']): ?>
  <div class="row"><div class="twelve columns"><hr></div></div>

  <div class="row">
    <div class="twelve columns">
			<?php print render($page['footer']); ?>
    </div>
  </div>
	<!-- Footer -->
<?php endif; ?>

<script type="text/javascript">

  console.log('this is working?');


(function ($) {


  function success(position){
    $("#field-location-add-more-wrapper").hide();
    $("#edit-field-location-und-0-locpick-user-latitude").val(position.coords.latitude);
    $("#edit-field-location-und-0-locpick-user-longitude").val(position.coords.longitude);
  }

  function error(msg) {
    console.log(arguments);
  }


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
  } else {
    error('not supported');
  }



})(jQuery);


</script>
