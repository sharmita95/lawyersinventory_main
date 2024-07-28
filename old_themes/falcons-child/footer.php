</div>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */
?>
<?php

$falcons_option_data =get_option('falcons_option_data');

$falcons_option_data['falcons-multi-footer-image']=1;
$falcons_option_data['falcons-multi-bottom-image']=1;
?>
<!-- Start Footer Switch -->

<?php if($falcons_option_data['falcons-footer-switch']){?>

<!-- Start falcons Multifooter -->

<!-- Start Footer 7 -->
<?php if(isset($falcons_option_data['falcons-multi-footer-image'])&&($falcons_option_data['falcons-multi-footer-image']==1)){?>
  <!-- uou block 4e -->
  <footer class="uou-block-4e">
    <div class="container">
      <div class="row">
		  

            <!-- Start left footer sidebar -->

            <?php if(isset($falcons_option_data['falcons-left-footer-switch'])) { ?>

                <?php
                if(is_active_sidebar('falcons_footer_left_sidebar')):
    
    				dynamic_sidebar('falcons_footer_left_sidebar');
    
                endif;
                ?>

            <?php } ?>
            
            <!-- Contact us section -->
		    <div class="col-md-2 col-sm-6">
		        <h5>Social Links</h5>
		        
		        <?php if(isset($falcons_option_data['falcons-social-profile'])){?>
                  <ul class="social-icons">
            
                    <?php if(isset($falcons_option_data['falcons-facebook-profile']) && !empty($falcons_option_data['falcons-facebook-profile'])) : ?>
                    <li><a href="<?php echo esc_url($falcons_option_data['falcons-facebook-profile']);?>" target="_blank" rel="nofollow noopener noreferrer">
                        <span class="icon-wrapper"><i class="fa fa-facebook"></i></span> <span> Facebook</span></a></li>
                    <?php endif; ?>
            
                    <?php if(isset($falcons_option_data['falcons-twitter-profile']) && !empty($falcons_option_data['falcons-twitter-profile'])) : ?>
                    <li><a href="<?php echo esc_url($falcons_option_data['falcons-twitter-profile']);?>" target="_blank" rel="nofollow noopener noreferrer">
                        <span class="icon-wrapper"><i class="fa fa-twitter"></i></span> <span> Twitter</span></a></li>
                    <?php endif; ?>
            
                    <?php if(isset($falcons_option_data['falcons-linkedin-profile']) && !empty($falcons_option_data['falcons-linkedin-profile'])) : ?>
                    <li><a href="<?php echo esc_url($falcons_option_data['falcons-linkedin-profile']);?>" target="_blank" rel="nofollow noopener noreferrer">
                       <span class="icon-wrapper"> <i class="fa fa-linkedin"></i></span> <span> Linkedin</span></a></li>
                    <?php endif; ?>
            
                    <?php if(isset($falcons_option_data['falcons-pinterest-profile']) && !empty($falcons_option_data['falcons-pinterest-profile'])) : ?>
                    <li><a href="<?php echo esc_url($falcons_option_data['falcons-pinterest-profile']);?>" target="_blank" rel="nofollow noopener noreferrer">
                        <span class="icon-wrapper"> <i class="fa fa-pinterest"></i></span> <span> Pinterest</span></a></li>
                    <?php endif; ?>
            
                  </ul>
                <?php }?>
				
		  </div>

      </div>
    </div>
  </footer> <!-- end .uou-block-4e -->
  <?php } ?>


<?php } ?>

<!-- Start Bottom 7 -->
<?php if(isset($falcons_option_data['falcons-multi-bottom-image'])&&($falcons_option_data['falcons-multi-bottom-image']==1)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4a secondary">
    <div class="container">

      <?php if(isset($falcons_option_data['falcons-show-footer-copyrights'])){?>
      <p>
        <?php if(isset($falcons_option_data['falcons-copyright-text'])&&!empty($falcons_option_data['falcons-copyright-text'])) {?>
        <?php
			if(isset($falcons_option_data['falcons-copyright-link']) && $falcons_option_data['falcons-copyright-link']!='' ){?>

				<a  href="http://<?php echo esc_html($falcons_option_data['falcons-copyright-link']);?> "><?php echo esc_html($falcons_option_data['falcons-copyright-text']);?></i></a>
				<?php
			}else{
				echo esc_html($falcons_option_data['falcons-copyright-text']);
			}
			?>
        <?php } ?>
        <?php bloginfo('name'); ?>.
        <?php if(isset($falcons_option_data['falcons-after-copyright-text'])&&!empty($falcons_option_data['falcons-after-copyright-text'])) {?>
        <?php echo esc_html($falcons_option_data['falcons-after-copyright-text']); ?>
        <?php } ?>
        <?php if(isset($falcons_option_data['falcons-show-footer-credits']) && $falcons_option_data['falcons-show-footer-credits']==1) {?>
        <?php echo '<a href="https://www.redhatmedia.net/" target="_blank" rel="nofollow noopener noreferrer">RedHatMedia</a>'; ?>
        <?php } ?>

      </p>
      <?php } ?>


    <!-- Start sccial Profile -->

    
    <!-- end of social profile -->

    </div>
  </div>
  <!-- end .uou-block-4a -->
    <?php } ?>



<?php wp_footer(); ?>


<script>
    jQuery(document).ready(function($) {
        
        
        $('.uou-block-4e .emaillist input[type="email"]').val("");
        
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();   
            //console.log(scroll);
            if (scroll > 300) {
                $(".toolbar").addClass("sticky-header", 8000 );
            } 
            if(scroll <= 300) {
                $(".toolbar").removeClass("sticky-header", 8000 );
            }
        });
        
        $(".single .social-icons, .falcons_widget_falcons_social").each(function(){
             $(this).find("a").attr('target','_blank');
             $(this).find("a").attr('rel','noreferrer noopener nofollow');
        });
        $(".es_subscription_form_submit").addClass('btn btn-primary');
        
        $(".tag-uou-sidebar ul").addClass('widget');
        $("footer .row > div:first-child").removeClass('col-md-3');
        $("footer .row > div:first-child").addClass('col-md-4');
        
        
        //Mobile menu
        //$('.mobileMenu').hide();
        $('.mobile-sidebar-button').on('click', function() {
            //$('.mobileMenu').toggle();
            console.log('hiiiii');
        });
        
    });

    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
		
</script>

</body>
</html>
