
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
    
    
    
    
    
    <?php  /* FACEBOOK CONNECT */ 
        

   $config = array(
    'appId' => '140232946122321',
    'secret' => 'a3f0f7dc94ca89e92dc513eb541e48dc',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  
  if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "Name: " . $user_profile['name'];

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $relog=1;
      }   
    } else {
       $relog=1;
    }
    
    if($relog == 1){
     ?>
     
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '140232946122321', // App ID
          channelUrl : '//hide.mellenger.com', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });
    
        // Additional initialization code here
      };
    
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));
    </script>
    
    <div class="fb-login-button" scope="publish_actions">
        Connect with Facebook
     </div>
     
     <?php
         }
  ?>


    
    
    
    
    
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