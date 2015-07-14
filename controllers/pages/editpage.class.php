<?php
require_once('basepage.class.php');

    class editPage extends basePage
    {
		protected $conn;
		protected $posted;
		protected $page;
		protected $formulier;
		protected $dataprovider;
                protected $tablename;
		protected $id;
		protected $naam;
		protected $code;
	
    public function __construct($posted,$conn,$page,$formulier,$dataprovider)
    {
        $this->dataprovider = $dataprovider;
        $this->conn = $conn;
        $this->posted = $posted;       
        $this->page = $page;
        $this->formulier = $formulier;
        $this->tablename = $tablename;
        $this->id = $id;
    }
   
    protected function showContent()
    { 
            echo "het werkt";
            if($this->posted)
            {
                    $this->handlePost();
                    $this->showForm();
            }
            else
            {

                    $this->showTable();

            }
    }
	protected function handlePost()
	{

	}
//============================================================================================       
       protected function showTable()
       {
           $this->tableStart();
           $this->tableContent();
           $this->tableEnd();
       }
  //---------------------------------------------------------------------------------------------------------------------------------
    protected function tableStart()
    {
        echo "<div class='container-fluid'><table border='1'>";
    }
 //---------------------------------------------------------------------------------------------------------------------------------
       protected function tableContent()
       {
           echo "<td>tablecontent</td>";
       }
 //---------------------------------------------------------------------------------------------------------------------------------
       protected function tableEnd()
       {
           echo "</table></div>";
           
       }
       //---------------------------------------------------------------------------------------------------------------------------------    
        protected function tableColumnName()
        {
                $this->dataprovider->getLand($this->id, $this->naam, $this->code);
				var_dump($this->dataprovider->getLand($this->id, $this->naam, $this->code));
  /*               $row = mysqli_fetch_assoc($this->result);
                echo "<tr>";
                foreach($row as $colname =>$value)
                {
                    echo "<th>".$colname."</th>";
                }
                echo "</tr>"; */
        }
      //--------------------------------------------------------------------------------------------------------------------------------- 
        protected function tableFill()
        {
            $this->selectQuery($this->tablename);
            while($row = mysqli_fetch_assoc($this->result))
            {   
                echo "<tr>";
                foreach($row as $colname => $value)
                {
                    echo "<td>".$value."</td>";
                }
                echo "<td><a href='index.php?page=edit&tablename=".$this->tablename."&id=".$row['id']."'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-pencil'></span></td>";
                echo "<td><a href='index.php?page=edit&tablename=".$this->tablename."&id=".$row['id']."&del=del'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-trash'></span></td>";
                echo "</tr>";
            }
        }
 //---------------------------------------------------------------------------------
        protected function showForm()
        {
            $this->formStart();
            $this->formContent();
            $this->formEnd();

        }
	protected function formContent()
	{
		$this->formFill();
	}
	
	protected function formFill()
    {
         if($this->id == 'add') //Add
            {   echo "<input type='hidden' name='editform' value='add' tablename='".$this->tablename." id='".$this->id."'/>";
                $this->addform();
                echo "<input type='submit' name='add' value='Voeg ".$this->tablename." toe'/>";

            }
            elseif($this->del == 'del') //Delete
            {
                echo "<br><b>Weet u zeker dat u dit record wilt verwijderen?</b></br>
                    <input type='hidden' name='editform' value='delete' tablename='".$this->tablename."' id='".$this->id."'>";
                $this->deleteForm();
                echo "<input type='submit' name='delete' value='Ja, verwijder ".$this->tablename."'/>";
                }
            else //update
            {   
                echo "<input type='hidden' name='editform' value='update' id='".$this->id."'>";
                $this->updateForm();
                echo "<input type='submit' name='update' value='Update ".$this->tablename."'/>";
            }
    }
   
}