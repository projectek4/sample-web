<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	function check_exist($table, $id)
	{
		$this->db->from($table);
		$this->db->where($id); 

		if ($this->db->count_all_results() > 0)
			return TRUE;
		else
			return FALSE;
	}
	public function create_id($table)
	{
		$this->db->select('MAX(id) as kode_max');
		$this->db->from($table);
		$result = $this->db->get()->result();
		
		foreach($result as $k){
			if ($k->kode_max == 0)
				return 1;
			else
				return $k->kode_max + 1;
		}
	}
	public function count_rows($table, $like='', $array='')
	{
		$this->db->from($table);
		//$this->db->where('active', 1);
		if (!empty($like) AND $like=='where')
			$this->db->where($array);
		elseif(!empty($like) AND $like='like')
			$this->db->like($array);

		return $this->db->count_all_results();
	}
	public function count_like($table, $like='', $array='')
	{
		$this->db->from($table);
		$this->db->where(array('type'=>'article', 'active'=>1));

		$this->db->like(array('title'=>$like));
		$this->db->or_like(array('content'=>$like));

		return $this->db->count_all_results();
	}
	public function get_all($table, $limit=0, $offset=0, $order_by='id', $asc='ASC')
	{
		$this->db->from($table);
		$this->db->where('active', 1);
		$this->db->order_by($order_by, $asc);
		if (!empty($limit))
			$this->db->limit($limit, $offset);

		return $this->db->get();
	}
	public function get_where($table, $data, $limit=0, $page=0, $order='id', $order_by='asc')
	{
		$this->db->from($table);
		$this->db->where($data);

		if (!empty($limit))
			$this->db->limit($limit, $page);

		$this->db->order_by($order, $order_by); 

		return $this->db->get();
	}
	public function add_field($table, $data)
	{
		if ($this->db->insert($table,$data)) {
			return TRUE;
		} else {
			return $this->db->error();	    	
		}
	}
	public function update_field($table,$data,$id)
	{
		if($this->db->update($table, $data, $id))
			return TRUE;
		else 
			return $this->db->error();
	}
	public function delete_field($table, $id) 
	{
		if($this->db->update($table, array('active' => 0), $id))
			return TRUE;
		else
			return $this->db->error();
	}
	public function full_delete($table, $id)
	{
		//$this->db->where($id);
		$this->db->delete($table, $id);
	}

	public function article_year()
	{
		$this->db->select("DISTINCT DATE_FORMAT(date_posting, '%Y') as year");
		$this->db->from('posting');
		$this->db->where(array('active'=> 1, 'type!='=>'Event PKBM'));
		return $this->db->get()->result();
	}
	public function article_month($year)
	{
		$this->db->select("DISTINCT DATE_FORMAT(date_posting, '%Y-%m') as bulan, DATE_FORMAT(date_posting, '%m') as bln, DATE_FORMAT(date_posting, '%M') as string");
		$this->db->from('posting');
		$this->db->where(array('active'=> 1, 'type!='=>'Event PKBM', 'year(date_posting)'=>$year));
		$this->db->order_by('date_posting', 'desc'); 
		return $this->db->get()->result();
	}

	public function month()
	{
		$this->db->select("DISTINCT DATE_FORMAT(date_posting, '%Y-%m') as month, DATE_FORMAT(date_posting, '%M %Y') as string");
		$this->db->from('posting');
		$this->db->where('active', 1);
		return $this->db->get()->result();
	}
	public function article($month='', $kategori='', $status='1', $string='', $page=0, $order)
	{
		$this->db->select('posting.id, posting.title, posting.url, posting.media, posting.content, posting.view, date(posting.date_posting) as date_posting, date(posting.date_modified) as date_modified, posting_category.name as category, posting.author, posting.type');
		$this->db->from('posting');
		$this->db->join('posting_category', 'posting_category.id = posting.category');
		//$this->db->join('user', 'user.id = posting.author');

		if(!empty($month)) {
			$ex = explode('-', $month);
			$this->db->where('YEAR(posting.date_posting)=', $ex[0]);
			$this->db->where('MONTH(posting.date_posting)=', $ex[1]);
		}

		if(!empty($kategori))
			$this->db->where(array('posting.category'=>$kategori));

		if(!empty($string))
			$this->db->like('posting.title', $string);

		//$this->db->where(array('posting.type'=> 'article'));
		$this->db->where('posting.active', $status); /*stat posting */

		$this->db->limit(8, $page);

		if(empty($order))
			$this->db->order_by('id', 'DESC');
		else
			 $this->db->order_by('view', $order);
		return $this->db->get();
	}
	function page($page=0)
	{
		$this->db->select('posting.id, posting.title, posting.url, posting.content, date(posting.date_posting) as date_posting, date(posting.date_modified) as date_modified, user.name as author, posting.view');
		$this->db->from('posting');
		$this->db->join('user', 'user.id = posting.author');
		$this->db->where(array('posting.type'=>'page','posting.active'=>1));
		$this->db->limit(8, $page);
		return $this->db->get();
	}

	public function carousel()
	{
		$this->db->select('DISTINCT(article) as at, (SELECT media FROM media WHERE article=at ORDER BY id DESC limit 1) as media, (SELECT url FROM posting WHERE id=at) as url, (SELECT title FROM posting WHERE id=at) as title');
		$this->db->from('media');
		$this->db->where(array('active'=>1));
		$this->db->limit(4, 0);
		$this->db->order_by('id', 'DESC');

		return $this->db->get();
	}

	public function arsip()
	{
		$this->db->select("DISTINCT DATE_FORMAT(date_posting, '%Y-%m') as date, (SELECT count(id) FROM posting WHERE DATE_FORMAT(date_posting, '%Y-%m')=date AND active=1 AND type='article') as jumlah");
		$this->db->from('posting');
		$this->db->where(array('active'=>1));

		return $this->db->get();
	}


	public function get_tag($limit=0, $offset=0, $order_by='id', $asc='ASC')
	{
		$this->db->from('tag');
		$this->db->join('posting_category', 'posting_category.id = tag.category');
		
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by, $asc); 
		return $this->db->get();
	}

	public function get_berita($table, $data, $like, $limit=0, $page=0, $order='id', $order_by='asc')
	{
		$this->db->from($table);
		$this->db->where($data);

		$this->db->like(array('content'=>$like));
		$this->db->or_like(array('title'=>$like));
		if (!empty($limit))
			$this->db->limit($limit, $page);

		$this->db->order_by($order, $order_by); 

		return $this->db->get();
	}

	public function berita($type)
	{
		$this->db->select('posting.id, posting.title, posting_category.value as category, posting.active, user.nama as author');
		$this->db->from('posting');
		$this->db->join('posting_category', 'posting_category.id = posting.category');
		$this->db->join('user', 'user.id = posting.author');

		if (print_session('level') != 1) 
			$this->db->where('author', print_session('id'));
		
		$this->db->where('type', $type);
		//$this->db->where('posting.active', 1);
		$this->db->order_by('id', 'DESC'); 
		return $this->db->get();
	}
	public function polling()
	{
		$this->db->select("polling.*, (SELECT count(id) FROM polling_hasil WHERE pilihan ='a') as pil_a, (SELECT count(id) FROM polling_hasil WHERE pilihan ='b') as pil_b, (SELECT count(id) FROM polling_hasil WHERE pilihan ='c') as pil_c, (SELECT count(id) FROM polling_hasil WHERE pilihan ='d') as pil_d, (SELECT count(id) FROM polling_hasil WHERE poliing=polling.id) as total");
		$this->db->from('polling');
		$this->db->order_by('id', 'DESC'); 
		return $this->db->get();
	}

	
}
/* End of file App_model.php */
/* Location: ./application/models/App_model.php */
