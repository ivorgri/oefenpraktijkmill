<?php
  class netlify_webhook {
    static function start_build()  {
      $url = 'https://api.netlify.com/build_hooks/5b97952c82d3f17e9b57def8';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      echo $response;
      curl_close($ch);
    }
  }

  add_action('publish_post', array('netlify_webhook', 'start_build'));
?>