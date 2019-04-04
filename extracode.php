<?php
/* Select particular name */

$q = $this->db->query('SELECT age FROM my_users_table WHERE id = ?',array(3));
$data = array_shift($q->result_array());
echo($data['age']);

Or

$this->db->select('age');
$this->db->where('id', '3');
$q = $this->db->get('my_users_table');
// if id is unique, we want to return just one row
$data = array_shift($q->result_array());

echo($data['age']);

Or

// here we select just the age column
$this->db->select('age');
$this->db->where('id', '3');
$q = $this->db->get('my_users_table');
$data = $q->result_array();

echo($data[0]['age']);

Or

$this->db->where('id', '3');
// here we select every column of the table
$q = $this->db->get('my_users_table');
$data = $q->result_array();

echo($data[0]['age']);


/* Last to second record show */

SELECT countryname FROM `country` GROUP BY countryname DESC LIMIT 1 OFFSET 1



/* User name and image show */
<img class="w-2r bdrs-50p" src="<?php echo base_url()?>image/<?php
					$id=$this->session->userdata('admin');
					$logtype=$this->session->userdata('logtype'); 	
					if($logtype=='admin'){
						$this->db->select('image');
						$this->db->where('id',$id);
						$qry_sel=$this->db->get('admin');
						$arr=$qry_sel->row_array();
						echo($arr['image']);
					}else{
						$this->db->select('image');
						$this->db->where('id',$id);
						$qry_sel=$this->db->get('user');
						$arr=$qry_sel->row_array();
						echo($arr['image']);
					}?>" alt="">
					
                  </div>
                  <div class="peer">
                    <span class="fsz-sm c-grey-900">
						<?php 
					$id=$this->session->userdata('admin');
					$logtype=$this->session->userdata('logtype');	
					if($logtype=='admin'){
						$this->db->select('name');
						$this->db->where('id',$id);
						$qry_sel=$this->db->get('admin');
						$arr=$qry_sel->row_array();
						echo($arr['name']);
					}else{
						$this->db->select('fullname');
						$this->db->where('id',$id);
						$qry_sel=$this->db->get('user');
						$arr=$qry_sel->row_array();
						echo($arr['fullname']);
					}?>
                    </span>




/* Wordpress code */

<?php
/* Template Name: News Template
 */
 
//remove genesis default loop and add custom loop
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'category_loop_function');
function category_loop_function(){

	global $post, $paged;
	?>
	<article class="post type-post status-publish format-standard has-post-thumbnail category-pers entry">
		
		<?php
		
			$argmnt = array(
				'posts_per_page'   => 20,
				'orderby'          => 'date',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'order'			   => 'DESC',
				'paged'            => $paged,
				'prev_next'          => True
			);
			
			/* echo '<pre>'; print_r($argmnt);echo '</pre>'; */
			query_posts( $argmnt ); ?>
		
			<div class="all-category">
				<div class="category-txt">
				
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
							
								<div class="one-first">
									<?php the_post_thumbnail('category-images'); ?>
									<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
									<p><?php echo get_the_content(); ?></p>
								</div>
							
					<?php endwhile; ?>
				</div>
				
			</div>
			<div class="cate-pagination"><?php echo paginate_links($argmnt); ?> </div>
			
	</article>
		  
		<?php wp_reset_postdata();
	wp_reset_query();
		?>
	<?php
}

genesis();


