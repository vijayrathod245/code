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


/* Insert data in wordpress */

add_shortcode('insert', 'add_insert_data');
function add_insert_data(){?>

<?php if($_POST['submit']){
	global $wpdb;
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	
	$wpdb->insert('std', array(
    'firstname' => $firstname,
    'lastname' => $lastname
));
	
	
	if($wpdb){
		echo "Insert success";
	}
	else{
		echo "Insert failed";
	}
 }?>
	<form method="post">
		<div>
			<div>FirstName</div>
			<div><input type="text" name="firstname"/></div>
			<div>FirstName</div>
			<div><input type="text" name="lastname"/></div>
			<div></div>
			<div><input type="submit" name="submit" value="Submit"/></div>
		</div>
	</form>
<?php }

/* Select record wordpress */
add_shortcode('select', 'select_data');

function select_data(){?>
	<table border="1">
<tr>
 <th>Id</th>
 <th>FirstName</th>
 <th>LastName</th>
 <th>Action</th>
</tr>
  <?php
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM std" );
    foreach ( $result as $print )   {
    ?>
    <tr>
    <td><?php echo $print->id;?></td>
	<td><?php echo $print->firstname;?></td>
	<td><?php echo $print->lastname;?></td>
	<td><a href="#">Delete</a></td>
    </tr>
        <?php }
  ?>          
<?php }

/* Perant and child category display */

add_shortcode('show_sub_category_list', 'load_sub_category_function');

function load_sub_category_function() {
	ob_start();
	$category = get_queried_object();
	?>
	<div class="row">
	<?php
		if ($category->parent == 0) {
			$categories = get_categories( array( 'parent' => $category->cat_ID,'hide_empty' => false ) ); 
		    foreach ( $categories as $category ) {
	?>
		        <div class="col-md-4">
		        	<a href="<?php echo get_category_link($category->term_id) ?>">
			        	<div class="category-box">
				        	<div class="title">
				        		<?php echo $category->cat_name; ?>
				        	</div>
				        	<div class="icon">
				        		<img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" />
				        	</div>
			        	</div>
		        	</a>
		        </div>
    <?php
		    }
		} else { 
			$categories = get_categories( array( 'parent' => $category->parent,'hide_empty' => false ) );
			?>
			<div class="col-md-12 mb-4">
				<div class="category-dropdown">
					<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
						<?php 
							foreach ($categories as $subcategory):
								echo '<option '. (($category->cat_ID == $subcategory->term_id) ? 'selected' : '') .' value="'. get_category_link($subcategory->term_id) .'">'. $subcategory->cat_name .'</option>';
							endforeach;
						?>
					</select>
				</div>
			</div>
			<?php

			$posts = get_posts( array('category' => $category->cat_ID) );
			echo '<div class="post-lists"><ul>';
			foreach ( $posts as $post ) :
			?>
				<li>
					<a href="<?php the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>	
				</li>
			<?php
			endforeach; 
			echo '</ul></div>';
		}
    ?>
	</div>
    <?php
    return ob_get_clean();
}

add_shortcode('header_category_dropdown', 'load_header_category_function');

function load_header_category_function() {
	$active_category = get_queried_object();
	$categories = get_categories( array( 'parent' => 0,'hide_empty' => false, 'orderby' => 'id', 'exclude' => array(1) ) );  
    ?>
		<div class="header-category-dropdown">
			<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
				<?php
					foreach ($categories as $category):
						echo '<option '. (($active_category->term_id == $category->cat_ID || $active_category->parent == $category->cat_ID) ? 'selected' : '') .' value="'. get_category_link($category->term_id) .'">'. $category->cat_name .'</option>';
					endforeach;
				?>
			</select>
		</div>
	<?php
}

add_action('wp_enqueue_scripts', 'hook_bootstrap');

function hook_bootstrap() {
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/bootstrap.css' );
}

?>

