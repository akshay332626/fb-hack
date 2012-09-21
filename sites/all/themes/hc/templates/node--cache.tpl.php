<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */

//   <meta property="og:type"                        content="your-og-app:restaurant">
$og_type = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'og:type',
    'content' => 'hidecache:cache',
  ),
);

//   <meta property="og:url"                        content="your url">
$og_url = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'og:url',
    'content' => 'http://hide.mellenger.com' . $node_url,
  ),
);

//   <meta property="og:title"                       content="Sample Restaurant"> 
$og_title = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'og:title',
    'content' => $title,
  ),
);
//   <meta property="og:description"                 content="A great sample restaurant"> 
$og_description = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'og:description',
    'content' => 'find me!',
  ),
);
//   <meta property="og:image"                       content="https://your-great-image">

//   <meta property="your-og-app:location:latitude"  content="37.416382"> 
$og_lat = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'hidecache:location:latitude',
    'content' => $node->field_location['und'][0]['latitude'],
  ),
);
//   <meta property="your-og-app:location:longitude" content="-122.152659"> 
$og_lng = array(
  '#tag' => 'meta', 
  '#attributes' => array(
    'property' => 'hidecache:location:longitude',
    'content' => $node->field_location['und'][0]['longitude'],
  ),
);

//   <meta property="your-og-app:location:altitude"  content="42">



drupal_add_html_head($og_type, 'og_type');
drupal_add_html_head($og_url, 'og_url');
drupal_add_html_head($og_title, 'og_title');
drupal_add_html_head($og_description, 'og_description');
drupal_add_html_head($og_lat, 'og_lat');
drupal_add_html_head($og_lng, 'og_lng');


?>
<script>  

var umarker;

var yourlat;
var yourlng;

var cachelat = <?php print $node->field_location['und'][0]['latitude'];?>;
var cachelng = <?php print $node->field_location['und'][0]['longitude'];?>

var found = false;

  function success(position) {


    var clatlng = new google.maps.LatLng(cachelat, cachelng);
    var myOptions = {
      zoom: 13,
      center: clatlng,
      mapTypeControl: false,
      navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);


    var goldStar = {
      path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
      fillColor: "red",
      fillOpacity: 1,
      scale: 0.25,
      strokeColor: "gold",
      strokeWeight: 2
    };

    var cmarker = new google.maps.Marker({
        position: clatlng, 
        map: map, 
        icon: goldStar,
        title:"find this cache"
    });

    
    console.log(position);

    var ulatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    
    umarker = new google.maps.Marker({
        position: ulatlng, 
        map: map, 
        title:"You are here! (at least within a "+position.coords.accuracy+" meter radius)"
    });

  }

function error(msg) {
  document.getElementById("mapcanvas").innerHTML("Please share your location");
  console.log(arguments);
}

function locUpdate(position){

  var uplatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  umarker.setPosition(uplatlng);

  yourlat = position.coords.latitude;
  yourlng = position.coords.longitude;

  reveal();

}


function reveal(){

  var accuracy = 100;

  yourlat  = Math.floor(yourlat*accuracy)/accuracy;
  cachelat = Math.floor(cachelat*accuracy)/accuracy;
  yourlng  = Math.floor(yourlng*accuracy)/accuracy;
  cachelng = Math.floor(cachelng*accuracy)/accuracy;

//$('body').append("<div>" + yourlat + ' =  ' + cachelat + " | " + yourlng + " = " + cachelng + "</div>");


  if( (yourlat == cachelat) && (yourlng == cachelng) && !found ){

    jQuery('#mapcanvas').slideUp();
    jQuery('#themessage').slideDown();
    jQuery('h2').append(" <span style='color:red'>Found!</span>");
    found = true;

    $.ajax({
        type: "GET",
        url: "http://hide.mellenger.com/ogaction.php",
        data: { type: "found", url: encodeURIComponent(window.location.href) }
      }).done(function( msg ) {
        console.log( "found: " + msg );
    });


  }

}


(function ($) {


  $(document).ready(function(){

    if($(".messages.status").length > 0){

      $.ajax({
        type: "GET",
        url: "http://hide.mellenger.com/ogaction.php",
        data: { type: "hide", url: encodeURIComponent(window.location.href) }
      }).done(function( msg ) {
        console.log( "hide: " + msg );
      });

    }else{



      $("#themessage").hide();

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
        navigator.geolocation.watchPosition(locUpdate, error);

      } else {
        error('not supported');
      }








    }














  });



})(jQuery);


</script>

<div id="mapcanvas" style=""></div>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div id="themessage" class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

</div>