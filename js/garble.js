//= ============================================================================
// Author	: M@nKind - Geert Weggemans 
// Date 	: 18-06-2015
// Project	: Garble
// Goal		: Simple Encription/Decription function 
//			  with Serverside php and clientside javascript implementation
//=============================================================================
var garblekey = "4711wwpxTT";
function garble(instr)
{ 
	var str = "";
	var ky = garblekey.replace(String.fromCharCode(32),''); 
	var kl = 32;	
	if (ky.length<32)
	{ 
		kl = ky.length; 
	}
	var k = new Array();
	for(i=0;i<kl;i++)
	{ 
		k[i] = ky.charCodeAt(i) & 0x1F;
	} 
	var j=0;
	for(i=0;i<instr.length;i++)
	{ 
		var e = instr.charCodeAt(i); 
		if ( e & 0xE0)
		{	
			str += String.fromCharCode( e ^ k[j]);
		}
		else
		{		
			str += String.fromCharCode(e);
		}	
		j++;
		if (j==kl)
		{	
			j = 0;
		}	
	} 
	return str; 
} 
//=============================================================================
