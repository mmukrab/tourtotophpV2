<?php
//= ============================================================================
# Author	: M@nKind - Geert Weggemans 
# Date 		: 18-06-2015
# Project	: Garble
# Goal		: Simple Encription/Decription function 
#			  with Serverside php and clientside javascript implementation
//=============================================================================
class myRugNummerController
{
//=============================================================================
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->_garblekey = "4711wwPxTT#^";
		$this->_isajax = $this->_getVar("action") == "ajaxcall";
	}
//=============================================================================
	public function handleRequest()
	{
		//fb($this);
		if ($this->_isajax)
		{
			$this->_handleAjaxRequest();
		}
		else
		{
			$this->_handlePageRequest();
		}	
	}
//=============================================================================
	protected function _getVar($name, $default="NOPPES")
	{
		return isset($_GET[$name])? $_GET[$name] : $default;
	}
//=============================================================================
	protected function _handleAjaxRequest()
	{
		$func = $this->_getVar('func');
		$handler = null;
		switch ($func)
		{
			case "rennerbyrugnummer":	
				require_once "ajaxRennerByRugNummer.class.php";
				$handler = new ajaxGetRennerByRugNummer($this->conn,$this->_getVar('val'));
				break;
			default: 
				break;
		}
		if ($handler) $handler->handleRequest();
	}
//=============================================================================
	protected function _handlePageRequest()
	{	
	$ret = <<<EOD
<html>
<head>
<title>JQuery Rugnummer Test</title>
<meta name="author" content="M@NKIND - Geert Weggemans" />
<body>
<input class="rugnummer" id="R1" type="text" value="" />
<span id="R1N"></span>
<input type="hidden" id="R1V" value="" name="renner1">

<script src="./js/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function(){
	$('input.rugnummer').keyup(function(e) {
		var val = $(this).val();
		var id = $(this).attr('id');
		if (val.length==2)
		{
			alert(id+'-'+val);
			$.ajax({ 
				type 	: 'GET', 	
				cache 	: false,
				url 	: 'classCheck.php',
				data    : 'action=ajaxcall&func=rennerbyrugnummer&val=' + val,	dataType: 'json',
				success : function (data) 
							{
								$('span#'+id+'N').html(data['naam']);
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
</script>
</body>
</html>
EOD;
echo $ret;
	}
}	
//=============================================================================
// MAIN APP :
//=============================================================================
//$mycontroller = new myRugNummerController();
//$mycontroller->handleRequest();
?>