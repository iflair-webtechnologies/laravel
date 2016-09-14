<?php

/* Template Name: Experience */

get_header();
otw_pfl_scripts_styles(); /* include the necessary srctips and styles */
otw_pfl_filter_scripts_styles();
?>

<?php $style_width = '';
  if( get_option( 'otw_pfl_content_width' ) ) {
      $style_width = 'style="width:'.get_option('otw_pfl_content_width').'px;"';
  }
?>
<style>
.otw-portfolio-item-link img{
    max-height:255px;
    height:255px;
    }
</style>
				<div class="row-fluid">					
						<div id="title-header" class="span12">
				            <div class="page-header">
				          <?php get_template_part("static/static-customtitle"); ?>
				            </div> 
	                	</div>					
				</div>

	 <div class="otw-row otw-sc-portfolio" <?php echo $style_width; ?>>
	 		<div class="heading-entrance clearfix"><h3>California South Projects</h3>
	 		</div>
              <div class="otw-twentyfour otw-columns">
                  <ul class="otw-portfolio block-grid three-up mobile">
                  <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
                  <?php query_posts('post_type=otw-portfolio&posts_per_page=-1&paged='.$paged); ?>
                  <?php if (have_posts()): while (have_posts()) : the_post(); 
                  $id = 0;
                  ?>
                  
                  <?php foreach(get_the_terms($post->ID, 'otw-portfolio-category') as $term)
                    if($id!=0)break;
                  if($term->slug!='experience'){
                      $id = $post->ID;
                  ?>
                      <li data-type="<?php foreach(get_the_terms($post->ID, 'otw-portfolio-category') as $term) echo $term->slug.' ' ?>" data-id="id-<?php echo($post->post_name) ?>">
                          <article id="post-<?php the_ID(); ?>" <?php post_class('otw-portfolio-item'); ?>>
                            	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="otw-portfolio-item-link">
                            		<div class="image">
                                		<?php if ( has_post_thumbnail()) { ?>
                                		    <?php the_post_thumbnail('otw-portfolio-medium'); ?>
                                		<?php } else { ?>
                                            <div style="background:url(<?php echo plugins_url( '/otw-portfolio-light/images/pattern-1.png' ) ?>);width:<?php echo get_option('otw_pfl_thumb_size_w', '303'); ?>px;height:<?php echo get_option('otw_pfl_thumb_size_h', '210'); ?>px" title="<?php _e( 'No Image', 'otw_pfl' ); ?>"></div>
                                        <?php } ?>
                            		</div>
                            		<div class="title">
                            			<h3><?php the_title(); ?></h3>
                            		</div>
                            		<div class="text entry-content">
                            			<?php the_excerpt(); ?>
                            		</div>
                            	<span class="shadow-overlay hide-for-small"></span></a>
                          </article>
                      </li>
                    <?php } ?>
                  <?php endwhile; ?>
                  </ul>
            </div>
          </div>

<?php else: ?>

    <article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'otw_pfl' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'otw_pfl' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; ?>

    <?php otw_pagination_pfl(); ?>

        <div class="otw-row otw-sc-portfolio" <?php echo $style_width; ?>>
        <div class="heading-entrance clearfix"><h3>Past Experience</h3></div>
              <div class="otw-twentyfour otw-columns">

                 
				  
                 <ul class="otw-portfolio block-grid three-up mobile">
                  <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  

                  //echo "<pre>";print_r($paged);exit;

                  ?>


                  <?php query_posts('post_type=otw-portfolio&posts_per_page=-1&paged='.$paged); ?>
                  <?php if (have_posts()): while (have_posts()) : the_post(); 
                  $id = 0;
                  ?>
                  
                  <?php foreach(get_the_terms($post->ID, 'otw-portfolio-category') as $term)
                   
                  if($term->slug=='experience'){
                     
                  ?>
                      <li data-type="<?php foreach(get_the_terms($post->ID, 'otw-portfolio-category') as $term) echo $term->slug.' ' ?>" data-id="id-<?php echo($post->post_name) ?>">
                          <article id="post-<?php the_ID(); ?>" <?php post_class('otw-portfolio-item'); ?>>
                            	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="otw-portfolio-item-link">
                            		<div class="image">
                                		<?php if ( has_post_thumbnail()) { ?>
                                		    <?php the_post_thumbnail('otw-portfolio-medium'); ?>
                                		<?php } else { ?>
                                            <div style="background:url(<?php echo plugins_url( '/otw-portfolio-light/images/pattern-1.png' ) ?>);width:<?php echo get_option('otw_pfl_thumb_size_w', '303'); ?>px;height:<?php echo get_option('otw_pfl_thumb_size_h', '210'); ?>px" title="<?php _e( 'No Image', 'otw_pfl' ); ?>"></div>
                                        <?php } ?>
                            		</div>
                            		<div class="title">
                            			<h3><?php the_title(); ?></h3>
                            		</div>
                            		<div class="text entry-content">
                            			<?php the_excerpt(); ?>
                            		</div>
                            	<span class="shadow-overlay hide-for-small"></span></a>
                          </article>
                      </li>
                    <?php } ?>
                  <?php endwhile; ?>
                  </ul>
            </div>
          </div>

<?php else: ?>

    <article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'otw_pfl' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'otw_pfl' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; ?>

    <?php otw_pagination_pfl(); ?>

    

<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>