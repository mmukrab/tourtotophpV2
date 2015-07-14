<?php

require_once('basepage.class.php');

    class outputPage extends basePage
    {
		protected $conn;
		protected $tabledata;		
		
        function __construct($conn)
        {
            $this->conn = $conn;   
        }
        
       protected function showContent()
       {  
            $this->showTable();
       }
       
       protected function showSubmenuItems()
       {
            $submenuitems= array();
            $submenuitems['algemeen'] = 'Algemeen Klassement';
            $submenuitems['dag'] = 'Dagklassement';
            $submenuitems['formulier'] = 'Totospeler Formulier';
            $submenuitems['renner'] = 'Rennerslijst';
            $submenuitems['etappeuitslag'] = 'Etappe uitslag';
            $submenuitems['totospeleruitslag'] = 'Totospeler uitslag';
            
            
            foreach ($submenuitems as $tablename => $title)
            {
                echo "<li><a href='index.php?page=output&tablename=".$tablename."'>".$title."</a></li>";
            }
       }
       
          protected function showTable()
       {
		   $this->getTable();
           $this->tableStart();
           $this->tableContent();
           $this->tableEnd();
       }
  //============================================================================================
       protected function tableStart()
       {
           echo "<div class='container-fluid'><table border='1'>";
       }
 //=============================================================================================
       protected function tableContent()
       {
           foreach($this->tabledata as $renner)
		   {
			   print_r($renner);
			   echo "<br>";
		   }
       }
 //==========================================================================================
       protected function tableEnd()
       {
           echo "</table></div>";
           
       }
	   protected function getTable()
	   {
		   $qry = "SELECT etapperegel.punten,totospelerploeg.totospeler_id,totospelerploeg.renner_id FROM etapperegel
					INNER JOIN totospelerploeg
					ON totospelerploeg.renner_id = etapperegel.renner_id
					WHERE totospelerploeg.totospeler_id = 132";
			$this->tabledata = $this->conn->getObjects($qry);		
		   
	   }
       
    }