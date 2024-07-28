<div class="box-shadow-for-ui">
    <div class="uou-block-2b">
        <div class="container">
        <?php $falcons_option_data =get_option('falcons_option_data'); ?>
        <?php
        $top_logo_image= falcons_IMAGE."falcons-logo.png";
        if(isset($falcons_option_data['falcons-header-icon']['url']) AND $falcons_option_data['falcons-header-icon']['url']!=""):
			$top_logo_image=esc_url($falcons_option_data['falcons-header-icon']['url']);
         endif; ?>
         <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"> </a>



        <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

          <nav class="nav" style="display: flex">
            <?php
    
              $defaults = array(
                'theme_location'  => 'primary_navigation_right',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'sf-menu',
                'menu_id'         => '',
                'echo'            => true,
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul class="sf-menu %2$s"> %3$s </ul>',
                'depth'           => 0,
                'fallback_cb'     => 'falcons_nav_walker::fallback',
                'walker'          => new falcons_nav_walker()
              );
    
              wp_nav_menu( $defaults );


			?>
			
			<ul class="sf-menu sf-menu sf-js-enabled sf-arrows" style="margin-left: 36px;">
			    <?php if(is_user_logged_in()) { ?>
    			    <li class="main-menu-item menu-item-even menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-49 current_page_item active">
    			        <a href="<?php echo home_url('/my-account/'); ?>" class="menu-link main-menu-link">My Account</a>
    			    </li>
			    <?php } else { ?>
    			    <li class="main-menu-item menu-item-even menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page">
    			        <a href="<?php echo home_url('/registration/'); ?>" class="menu-link main-menu-link">Registration</a>
    			    </li>
    			    
    			    <li class="main-menu-item menu-item-even menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page">
    			        <a href="<?php echo home_url('/login/'); ?>" class="menu-link main-menu-link">Login</a>
    			    </li>
			    <?php } ?>
			    
			    <li class="main-menu-item menu-item-even menu-item-depth-0 menu-item menu-item-type-post_type menu-item-object-page menu-btn">
			        <a href="<?php echo home_url('/our-pricing/'); ?>" class="menu-link main-menu-link">Get Listed</a>
			    </li>
                
			</ul>
			
          </nav>
          
          <?php
			  if ( !has_nav_menu( 'primary_navigation_right' ) AND !has_nav_menu( 'primary_navigation_left' )  ) {

					 $defaults = array(
					'theme_location'  => '',
					//'menu'            => 'primary-menu',
					'container'       => 'ul',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'sf-menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
				);



				?>
				<nav class="nav">

				    <?php wp_nav_menu( $defaults ); ?>
					
				</nav>
				<?php
				}
          ?>

        </div>
      </div> <!-- end .uou-block-2b -->
    </div>
