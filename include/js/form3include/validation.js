function myfunction1(countfunc)
{
	var inpObj= document.getElementById("id2"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm2"+countfunc).innerHTML = "* a-z or A-Z or . are allowed.";
    	
    }
    else
    {
    	    document.getElementById("idm2"+countfunc).innerHTML = "";
    }
}

function myfunctionva1(countfunc)
{
	var inpObj= document.getElementById("idva2"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idmva2"+countfunc).innerHTML = "* a-z or A-Z or . are allowed.";
    	
    }
    else
    {
    	   document.getElementById("idmva2"+countfunc).innerHTML = "";
    }
}

function myfunction2(countfunc)
{
	var inpObj= document.getElementById("id3"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|\-+=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm3"+countfunc).innerHTML = "* a-z or A-Z  or . are allowed.";
    }
    else
    {
    	   document.getElementById("idm3"+countfunc).innerHTML = "";
    }

}

function myfunctionva2(countfunc)
{
	var inpObj= document.getElementById("idva3"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|\-+=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idmva3"+countfunc).innerHTML = "* a-z or A-Z  or . are allowed.";
    }

    else
    {
    	   document.getElementById("idmva3"+countfunc).innerHTML = "";
    }
}

function myfunction3(countfunc)
{
	var inpObj= document.getElementById("id4"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	document.getElementById("idm4"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idm4"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idm4"+countfunc).innerHTML = "";
    }

}
function myfunctionva3(countfunc)
{
	var inpObj= document.getElementById("idva4"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	document.getElementById("idmva4"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idmva4"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idmva4"+countfunc).innerHTML = "";
    }

}

function myfunction4(countfunc)
{
	var inpObj= document.getElementById("id5"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "";
    }

}
function myfunctionva4(countfunc)
{
	var inpObj= document.getElementById("idva5"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "";
    }

}
function myfunction5(countfunc)
{
	var inpObj= document.getElementById("id6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

	if(errorinname2==true || errorinname==null)
    {
            document.getElementById("idm6"+countfunc).innerHTML = "only numbers and \"-\" are allowed.";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			     document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idm6"+countfunc).innerHTML = "";
            }
    	}
    	else if(inpObj.value[1]=="-")
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			     document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                     document.getElementById("idm6"+countfunc).innerHTML = "";
            }
    	}

    }



}

function myfunctionva5(countfunc)
{
	var inpObj= document.getElementById("idva6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

    if(errorinname2==true || errorinname==null)
    {
        document.getElementById("idmva6"+countfunc).innerHTML = "only numbers and \"-\" are allowed.";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			    document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idmva6"+countfunc).innerHTML = "";
            }
    	}
    	else if(inpObj.value[1]=="-")
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			    document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idmva6"+countfunc).innerHTML = "";
            }
    	}
    }

}
function myfunction6(countfunc)
{
	var inpObj= document.getElementById("id7"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("idm7"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }
    else
    {
    	    document.getElementById("idm7"+countfunc).innerHTML = "";
    }
}

function myfunctionva6(countfunc)
{
	var inpObj= document.getElementById("idva7"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("idmva7"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }
    else
    {
    	    document.getElementById("idmva7"+countfunc).innerHTML = "";
    }
}


function myfunction7()
{
    var inpObj= document.getElementById("id17a");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17ma").innerHTML = "* only positive integers are valid.";
    }

    else
    {
            document.getElementById("id17ma").innerHTML = "";
    }
}

function myfunction8()
{
    var inpObj= document.getElementById("id17b");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17mb").innerHTML = "* only positive integers are valid.";
    }
    else
    {
            document.getElementById("id17mb").innerHTML = "";
    }
}

function myfunction9()
{
    var inpObj= document.getElementById("id17c");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17mc").innerHTML = "* only positive integers are valid.";
    }

    else
    {
            document.getElementById("id17mc").innerHTML = "";
    }
}
function myfunction10()
{
    var inpObj= document.getElementById("id17d");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
        document.getElementById("id17md").innerHTML = "* only positive integers are valid.";
    }
    else
    {
        document.getElementById("id17md").innerHTML = "";
    }
}


function myfunction11(countfunc)
{
    var inpObj= document.getElementById("id18a"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18ma"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18ma"+countfunc).innerHTML = "";
    }
}

function myfunctionva11(countfunc)
{
    var inpObj= document.getElementById("id18vaa"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvaa"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mvaa"+countfunc).innerHTML = "";
    }
}

function myfunction12(countfunc)
{
    var inpObj= document.getElementById("id18b"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mb"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mb"+countfunc).innerHTML = "";
    }
}
function myfunctionva12(countfunc)
{
    var inpObj= document.getElementById("id18vab"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvab"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mvab"+countfunc).innerHTML = "";
    }
}

function myfunction13(countfunc)
{
    var inpObj= document.getElementById("id18c"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mc"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mc"+countfunc).innerHTML = "";
    }
}

function myfunctionva13(countfunc)
{
    var inpObj= document.getElementById("id18vac"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvac"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mvac"+countfunc).innerHTML = "";
    }
}

function myfunction14(countfunc)
{
    var inpObj= document.getElementById("id18d"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18md"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18md"+countfunc).innerHTML = "";
    }
}

function myfunctionva14(countfunc)
{
    var inpObj= document.getElementById("id18vad"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvad"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mvad"+countfunc).innerHTML = "";
    }
}