<?php

require_once ('editpage.class.php');

class editPloeg extends editPage
{
    public $result;
    public function __construct($tablename, $id, $del, $posted)
    {
            parent::__construct($tablename, $id, $del, $posted);
    }
  //---------------------------------------------------------------------------------------------------------------------------------    
    protected function tableContent()
    {    
        echo "<p><b>Voeg nieuw"."&nbsp".$this->tablename."&nbsp"."toe ...</b><a href='index.php?page=edit&tablename=".$this->tablename."&id=add'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-plus'></span></button></a></p>";
        $this->tableColumnName();
        $this->tableFill();
        $this->handlePost();
    }
   //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function formContent()
        {
            $this->formFill();
        }
 //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function deleteForm()
    {
        $this->selectQuery($this->tablename);
        $row = mysqli_fetch_assoc($this->result);
        foreach($row as $colname =>$value)
        {
          if($colname == 'id')
           {
               echo "<label>".$colname."</label>";
               echo "<br><input type='text' name='".$colname."' placeholder='".$colname."' value='".$this->id."' readonly></br>";
           }
        }
        $this->selectSpecificPloeg($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."' readonly></br>";
        }
        echo "</br>";
    }    
//---------------------------------------------------------------------------------------------------------------------------------    
    protected function updateForm()
    {   
        $this->selectQuery($this->tablename);
        $row = mysqli_fetch_assoc($this->result);
        
        foreach($row as $colname =>$value)
        {
          if($colname == 'id')
           {
               echo "<label>".$colname."</label></br>";
               echo "<input type='text' name='".$colname."' placeholder='".$colname."' value='".$this->id."' visible='false' readonly required></br>";
           }
        }
        $this->selectSpecificPloeg($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
            if($var == 'land_id')
            {   
                echo "<label>".$var."</label></br>";
                echo " <input list='browsers' name='browser' required>
                <datalist id='browsers'>";
                //echo "<option value='".$var."' selected>".$var."</option>";
                $this->selectSpecificPloeg_id($this->tablename,$this->id);
                while($row3 = mysqli_fetch_assoc($this->result))
                {
                    //echo "<label>".$var."</label></br>";
                    echo "<option value='".$row3['id']."'>".$row3['naam']."</option>";
                }
                echo "</datalist></br>";
            }
            else
            {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."' required ></br>";
            }
        }
    }
  //------------------------------------------------------------------------------------------------------------------
    public function handlePost()
    {
        if($this->posted)
        {
            $this->code = $_POST['code'];
            $this->naam = $_POST['naam'];
            if(isset($_POST['add']))
            {
                echo $this->textLine()."is toegevoegd."; 
            }
            elseif(isset($_POST['delete']))
            {
                echo $this->textLine()."is verwijderd.";
            }
            else
            {
                echo $this->textLine()."is geupdate.";
            }
        }
    }
    
    public function textLine()
    {
        return $this->naam."met code:"."&nbsp".$this->code."&nbsp";
    }
}
