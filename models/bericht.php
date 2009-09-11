<?php

class onetwoAll_bericht extends onetwoAll_object {
	public function all() {
		$berichten = array();
		$request = new onetwoAll_request();
		$request->set_api_action('message_list');
		$rows = $request->request();
		
		foreach ($rows as $row) {
			$bericht = new onetwoAll_bericht();
			$bericht->bind($row);
			$berichten[] = $bericht;
		}
		
		return $berichten;
	}
	
	public function __construct() {
		$this->p = array();
	}
	
	public function load($id = null) {
		if (!$this->id && !$id) {
			return false;
		}
		
		if (!$this->id() && $id) {
			$this->id = $id;
		}
		
		$request = new onetwoAll_request();
		$request->set_api_action('message_view');
		$request->add_parameter('id', $this->id);
		$data = $request->request();
		
		return $this->bind($data);
	}
	
	public function save() {
		$parameters = array(
			'id' => $this->id(),
			'format' => $this->format(),
			'subject' => $this->subject(),
			'fromemail' => $this->fromemail(),
			'fromname' => $this->fromname(),
			'reply' => $this->reply(),
			'priority' => $this->priority(),
			'charset' => $this->charset(),
			'encoding' => $this->encoding(),
			'htmlconstructor' => $this->htmlconstructor(),
			'html' => $this->html(),
			'htmlfetch' => $this->htmlfetch(),
			'htmlfetchwhen' => $this->htmlfetchwhen(),
			'message_upload_html' => array(),
			'textconstructor' => $this->textconstructor(),
			'text' => $this->text(),
			'textfetch' => $this->textfetch(),
			'textfetchwhen' => $this->textfetchwhen(),
			'message_upload_text' => array(),
			'attachments' => $this->attachments(),
			'attach' => array(),
			'p' => $this->p()
		);
		var_dump($parameters);
		exit;
	}
	
	public function add_lijst($lijst) {
		if (!get_class($bericht) == "onetwoAll_lijst") {
			throw new Exception('$bericht heeft niet de juiste class', 2);
		}
	}
	
	public function add_lijst_id($lijst_id) {
		$p = $this->p();
		array_push($p, $lijst_id);
		$this->p = $p;
	}
	
	public function lijst_ids() {
		var_dump($this->p());
		exit;
	}
}

?>