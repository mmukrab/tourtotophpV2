<?php
require_once('inputPage.class.php');
class TotoPloegPage extends inputPage
{
	protected function formContent()
	{
		echo '<input type="text" name="totospelernaam" placeholder="spelernaam">';
		$table = array('#','Rugnummer','Naam','');
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p><b>Totoploegrenners</b></p>";
        echo "<table>";        
		foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=1; $i <21; $i++)
        {
            echo '<tr><td>'.$i.'</td><td>
			<input type="number" id="R'.$i.'" class="rugnummer"/></td><td>
			<input type="text" id="R'.$i.'N" disabled="disabled" />
			<input type="hidden" name="R'.$i.'" value="" id="R'.$i.'V" />
			</td><td></td></tr>';
        }
        echo "</table>";
        echo "</div>";
		echo "<div class='col-md-6'>";
        echo "<p><b>Totoploegreserves</b></p>";
        echo '<table>'; 
		foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=21; $i <26; $i++)
        {
            echo '<tr><td>'.$i.'</td><td>
			<input type="number" id="R'.$i.'" class="rugnummer"/></td><td>
			<input type="text" id="R'.$i.'N" disabled="disabled" />
			<input type="hidden" name="R'.$i.'" value="" id="R'.$i.'V" />
			</td><td></td></tr>';
        }
        echo '</table>';
        echo '</div>';
		echo '</div>';
		echo "
		<script>
		$(document).ready(function(){
			$('input.rugnummer').keyup(function(e) {
				var val = $(this).val();
				var id = $(this).attr('id');
				if (val.length==3)
				{
					
					$.ajax({ 
						type 	: 'GET', 	
						cache 	: false,
						url 	: 'index.php',
						data    : 'action=ajaxcall&func=rennerbyrugnummer&val=' + val,	dataType: 'json',
						success : function (data) 
									{
										$('input#'+id+'N').val(data['naam']);
										$('input#'+id+'V').val(data['id']);
									},
						error	: function(msg)
									{
										$('span#'+id+'N').html(msg);
									}
					});					
				}	
			});
		});
		</script>";
	}
	protected function handlePost()
	{
		$spelernaam = $_POST['totospelernaam'];
		$renners = array();
		for($i=1;$i<26;$i++)
		{
			$renners[$i]= $_POST['R'.$i];
		}
		try
		{
		$this->dataprovider->addNewTotoPloeg($spelernaam,$renners);
		}
		catch(Exception $e)
		{
			echo "oeps, dingen werken dus niet op deze manier...VRIEND!";
		}
	}
	//ajax alert retention: alert(id+'-'+val);
}
?>