<?php $falcons_option_data =get_option('falcons_option_data');
//echo print_r($falcons_option_data);
//echo $falcons_option_data['falcons-multi-header-image']; ?>

 <?php if(isset($falcons_option_data['falcons-header-switch']) && ($falcons_option_data['falcons-header-switch']==1)){?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==1)){?>
              <?php get_template_part('templates/headerS/header','one'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==2)){?>
               <?php get_template_part('templates/headerS/header','two'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==3)){?>
               <?php get_template_part('templates/headerS/header','three'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==4)){?>
               <?php get_template_part('templates/headerS/header','four'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==5)){?>
               <?php get_template_part('templates/headerS/header','five'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==6)){?>
               <?php get_template_part('templates/headerS/header','six'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==7)){?>
               <?php get_template_part('templates/headerS/header','seven'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==8)){?>
               <?php get_template_part('templates/headerS/header','eight'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==9)){?>
              <?php get_template_part('templates/headerS/header','nine'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==10)){?>
               <?php get_template_part('templates/headerS/header','ten'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==11)){?>
               <?php get_template_part('templates/headerS/header','eleven'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==12)){?>
               <?php get_template_part('templates/headerS/header','tweleve'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==13)){?>
               <?php get_template_part('templates/headerS/header','thirteen'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==14)){?>
               <?php get_template_part('templates/headerS/header','fourteen'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==15)){?>
               <?php get_template_part('templates/headerS/header','fifteen'); ?>
          <?php } ?>

          <?php if(isset($falcons_option_data['falcons-multi-header-image'])&&($falcons_option_data['falcons-multi-header-image']==16)){?>
               <?php get_template_part('templates/headerS/header','sixteen'); ?>
          <?php } ?>

<?php } ?>