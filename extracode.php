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

