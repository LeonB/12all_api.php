<?php

class onetwoAll_lijst extends onetwoAll_object {
	
	public function load($id = null) {
		if (!$this->id && !$id) {
			return false;
		}
		
		if (!$this->id && $id) {
			$this->id = $id;
		}
		
		$request = new onetwoAll_request();
		$request->set_api_action('list_view');
		$request->add_parameter('id', $this->id);
		$data = $request->request();
		
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
		
		return true;
	}
	
	public function berichten() {
		$api = new onetwoAll_api();
		$berichten = $api->berichten()->all();
		
		foreach ($berichten as $bericht) {
			var_dump($bericht);
			exit;
		}
	}
	
	public function add_bericht($bericht) {
		if (!get_class($bericht) == "onetwoAll_bericht") {
			throw new Exception('$bericht heeft niet de juiste class', 2);
		}
		
		#$bericht->add_lijst_id($this->id);
		$bericht->save();
		exit;
	}
}

?>