<!-- Start Nav -->
   <nav class="main-nav">
    <!-- <ul> -->
          

    <?php 

     $defaults = array(
      'theme_location'  => 'primary_navigation_right',
      'menu'            => '',
      'container'       => '',
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => '',
      'menu_id'         => '',
      'echo'            => true,      
     );

      
     wp_nav_menu( $defaults );


    ?>
    
    <ul>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
            <a href="<?php echo home_url('/about-us/'); ?>">About Us</a>
        </li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
            <a href="<?php echo home_url('/contact-us/'); ?>">Contact Us</a>
        </li>
        <!--<li class="menu-item menu-item-type-custom menu-item-object-custom">-->
        <!--    <a href="<?php echo home_url('/blog/'); ?>">Blog</a>-->
        <!--</li>-->
	    <?php if(is_user_logged_in()) { ?>
		    <li class="menu-item menu-item-type-custom menu-item-object-custom">
		        <a href="<?php echo home_url('/my-account/'); ?>" class="menu-link main-menu-link">My Account</a>
		    </li>
	    <?php } else { ?>
		    <li class="menu-item menu-item-type-custom menu-item-object-custom">
		        <a href="<?php echo home_url('/registration/'); ?>" class="menu-link main-menu-link">Registration</a>
		    </li>
		    <li class="menu-item menu-item-type-custom menu-item-object-custom">
		        <a href="<?php echo home_url('/login/'); ?>" class="menu-link main-menu-link">Login</a>
		    </li>
	    <?php } ?>
	    
	    <li class="enu-item menu-item-type-custom menu-item-object-custom menu-btn">
	        <a href="<?php echo home_url('/our-pricing/'); ?>" class="menu-link main-menu-link">Get Listed</a>
	    </li>
	    
	</ul>
	
    <!-- </ul> -->
   </nav>
   <!-- End Nav -->