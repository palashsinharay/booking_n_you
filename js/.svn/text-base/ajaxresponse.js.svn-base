// JavaScript Document
function onReadyState()
{
	var data=null;	
	if (req.readyState==READY_STATE_COMPLETE)
	{
		var xmlDoc = req.responseText; //receives the response text from back page
		var pos=xmlDoc.indexOf('^');
		var len=xmlDoc.length;
		var content=xmlDoc.substring(0,pos);
		var num=xmlDoc.substring(pos+1,len);
		
		if(num==1)
		{			
			document.getElementById('msg_chngpswd').innerHTML = content;
		}
	}
}
