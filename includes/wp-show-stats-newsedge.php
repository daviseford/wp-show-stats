<?php

function wp_show_stats_categories() {  
?>

<div class="wrap">
  <h2>WP Show Stats - NewsEdge Statistics</h2>
  <div class="stat-charts-main">   
    
    <div class="today">
    <!--<p>Recent Posts: </p> -->
        <?php
			$today = getdate();
			$idObj = get_category_by_slug('newsedge'); 
  			$id = $idObj->term_id;			
			$dailyCount = 0;
$query = new WP_Query( 'year=' . $today['year'] . '&monthnum=' . $today['mon'] . '&day=' . $today['mday'] . '&cat=' . $id );
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  				$dailyCount++;
  			?>
        	<!--
            <p>
          		<?php //the_title(); ?>
        	</p>
            -->
        <?php
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
		<h3><strong>NewsEdge Posts Today: <?php echo $dailyCount ?></strong></h3>
      </div>
      
      <div class="yesterday">
        <?php
			$yesterday = getdate( strtotime('-1 day', strtotime("12:00:00") ) );
			$yesterdayCount = 0;
$query = new WP_Query( 'year=' . $yesterday['year'] . '&monthnum=' . $yesterday['mon'] . '&day=' . $yesterday['mday'] . '&cat=' . $id );
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  				$yesterdayCount++;
  			?>
        <?php
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
		<h3><strong>NewsEdge Posts Yesterday: <?php echo $yesterdayCount ?></strong></h3>
      </div>
    
        
    <div class="thisWeek">
        <?php
			$args=array(
  				'post_type' => 'post',
  				'year' => date( 'Y' ),
				'week' => date( 'W' ),
			);
			$my_query = null;
			$weeklyCount = 0;
			$my_query = new WP_Query($args . 'post_status=publish,future&order=ASC&posts_per_page=-1&orderby=date&cat=' . $id);
			if( $my_query->have_posts() ) {
  				echo '';
  				while ($my_query->have_posts()) : $my_query->the_post(); 
  				$weeklyCount++;
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
		<h3><strong>NewsEdge Posts This Week: <?php echo $weeklyCount ?></strong></h3>
      </div>
      
      <div class="thisMonth">
        <?php
			$args=array(
  				'post_type' => 'post',
  				'date_query' => array(
					array(
						'year' => date( 'Y' ),
						'month' => date( 'M' ),
						),
					),
			);
			$my_query = null;
			$monthlyCount = 0;
			$my_query = new WP_Query($args . 'post_status=publish,future&order=ASC&posts_per_page=-1&orderby=date&cat=' . $id);
			if( $my_query->have_posts() ) {
  				echo '';
  				while ($my_query->have_posts()) : $my_query->the_post(); 
  				$monthlyCount++;
  endwhile;
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
		<h3><strong>NewsEdge Posts This Month: <?php echo $monthlyCount ?></strong></h3>
      </div>      
      
  </div>
</div>
<?php } ?>
