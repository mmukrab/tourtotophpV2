<?php
class baseController
{
    protected $conn;
    protected $id;
    protected $posted;
    protected $pageVar;
    protected $page;

//=============================================================================================   
    public function __construct($conn, $id)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->posted = ($_SERVER['REQUEST_METHOD'] == 'POST');
    }
//===========================================================================================  
    public function handleRequest()
    {	
        $this->pageVar = $this->getParameter('page');
        $this->createPage();
        $this->showPage();
    }
//============================================================================================   
    protected function getParameter($parameternaam)
    {
	if($this->posted && isset($_POST[$parameternaam]) )
	{
            return $_POST[$parameternaam]; 
        }		
        else 
        {
            if(isset($_GET[$parameternaam]))
            {
                return $_GET[$parameternaam];
            }
        }
        return "Onbekend";
    }
//==================================================================================================        
    protected function createPage() 
        {		
			$this->page = null;
        }
//==================================================================================================      		
	public function showPage()
    {
		if(isset($this->page)) $this->page->show();
    }           
}