function check_file_image(id){
    var suffix=new Array();
    suffix[0]="png";
    suffix[1]="jpeg";
    suffix[2]="gif";
    suffix[3]="jpg";
    var error=1;
    var sFileName=document.getElementById(id).value;
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    // alert(sFileExtension);
    for(var i=0;i<suffix.length;i++)
    {
    	if(sFileExtension==suffix[i])
    	{
    		error=0;
    	}
    }

    if(error==1)
    {
    	alert("Image should be of the specified forms only");
    	document.getElementById(id).value='';
    }
    
}

function check_file_pdf(id){
    var suffix=new Array();
    suffix[0]="pdf";
    var error=1;
    var sFileName=document.getElementById(id).value;
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    for(var i=0;i<suffix.length;i++)
    {
    	if(sFileExtension==suffix[i])
    	{
    		error=0;
    	}
    }

    if(error==1)
    {
    	alert("A file with extension pdf is only accepted.");
    	document.getElementById(id).value='';
    }
    
}


function check_mobile_number(el,e)
{
	// alert(e.keyCode);
	if(e.keyCode!=8)
	{
		var inputtxt=$(el).val();
		if((inputtxt.length>10))
		{
			alert("Mobile number cannot be more than 10 characters.")  
		}
	}
		
}