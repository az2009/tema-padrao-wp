<?php
    /**
     * Bloco das chamadas das redes sociais
     * Vísivel: Single Cases
     */
?>

<!-- Facebook -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook -->

<!--Google Plus-->
	<script src="https://apis.google.com/js/platform.js" async defer> {lang: 'pt-BR'}</script>
<!--Google Plus-->

<!--Linkedin-->
	<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>
<!--Linkedin-->



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 block-social">
        <ul class="social">
    		<li><div class="fb-share-button"  data-href="<?php the_permalink() ?>"  data-layout="button"></div></li>
     		<li><div class="g-plus" data-action="share" data-annotation="none" data-href="<?php the_permalink() ?>"></div></li>
     		<li><script type="IN/Share" data-url="<?php the_permalink() ?>" data-counter="right"></script></li>
     		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>


     	</ul>
    </div>
