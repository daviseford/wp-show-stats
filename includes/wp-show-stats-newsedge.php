<?php

function wp_show_stats_newsedge() {  
	
	$idObj = get_category_by_slug('newsedge');  //establish our custom newsedge search
  	$id = $idObj->term_id;	//grab the cat_id from the slug. i prefer being able to read and understand this variable
    
?>


<div class="wrap">
  <h2>WP Show Stats - Newsedge Statistics</h2>
  <div class="stat-charts-main">      
    
    <div class="today">
        <?php
			$args = null;
			$query = null;
			$dailyCount = 0;
			
			$today = getdate();					
			
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'year' => $today['year'],
				'monthnum' => $today['mon'],
				'day' => $today['mday'],
				'cat' => $id,	
				'posts_per_page' => -1,		
			); //end of args array	
			
			$query = new WP_Query( $args );
			
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  					$dailyCount++;
  				endwhile;
			}
			wp_reset_query();  // Restore global post data stomped by the_post().
		?>
		<h3><strong>NewsEdge Posts Today: <?php echo $dailyCount ?></strong></h3>
      </div>
      
      <div class="yesterday">
        <?php
			$args = null;
			$query = null;
			$yesterdayCount = 0;
			
			$yesterday = getdate( strtotime('-1 day', strtotime("12:00:00") ) ); //subtract one day from our current value.
			
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'year' => $yesterday['year'],
				'monthnum' => $yesterday['mon'],
				'day' => $yesterday['mday'],
				'cat' => $id,			
			); //end of args array				
			
			$query = new WP_Query( $args );
			
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  					$yesterdayCount++;
  				endwhile;
			}
			wp_reset_query();  // Restore global post data stomped by the_post().
		?>
		<h3><strong>NewsEdge Posts Yesterday: <?php echo $yesterdayCount ?></strong></h3>
      </div>
    
        
    <div class="thisWeek">
        <?php		
			$args = null;
			$query = null;	
			$weeklyCount = 0;
			
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'date_query' => array(
					array(
						'after'     => '1 week ago',
					),
				),
				'cat' => $id,	
				'posts_per_page' => -1,		
			); //end of args array			
			
			$query = new WP_Query( $args );
			
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  				$weeklyCount++;
 				 endwhile;
			}
			wp_reset_query();  // Restore global post data stomped by the_post().
		?>
		<h3><strong>NewsEdge Posts This Week: <?php echo $weeklyCount ?></strong></h3>
      </div>         
      
      
      <div class="thisMonth">
        <?php
			$args = null;
			$query = null;	
			$monthlyCount = 0;
			
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'date_query' => array(
					array(
						'after'     => '1 month ago',
					),
				),
				'cat' => $id,	
				'posts_per_page' => -1,		
			); //end of args array
			
			$query = new WP_Query( $args );
			
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  					$monthlyCount++;
  				endwhile;
			}
			wp_reset_query();  // Restore global post data stomped by the_post().
		?>
		<h3><strong>NewsEdge Posts This Month: <?php echo $monthlyCount ?></strong></h3>
      </div>      
      
      
      <div class="total">
        <?php			
			$query = null;
			$args = null;
			$totalCount = 0;
			
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',				
				'cat' => $id,	
				'posts_per_page' => -1,		
			); //end of args array
			
			$query = new WP_Query( $args );
			
			if( $query->have_posts() ) {
  				echo '';
  				while ($query->have_posts()) : $query->the_post(); 
  					$totalCount++;
  				endwhile;
			}
			wp_reset_query();  // Restore global post data stomped by the_post().
		?>
		<h3><strong>NewsEdge Posts - Total: <?php echo $totalCount ?></strong></h3>
        <!-- TODO: Add a selectmenu here so I can choose different categories. -->
      </div>  
  </div>
</div>
<?php } ?>
