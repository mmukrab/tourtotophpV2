<?php
require_once('baseController.class.php');
require_once('dataProvider.class.php');
class mainController extends baseController
{	
	protected $dataprovider;
	
	public function __construct($conn, $id)
	{
		parent::__construct($conn, $id);
		$this->dataprovider = new dataprovider($this->conn);
	}
//==============================================================================================================================	
	public function handleRequest()
	{
		$this->pageVar=$this->getParameter('page');
		$this->checkLogIn();
		if($this->getParameter('action')=='ajaxcall')
		{
			$this->handleAjaxRequest();
		}
		else
		{
			$this->createPage();
			$this->showPage();
		}
	}
//===============================================================================================================================
//PROTECTED METHODS	
//=================================================================================================================================
	protected function createPage() 
    {		
        switch($this->pageVar)
        {
            case 'home':
                    require_once('pages/homepage.class.php');
                    $this->page = new homePage();
                    break;       
            case 'input':
                    $formulier = $this->getParameter('formulier');
                    switch($formulier)
                    {
                        case 'totoploeg':
                                require_once('pages/totoploegpage.class.php');
                                $this->page = new TotoPloegPage($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                                break;
                        case 'etappe':
                                require_once('pages/etappepage.class.php');
                                $this->page = new EtappePage($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                                break;
                        default:
                        break;
                    }
                    break;
            case 'edit':
                $formulier = $this->getParameter('formulier');
                switch($formulier)
                {
                    case 'land': 
                            require_once('pages/editland.class.php');
                            $this->page = new editLand($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                            //var_dump($this->page);
                            break;
                    case 'renner':
                            require_once('pages/editRenner.class.php');
                            $this->page = new editRenner($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                            break;
                    case 'ploeg':
                            require_once('pages/editPloeg.class.php');
                            $this->page = new editPloeg($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                            break;
                    case 'etappe':
                            require_once('pages/editEtappe.class.php');
                            $this->page = new editEtappe($this->posted,$this->conn,$this->pageVar,$formulier,$this->dataprovider);
                            break;
                    default:
                            break;
                }
                break;
            case 'output':
                    require_once('pages/outputpage.class.php');
                    $this->page = new outputPage($this->conn);
                    break;
            case 'logout':
                    require_once('pages/logoutpage.class.php');
                    $this->page = new logoutPage();
                    break;
            default:
                    require_once(CLASSPATH.'pages/loginpage.class.php');
                    $this->page = new loginPage();
                    break;
        }
    }	
	
	
//=============================================================================================================================
 protected function checkLogin()
    {
        if($this->posted && $this->pageVar == 'login')
        {
            if($this->checkUser())
            {
                $this->pageVar = 'home';
            }
            else 
            {
                $this->pageVar = 'login';
            }
        }
        else
        {
            if($this->isLoggedIn()== false)
            {
                $this->pageVar = 'login';
            }
        }
    }
//==================================================================================================     
    protected function isLoggedIn()
    {
        return(isset($_SESSION['username']) && $_SESSION['username'] != "");
    }
//=============================================================================================================================
	protected function checkUser()
    {
        $username=(isset($_POST['username']) ? $_POST['username']:"Noppes");
        $password=(isset($_POST['password']) ? $_POST['password']:"Noppes");
        if($this->dataprovider->checkUser($username, $password))
        {
			$_SESSION['username'] = $username;
            return true;
        }
        else
        {
            return false;
        }       
        
    }
//=========================================================================================================================
	protected function handleAjaxRequest()
	{
		$handler = null;
		$function = $this->getParameter('func');
		switch($function)
		{
			case 'rennerbyrugnummer':
				require_once('ajax/ajaxRennerByRugNummer.class.php');
				$handler = new ajaxGetRennerByRugNummer($this->dataprovider,$this->getParameter('val'));
				break;
			case 'etappeuitslag':
				require_once('ajax/ajaxRennerByRugNummer.class.php');
				$handler = new ajaxGetRennerByRugNummer($this->dataprovider,$this->getParameter('val'));
				break;
			default:
				break;
		}
		if($handler) $handler->handleRequest();
	}	
}

