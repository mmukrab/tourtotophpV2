<?php
require_once ('editpage.class.php');
class editLand extends editPage
{
	
    protected function showContent()
    { 
        echo "land werkt";
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
  //---------------------------------------------------------------------------------------------------------------------------------    
    protected function tableContent()
    {   
        echo "tablecontent editland";
        echo "<p><b>Voeg nieuw"."&nbsp".$this->formulier."&nbsp"."toe ...</b><a href='index.php?page=edit&tablename=".$this->formulier."&id=add'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-plus'></span></button></a></p>";
        $this->tableColumnName();
        $this->tableFill();
        $this->handlePost();
    }
    //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function formContent()
        {
            echo "formfill below";
            $this->formFill();
        }
  //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function updateForm()
    {   
        $this->dataProvider->getLand();
        foreach($row as $colname =>$value)
        {
          if($colname == 'id')
           {
               echo "<label>".$colname."</label></br>";
               echo "<input type='text' name='".$colname."' placeholder='".$colname."' value='".$this->id."' readonly></br>";
           }
        }
        $this->selectSpecificLand($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
            if($var == 'land_id')
            {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."' disabled></br>"; 
            }
            else
            {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."'></br>";
            }
        }
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
        $this->selectSpecificLand($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."' readonly></br>";
        }
        echo "</br>";
    }
//-----------------------------------------------------------------------------------------------------------------------------    
    public function handlePost()
    {
        if($this->posted)
        {
            $this->code = $_POST['code'];
            $this->naam = $_POST['naam'];
            // use $this-> to send id along
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
