<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  require APPPATH.'/vendor/autoload.php';
  
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function postsinsert(){

	// 	for($i=1;$i<=20;$i++){
		
	// 	$this->db->set('user_name','User-'.$i);
	// 	$this->db->insert('users');

	// 	$this->db->set('created_at',date('Y-m-d H:i:s'));
	// 	$this->db->set('user_id',$i);
	// 	$this->db->set('post_title','My Post');
	// 	$this->db->set('post_desc','This is my post');
	// 	$this->db->set('count',$i);
	// 	$this->db->insert('posts');
	// 	}
	// echo "hi";
	// }

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function users(){

		$users=$this->db->query('SELECT * FROM `users`')->result();
		header('Content-Type: application/json');
    	echo json_encode( $users );
			}
	public function data(){

		$user =$this->db->query('SELECT * FROM `users` INNER JOIN `posts` ON users.id = posts.user_id ORDER BY posts.count DESC, created_at DESC')->result();
		  
		header('Content-Type: application/json');
		echo json_encode( $user );
	}
	public function updatePost(){
		$count= $this->db->query('SELECT * FROM `posts` WHERE `user_id`=?',$this->input->post('user_id'))->row()->count;
		
		$this->db->set('count',$count+1);
		$this->db->set('created_at',date('Y-m-d H:i:s'));
		$this->db->where('user_id',$this->input->post('user_id'));
		$this->db->update('posts');

		$options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'bc4db7f18d4aee9b3940',
    '64c2414c21365e15bf69',
    '1185238',
    $options
  );

  $data['user'] = $this->db->query('SELECT * FROM `users` INNER JOIN `posts` ON users.id = posts.user_id ORDER BY posts.count DESC , created_at DESC')->result();
  $pusher->trigger('my-channel', 'my-event', $data);
		echo (rand (1,9)+$count);
	}
}
