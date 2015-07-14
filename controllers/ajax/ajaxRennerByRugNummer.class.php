<?php
require_once "baseAjaxHandler.class.php";
class ajaxGetRennerByRugNummer extends baseAjaxHandler
{
	protected $dataprovider;
	protected $rugnummer;
	
	public function __construct($dataprovider, $rugnummer)
	{
		$this->dataprovider = $dataprovider;
		$this->rugnummer = $rugnummer;
	}

	protected function _getContent()
	{	
		$renner = $this->dataprovider->getRennerIdByRugnummer($this->rugnummer);
		if ($this->rugnummer==$renner->getRugnummer()) // Gevonden!
		{
			$result = array();
			$result{"id"}=$renner->getID();
			$result{"naam"}=$renner->getVoornaam()." ".$renner->getAchternaam();
			$this->content = json_encode($result);
		}
		else
		{
			throw new Exception("Renner niet gevonden");
		}
		
	}
}
?>