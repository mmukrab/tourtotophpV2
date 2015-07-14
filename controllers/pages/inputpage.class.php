<?php

require_once('basepage.class.php');

class inputPage extends basePage
{
	Protected $conn;
	protected $posted;
	protected $page;
	protected $formulier;
	protected $dataprovider;
	
    public function __construct($posted,$conn,$page,$formulier,$dataprovider)
    {
		$this->dataprovider = $dataprovider;
		$this->conn = $conn;
		$this->posted = $posted;       
		$this->page = $page;
		$this->formulier = $formulier;
	}
   
    protected function showContent()
    { 
		if($this->posted)
		{
			$this->handlePost();
		}
		else
		{
			$this->showForm();
		}
    }
	protected function handlePost()
	{

	}
	protected function showForm()
	{
		 echo '<form action="index.php" method="POST">
		<input type="hidden" name="page" value="'.$this->page.'">
		<input type="hidden" name="formulier" value="'.$this->formulier.'">';	
		$this->formContent();
		echo '<input type="submit" name="confirm" value="Bevestig"></form>';
	}
	protected function formContent()
	{
		
	}
}
