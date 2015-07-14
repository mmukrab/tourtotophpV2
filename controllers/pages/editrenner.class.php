<?php

require_once ('editpage.class.php');

class editRenner extends editPage
{
    public $result;

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
    protected function addForm()
    {
        $this->selectQuery($this->tablename);
        $row = mysqli_fetch_assoc($this->result);
        foreach($row as $colname =>$value)
        {
            if(($colname == 'voornaam') || ($colname == 'achternaam'))
            {
                echo "<label>".$colname."</label></br>";
                echo "<input type='text' name='".$colname."' placeholder='".$colname."' required></br>";
            }
            if($colname == 'land_id')
            {
                echo "<label>".$colname."</label></br>";
                echo " <input list='land_id' name='land_id'>
                <datalist id='land_id'>";
                $this->selectSpecificLand_id($this->tablename,$this->id);
                while($row2 = mysqli_fetch_assoc($this->result))
                {
                    echo "<option value='".$row2['id']."' label='".$row2['naam']."'>";
                }
                echo "</datalist></br>";
            }
            if($colname == 'ploeg_id')
            {
                echo "<label>".$colname."</label></br>";
                echo " <input list='ploeg_id' name='ploeg_id'>
                <datalist id='ploeg_id'>";
                $this->selectSpecificPloeg_id($this->tablename,$this->id);
                while($row3 = mysqli_fetch_assoc($this->result))
                {
                    echo "<option value='".$row3['id']."' label='".$row3['naam']."'>";
                }
                echo "</datalist></br>";
            }
            if($colname == 'active')
            {
                echo "<label>".$colname."</label></br>";
                echo "<input type='checkbox' name='".$colname."' value='".$colname."'  required></br>";
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
        $this->selectSpecificRenner($this->tablename,$this->id);
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
               echo "<input type='text' name='".$colname."' placeholder='".$colname."' value='".$this->id."' readonly></br>";
           }
        }
        $this->selectSpecificRenner($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
            if($var == 'land_id')
            {   
                echo "<label>".$var."</label></br>";
                echo " <input list='land_id' name='land_id'>
                <datalist id='land_id'>";
                $this->selectSpecificLand_id($this->tablename,$this->id);
                while($row3 = mysqli_fetch_assoc($this->result))
                {
                    echo "<option value='".$row3['id']."' label='".$row3['naam']."'>";
                }
                echo "</datalist></br>";
            }
            elseif($var == 'ploeg_id')
            {   
                echo "<label>".$var."</label></br>";
                echo " <input list='ploeg_id' name='ploeg_id'>
                <datalist id='ploeg_id'>";
                $this->selectSpecificPloeg_id();
                while($row4 = mysqli_fetch_assoc($this->result))
                {
                    echo "<option value='".$row4['id']."' label='".$row4['naam']."'>";
                }
                echo "</datalist></br>";
            }
            else
            {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."'></br>";
            }
        }     
    }
    
    public function handlePost()
    {
        if($this->posted)
        {
            $this->voornaam = $_POST['voornaam'];
            $this->achternaam = $_POST['achternaam'];
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
        return $this->voornaam."&nbsp".$this->achternaam."&nbsp";
    }
    
    
}
