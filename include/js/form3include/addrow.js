
var count1 = 0;

function add_row16(cnt)
{
//alert("hello");

			if(cnt == 0  || cnt == -1)  //add row
			{
					count1 = count1+1;
					if(cnt == -1)
					{
						count1 = 1;
					}
					var table=document.getElementById("Table16");
					var row=table.insertRow(count1);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);
					var cell4=row.insertCell(3);
					var cell5=row.insertCell(4);
					var cell6=row.insertCell(5);
					var cell7=row.insertCell(6);
					var cell8=row.insertCell(7);

					cell1.innerHTML=count1+".";
					cell2.innerHTML="<input id =\"id2"+count1+"\" class=\"form-control\" type=\"text\" name=\"emp_name"+count1+"\" onchange = \"myfunction1("+count1+")\"> <p style=\"color:red\" id=\"idm2"+count1+"\"></p></td>";
					cell3.innerHTML="<input id =\"id3"+count1+"\" class=\"form-control\" type=\"text\" name=\"desig"+count1+"\" onchange = \"myfunction2("+count1+")\" ><p style=\"color:red\" id=\"idm3"+count1+"\"></p></td>";
					cell4.innerHTML="<input id =\"id4"+count1+"\" type=\"text\" name=\"doj"+count1+"\" value = \"yyyy-mm-dd\" size=\"14\" onchange = \"myfunction3("+count1+")\"><p style=\"color:red\" id=\"idm4"+count1+"\"></p></td>";
					cell5.innerHTML="<input id =\"id5"+count1+"\" type=\"text\" name=\"dol"+count1+"\" value = \"yyyy-mm-dd\" size=\"14\" onchange = \"myfunction4("+count1+")\"><p style=\"color:red\" id=\"idm5"+count1+"\"></p></td>";
					cell6.innerHTML="<input id =\"id6"+count1+"\" class=\"form-control\" type=\"text\" name=\"duration"+count1+"\" size=\"5\" onchange = \"myfunction5("+count1+")\"><p style=\"color:red\" id=\"idm6"+count1+"\"></p> </td>";
					cell7.innerHTML="<input id =\"id7"+count1+"\" class=\"form-control\" type=\"number\" name=\"pay"+count1+"\" onchange = \"myfunction6("+count1+")\"><p style=\"color:red\" id=\"idm7"+count1+"\"></p></td>";
					cell8.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
			}

			else
			{
					count1 = cnt;

					var sno= <?php echo json_encode($sno); ?>;
					var name= <?php echo json_encode($name); ?>;		
					var designation= <?php echo json_encode($designation); ?>;
					var doj= <?php echo json_encode($doj); ?>;
					var dol= <?php echo json_encode($dol); ?>;
					var duration= <?php echo json_encode($duration); ?>;
					var scale = <?php echo json_encode($scale); ?>;

					for(var i=1;i<=count1;i++)
					{
							var table=document.getElementById("Table16");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);
							var cell4=row.insertCell(3);
							var cell5=row.insertCell(4);
							var cell6=row.insertCell(5);
							var cell7=row.insertCell(6);
							var cell8=row.insertCell(7);



							cell1.innerHTML=sno[i-1];

							cell2.innerHTML="<input id =\"idva2"+i+"\" class=\"form-control\" type=\"text\" name=\"emp_name"+i+"\" value =\""+name[i-1]+"\" onchange = \"myfunctionva1("+i+")\"> <p style=\"color:red\" id=\"idmva2"+i+"\"></p ></td>";
							cell3.innerHTML="<input id =\"idva3"+i+"\" class=\"form-control\" type=\"text\" name=\"desig"+i+"\" value = \""+designation[i-1]+"\" onchange = \"myfunctionva2("+i+")\" ><p style=\"color:red\" id=\"idmva3"+i+"\"></p></td>";
							cell4.innerHTML="<input id =\"idva4"+i+"\" type=\"text\" name=\"doj"+i+"\" size=\"14\" value = \""+doj[i-1]+"\" onchange = \"myfunctionva3("+i+")\"><p style=\"color:red\" id=\"idmva4"+i+"\"></p></td>";
							cell5.innerHTML="<input id =\"idva5"+i+"\" type=\"text\" name=\"dol"+i+"\" size=\"14\" value = \""+dol[i-1]+"\" onchange = \"myfunctionva4("+i+")\"><p style=\"color:red\" id=\"idmva5"+i+"\"></p></td>";
							cell6.innerHTML="<input id =\"idva6"+i+"\" class=\"form-control\" type=\"text\" name=\"duration"+i+"\" size=\"5\" value = \""+duration[i-1]+"\" onchange = \"myfunctionva5("+i+")\"><p style=\"color:red\" id=\"idmva6"+i+"\"></p></td>";
							cell7.innerHTML="<input id =\"idva7"+i+"\" class=\"form-control\" type=\"number\" name=\"pay"+i+"\" value = \""+scale[i-1]+"\" onchange = \"myfunctionva6("+i+")\"><p style=\"color:red\" id=\"idmva7"+i+"\"></p></td>";

							cell8.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
					}
			}

}

var count2 = 0;
function add_row18a(cnt)
{

			if(cnt == 0 || cnt == -1)
			{
					count2 = count2+1;
					if(cnt == -1)
					{
						count2 = 1;
					}
					var table=document.getElementById("Table18a");
					var row=table.insertRow(count2);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);
					var cell4=row.insertCell(3);
					var cell5=row.insertCell(4);
					var cell6=row.insertCell(5);

					cell1.innerHTML=count2+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title2"+count2+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon2"+count2+"\"></td>";
					cell4.innerHTML="<input id = \"id18a"+count2+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val2"+count2+"\" onchange = \"myfunction11("+count2+")\"><p style=\"color:red\" id=\"id18ma"+count2+"\"></p></td>";
					cell5.innerHTML="<input id = \"id18b"+count2+"\" class=\"form-control\" type=\"text\" name=\"status2"+count2+"\" onchange = \"myfunction12("+count2+")\"><p style=\"color:red\" id=\"id18mb"+count2+"\"></p></td>";
					cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count2\" value=\""+count2+"\"></td>";
			}

			else
			{
					count2 = cnt;

					var sno= <?php echo json_encode($sno1); ?>;
					var title= <?php echo json_encode($title); ?>;
					var agency= <?php echo json_encode($agency); ?>;
					var value= <?php echo json_encode($value); ?>;
					var status= <?php echo json_encode($status); ?>;
					for( var i=1;i<=count2;i++)
					{

							var table=document.getElementById("Table18a");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);
							var cell4=row.insertCell(3);
							var cell5=row.insertCell(4);
							var cell6=row.insertCell(5);

							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title2"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon2"+i+"\" value = \""+agency[i-1]+"\"></td>";
							cell4.innerHTML="<input id = \"id18vaa"+i+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val2"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva11("+i+")\"><p style=\"color:red\" id=\"id18mvaa"+i+"\"></p></td>";
							cell5.innerHTML="<input id = \"id18vab"+i+"\" class=\"form-control\" type=\"text\" name=\"status2"+i+"\" value = \""+status[i-1]+"\" onchange = \"myfunctionva12("+i+")\"><p style=\"color:red\" id=\"id18mvab"+i+"\"></p></td>";
							cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count2\" value=\""+i+"\"></td>";

					}
			}

}

var count3 = 0;

function add_row18b(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
					count3 = count3+1;
					if(cnt == -1)
					{
						count3 = 1;
					}
					var table=document.getElementById("Table18b");
					var row=table.insertRow(count3);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);
					var cell4=row.insertCell(3);
					var cell5=row.insertCell(4);
					var cell6=row.insertCell(5);

					cell1.innerHTML=count3+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title3"+count3+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon3"+count3+"\"></td>";
					cell4.innerHTML="<input id = \"id18c"+count3+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val3"+count3+"\" onchange = \"myfunction13("+count3+")\"><p style=\"color:red\" id=\"id18mc"+count3+"\"></p></td>";
					cell5.innerHTML="<input id = \"id18d"+count3+"\" class=\"form-control\" type=\"text\" name=\"status3"+count3+"\" onchange = \"myfunction14("+count3+")\"><p style=\"color:red\" id=\"id18md"+count3+"\"></p></td>";
					cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count3\" value=\""+count3+"\"></td>";
					}


					else
					{
					count3 = cnt;
					var sno= <?php echo json_encode($sno2); ?>;
					var title= <?php echo json_encode($title1); ?>;
					var agency= <?php echo json_encode($agency1); ?>;
					var value= <?php echo json_encode($value1); ?>;
					var status= <?php echo json_encode($status1); ?>;

					for( var i=1;i<=count3;i++)
					{
							var table=document.getElementById("Table18b");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);
							var cell4=row.insertCell(3);
							var cell5=row.insertCell(4);
							var cell6=row.insertCell(5);




							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title3"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon3"+i+"\" value = \""+agency[i-1]+"\"></td>";
							cell4.innerHTML="<input id = \"id18vac"+i+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val3"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva13("+i+")\"><p style=\"color:red\" id=\"id18mvac"+i+"\"></p></td>";
							cell5.innerHTML="<input id = \"id18vad"+i+"\" class=\"form-control\" type=\"text\" name=\"status3"+i+"\" value = \""+status[i-1]+"\" onchange = \"myfunctionva14("+i+")\"><p style=\"color:red\" id=\"id18mvad"+i+"\"></p></td>";
							cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count3\" value=\""+i+"\"></td>";

					}
			}

}


var count4 = 0;

function add_row19a(cnt)
			{

			if(cnt == -1 || cnt == 0)
			{
				    count4 = count4+1;
				    if(cnt == -1)
				    {
				        count4 = 1;
				    }
					var table=document.getElementById("Table19a");
					var row=table.insertRow(count4);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count4+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"undergrad_courses"+count4+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count4\" value=\""+count4+"\"></td>";
					}

					else
					{
					count4 = cnt;
					var sno= <?php echo json_encode($sno3); ?>;
					var title= <?php echo json_encode($undergrad_courses_details); ?>;
					for( var i=1;i<=count4;i++)
					{
							var table=document.getElementById("Table19a");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"undergrad_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count4\" value=\""+i+"\"></td>";
					}
			}

}

var count5 = 0;

function add_row19b(cnt)
{

				if(cnt == -1 || cnt == 0)
				{
				    count5 = count5+1;
				    if(cnt == -1)
				    {
				        count5 = 1;
				    }
					var table=document.getElementById("Table19b");
					var row=table.insertRow(count5);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count5+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"postgrad_courses"+count5+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count5\" value=\""+count5+"\"></td>";
					}

					else
					{
					count5 = cnt;
					var sno= <?php echo json_encode($sno4); ?>;
					var title= <?php echo json_encode($postgrad_courses_details); ?>;
					for( var i=1;i<=count5;i++)
					{
							var table=document.getElementById("Table19b");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"postgrad_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count5\" value=\""+i+"\"></td>";
					}
			}

}

var count6 = 0;

function add_row20(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
				    count6 = count6+1;
				    if(cnt == -1)
				    {
				        count6 = 1;
				    }
					var table=document.getElementById("Table20");
					var row=table.insertRow(count6);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count6+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"short_courses"+count6+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count6\" value=\""+count6+"\"></td>";
					}

					else
					{
					count6 = cnt;
					var sno= <?php echo json_encode($sno5); ?>;
					var title= <?php echo json_encode($short_courses_details); ?>;
					for( var i=1;i<=count6;i++)
					{
							var table=document.getElementById("Table20");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"short_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count6\" value=\""+i+"\"></td>";
					}
			}

}

var count7 = 0;

function add_row21(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
				    count7 = count7+1;
				    if(cnt == -1)
				    {
				        count7 = 1;
				    }
					var table=document.getElementById("Table21");
					var row=table.insertRow(count7);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count7+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"patents"+count7+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count7\" value=\""+count7+"\"></td>";
					}

					else
					{
					count7 = cnt;
					var sno= <?php echo json_encode($sno6); ?>;
					var title= <?php echo json_encode($patents_details); ?>;
					for( var i=1;i<=count7;i++)
					{
							var table=document.getElementById("Table21");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"patents"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count7\" value=\""+i+"\"></td>";
					}
			}

}

var count8 = 0;

function add_row22(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
				    count8 = count8+1;
				    if(cnt == -1)
				    {
				        count8 = 1;
				    }
					var table=document.getElementById("Table22");
					var row=table.insertRow(count8);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count8+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"administrative"+count8+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count8\" value=\""+count8+"\"></td>";
					}

					else
					{
					count8 = cnt;
					var sno= <?php echo json_encode($sno7); ?>;
					var title= <?php echo json_encode($administrative_details); ?>;
					for( var i=1;i<=count8;i++)
					{
							var table=document.getElementById("Table22");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"administrative"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count8\" value=\""+i+"\"></td>";
					}
			}

}

var count9 = 0;

function add_row23(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
				    count9 = count9+1;
				    if(cnt == -1)
				    {
				        count9 = 1;
				    }
					var table=document.getElementById("Table23");
					var row=table.insertRow(count9);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count9+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"membership"+count9+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count9\" value=\""+count9+"\"></td>";
					}

					else
					{
					count9 = cnt;
					var sno= <?php echo json_encode($sno8); ?>;
					var title= <?php echo json_encode($membership_details); ?>;
					for( var i=1;i<=count9;i++)
					{
							var table=document.getElementById("Table23");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"membership"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count9\" value=\""+i+"\"></td>";
					}
			}

}

var count10 = 0;

function add_row24(cnt)
{

			if(cnt == -1 || cnt == 0)
			{
				    count10 = count10+1;
				    if(cnt == -1)
				    {
				        count10 = 1;
				    }
					var table=document.getElementById("Table24");
					var row=table.insertRow(count10);
					var cell1=row.insertCell(0);
					var cell2=row.insertCell(1);
					var cell3=row.insertCell(2);

					cell1.innerHTML=count10+".";
					cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"honors"+count10+"\"></td>";
					cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count10\" value=\""+count10+"\"></td>";
					}

					else
					{
					count10 = cnt;
					var sno= <?php echo json_encode($sno9); ?>;
					var title= <?php echo json_encode($honors_awards); ?>;
					for( var i=1;i<=count10;i++)
					{
							var table=document.getElementById("Table24");
							var row=table.insertRow(i);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);


							cell1.innerHTML=sno[i-1];
							cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"honors"+i+"\" value = \""+title[i-1]+"\"></td>";
							cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count10\" value=\""+i+"\"></td>";
					}
			}

}
