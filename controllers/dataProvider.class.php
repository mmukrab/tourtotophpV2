<?php
require_once('entities/totospeler.class.php');
require_once('entities/totospelerploeg.class.php');
require_once('entities/etapperegel.class.php');
require_once('entities/land.class.php');
class Dataprovider
{	
        protected $id;
	protected $conn;
//=============================================================================================
//PUBLIC METHODS
//=============================================================================================
	public function __construct($conn, $id)
	{
			$this->conn = $conn;
			$this->id = $id;
	}
	public function addNewRenner($voornaam,$achternaam,$ploeg_id,$land_id,$active,$pdoconfig)//works
	{
		$renner = new renner(0,$this->conn);
		$renner->setVoornaam($voornaam);
		$renner->setAchternaam($achternaam);
		$renner->setPloeg($ploeg_id);
		$renner->setLand($land_id);
		$renner->setActive($active);
		$renner->save();
	}
	public function getRennerById($id)//works
	{
		return new renner($id,$this->conn);
	}
	public function getPloegById($id)
	{
		$ploeg = new ploeg($id,$this->conn);
		$ploeg->load();
		//print_r($ploeg);
	}
	public function getEtappeById($id)//works
	{
		$etappe = new etappe($id,$this->conn);
		$etappe->load();
		//print_r($etappe);
	}
	public function addEtappePunten()
	{
		
	}
	public function addNewTotoPloeg($spelernaam,$renners)
	{
		$result = $this->saveNewTotoSpeler($spelernaam);
			if($result === false)
			{
				throw new Exception('oeps, naam bestaat al!');
			}
		$totospelerploeg = new totospelerploeg(0,$this->conn);
		$totospelerploeg->setTotospeler($result);
		foreach($renners as $inti => $rennerid)
		{
			
			$totospelerploeg->setRenner($rennerid);
				if($inti <20)
				{
					$totospelerploeg->setReserve(0);
				}
				else
				{
					$totospelerploeg->setReserve(1);
				}
			$totospelerploeg->save();
			$totospelerploeg->setId(0);
		}
	}
	public function getRennerIdByRugnummer($rugnummer)
	{
		require_once('entities/renner.class.php');	
		$renner = new renner(0,$this->conn);
		$renner->findByRugnummer($rugnummer);
		return $renner;
	}
	public function addNewEtappe($naam,$afstand)
	{
		$etappe = new etappe(0,$this->conn);
		$etappe->setNaam($naam);
		$etappe->setAfstand($afstand);
		$etappe->save();
	}
	public function addNewPloeg($ploegnaam,$land_id,$ploegcode)
	{
		$ploeg = new ploeg(0,$this->conn);
		$ploeg->setNaam($ploegnaam);
		$ploeg->setLand($land_id);
		$ploeg->setCode($ploegcode);
		$ploeg->save();
	}
	public function addNewLand($landnaam,$landcode)
	{
		$land = new land();
		$land->setNaam($landnaam);
		$land->setCode($landcode);
		$land->save();
	}
	public function addNewEtappeUitslag($etappe_id,$renner_id)
	{
		$punten = array(0,15,12,10,8,6,5,4,3,2,1);
		$etapperegel = new etapperegel(0,$this->conn);
		foreach($renner_id as $inti => $renner)
		{
			$etapperegel->setEtappe($etappe_id);
			$etapperegel->setRenner($renner);
			$etapperegel->setPositie($inti);
			$etapperegel->setPunten($punten[$inti]);
			$etapperegel->save();
			$etapperegel->setId(0);
			
		}
	}
	public function checkUser($usernaam,$password)
	{
		require_once('entities/user.class.php');
		$user = new user(0,$this->conn);
		$user->findByNaam($usernaam);
		$userpass = $user->getPassword();
		if($password==$userpass)
		{
				return true;
		}
		else
		{
				return false;
		}
	}
	public function showTotoPloegPunten($ploeg_id)
	{
		//$etapperegel = new etapperegel(0,$this->conn);
		//$etapperegel->
	}	
	
	public function getLand()
	{
		require_once('entities/land.class.php');
		$land = new land();
		$land->selectAll();
		var_dump($land);
		//var_dump($this->conn->getObjects($qry));
	}

	
//=============================================================================================
//PROECTED METHODS
//=============================================================================================	
	protected function saveNewTotoSpeler($spelernaam)
	{
		$totospeler = new totospeler(0,$this->conn);
		$totospeler->findByNaam($spelernaam);
			if($totospeler->getNaam()==$spelernaam)
			{
				return false;
			}
		$totospeler->setNaam($spelernaam);
		$totospeler->save();
		return $totospeler->getId();
	}	
}
?>