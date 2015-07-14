<?php
require_once('inputPage.class.php');
class etappePage extends inputPage
{
	protected function formContent()
	{
		echo '<input type="text" name="etappeuitslag" placeholder="Etappenummer">';
		$table = array('#','Rugnummer','Naam','');
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p><b>Etappeuitslag</b></p>";
        echo "<table>";        
		foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=1; $i <11; $i++)
        {
            echo '<tr><td>'.$i.'</td><td>
			<input type="number" id="R'.$i.'" class="rugnummer"/></td><td>
			<input type="text" id="R'.$i.'N" disabled="disabled" />
			<input type="hidden" name="R'.$i.'" value="" id="R'.$i.'V" />
			</td><td></td></tr>';
        }
        echo "</table>";
        echo "</div>";
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
						data    : 'action=ajaxcall&func=etappeuitslag&val=' + val,	dataType: 'json',
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
		$etappe_id = $_POST['etappeuitslag'];
		$renners = array();//array met uitslag op volgorde
		for($i=1;$i<11;$i++)
		{
			$renners[$i]= $_POST['R'.$i];
		}
		$this->dataprovider->addNewEtappeUitslag($etappe_id,$renners);
	}
	//ajax alert retention: alert(id+'-'+val);
}


?>