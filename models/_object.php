<?php

class onetwoAll_object {
	private $_data = array();
	
	//Magic
    public function __set($name, $value) {
    	if (method_exists($this, "set_$database_field")) {
    		return $this->{"set_$database_field"}($value);
    	}
		
		return $this->_data[$name] = $value;
    }
    
    public function __get($name) {
    	return $this->_data[$name];
    }
    
    public function __call($functionname, $parameters) {
    	if (isset($this->_data[$functionname]) && (!$parameters || count($parameters) < 1)) {
    		return $this->_data[$functionname];
    	}
    	
    	throw new Exception('Tried to call unknown method '.get_class($this).'::'.$functionname);
    }
	
	function bind( $array, $ignore='' ) {
//		if (!is_array( $array )) {
//			$this->_error = strtolower(get_class( $this ))."::bind failed.";
//			return false;
//		} else {
//			return $this->mosBindArray( $array, $ignore );
//		}

		foreach ($array as $key => $value) {
			$this->$key = $value;
		}
	}
	
	function mosBindArray( $array, $ignore='', $prefix=NULL, $checkSlashes=true ) {
		if (!is_array( $array ) || !is_object( $this )) {
			return (false);
		}
	
		$ignore = ' ' . $ignore . ' ';
		foreach (get_object_vars($this) as $k => $v) {
			if( substr( $k, 0, 1 ) != '_' ) {			// internal attributes of an object are ignored
				if (strpos( $ignore, ' ' . $k . ' ') === false) {
					if ($prefix) {
						$ak = $prefix . $k;
					} else {
						$ak = $k;
					}
					if (isset($array[$ak])) {
						$this->$k = ($checkSlashes && get_magic_quotes_gpc()) ? mosStripslashes( $array[$ak] ) : $array[$ak];
					}
				}
			}
		}
	
		return true;
	}
	
}

?>