<?php
/**
 * social.php
 *
 * @package WordFes Nagoya 2016
 */
 
 $link = home_url() . $_SERVER["REQUEST_URI"];
?>
	<div class="sns-button fb-like" data-href="<?php echo esc_url( $link ); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false" style="overflow: visible;"></div>

	<div class="sns-button twitter">
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo esc_url( $link ); ?>" data-via="wbnagoya" data-lang="ja">ツイート</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>