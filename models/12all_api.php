<?php

class onetwoAll_api {
	
	public function lijsten() {
		$user = new onetwoAll_lijst();
		return $user;
	}
	
	public function inschrijvers() {
		$inschrijver = new onetwoAll_inschrijver();
		return $inschrijver;
	}
	
	public function gebruikers() {
		$gebruiker = new onetwoAll_gebruiker();
		return $gebruiker;
	}
	
	public function berichten() {
		$bericht = new onetwoAll_bericht();
		return $bericht;
	}
	
	public function campagnes() {
		$campagne = new onetwoAll_campagne();
		return $campagne;
	}
	
}
?>