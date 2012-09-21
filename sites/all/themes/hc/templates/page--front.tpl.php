<?php
    /* PHP FUNCTIONS*/

    function curl_get_file_contents($URL) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        $err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
        curl_close($c);
        if ($contents) return $contents;
        else return FALSE;
      }

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
    
    
    
    
    
    <?php  /* FACEBOOK CONNECT */ ?>
    
     <div id="fb-root"></div>
    <script>
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '140232946122321', // App ID
          channelUrl : '//'+window.location.hostname+'/channel', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        // listen for and handle auth.statusChange events
        FB.Event.subscribe('auth.statusChange', function(response) {
          if (response.authResponse) {
          console.log(response.authResponse.accessToken);
            // user has auth'd your app and is logged into Facebook
            FB.api('/me', function(me){
              if (me.name) {
                document.getElementById('auth-displayname').innerHTML = me.name;
              }
            })
            document.getElementById('auth-loggedout').style.display = 'none';
            document.getElementById('auth-loggedin').style.display = 'block';
            window.location = "/node/add/cache?access_token="+response.authResponse.accessToken;
          } else {
            // user has not auth'd your app, or is not logged into Facebook
            document.getElementById('auth-loggedout').style.display = 'block';
            document.getElementById('auth-loggedin').style.display = 'none';
          }
        });

        // respond to clicks on the login and logout links
        
        
        document.getElementById('auth-loginlink').addEventListener('click', function(){
          FB.login();
        });
        document.getElementById('auth-logoutlink').addEventListener('click', function(){
          FB.logout();
        }); 
      } 
    </script>

    <p>Login with facebook</p>
      <div id="auth-status">
        <div id="auth-loggedout">
          <a href="#" id="auth-loginlink">Login</a>
        </div>
        <div id="auth-loggedin" style="display:none">
          Hi, <span id="auth-displayname"></span>  
        (<a href="#" id="auth-logoutlink">logout</a>)
      </div>
    </div>



    
    
    
    
    
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