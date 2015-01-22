<?php include 'form1_h.php'; ?>
<!DOCTYPE html>
<html>
<head>

<script>
function displayResult()
{
var table=document.getElementById("myTable1");
var rowCount = table.rows.length;
var row=table.insertRow(rowCount);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);

var cell1 = row.insertCell(0);
var element1 = document.createElement("input");
element1.type = "text";
element1.name="sno";
element1.size="10"
cell1.appendChild(element1);


}
</script>
</head>
<body>
<br/>
<br/>
<br/>
<br/>

<form action="Form1.php" method="post">
<table id="myTable" border="1">
<center>
<tr><td>
1. Post Applied
</td><td>
<select name="post">
  <option value="Select">Select</option>}
  <option value="Professor">Professor</option>
  <option value="Assistant Professor">Assistant Professor</option>
  <option value="Assosciate Professor">Assosciate Professor</option>
</select>
</td></tr>
<tr><td>
2. Broad Area
</td><td>
<select name="area">
  <option value="Select">Select</option>}
  <option value="Computer Science">Computer Science</option>
  <option value="Electronics">Electronics</option>
  <option value="Mechanical">Mechanical</option>
  <option value="Engineering Design">Engineering Design</option>
</select>
</td></tr>
<tr><td>
3. Current Areas Of Research
</td><td>
<input type="text" name="research">
</td></tr>
</tr><td>
4. Advertisement No</td><td>IIITDM/R/2/2013(Special Recruitment Drive)
</td></tr>
<tr><td>
5. Name in Full (Capital Letters)</br>(as in SSLC Certificate)
</td><td>
<input type="text" name="name">
</td></tr>
<tr><td>
6. Date Of Birth</br>(Enclose a copy of SSLC Certificate)
</td><td>
DD-MM-YYYY
<input type="date" name=""dob></br>
Age:<input type="text" size="1" name="yrs">Y<input type="text" size="1" name="months">M
</td></tr>
<tr><td>
7. Nationality
</td><td>
<input type="text" name="nationality">
</td></tr>
<tr><td>
8. Gender
</td><td>
<table>
<tr><td>Male</td><td><input type="radio" name="gender" value="Male" /></td></tr>
<tr><td>Female</td><td><input type="radio" name="gender" value="Female"  /></td></tr>
</table>
</td></tr>
<tr><td>
9. Category </br>(Attach Certificate(s))
</td><td>
SC<input type="radio" name="caste" value="SC" /><br />
ST<input type="radio" name="caste" value="ST"  /><br />
<input type="file" name="file" id="file"><br>
</td></tr>
<tr><td>
10. Address for Communication
</td><td>
<textarea rows="5" cols="100" name="addr"></textarea></br>
<table border="1">
<tr><td>State</td><td><input type="text" name="state"></td></tr>
<tr><td>Pin</td><td><input type="text" name="pin"></td></tr>
<tr><td>Phone</td><td><input type="text" name="phone"></td></tr>
<tr><td>Mobile</td><td><input type="text" name="mob"></td></tr>
<tr><td>Email</td><td><input type="text" name="email"></td></tr>
</table>
</td></tr>
<tr><td>
11. Permanent Home Address
</td><td>
<textarea rows="5" cols="100" name="addr"></textarea></br>
<table border="1">
<tr><td>State</td><td><input type="text" name="state"></td></tr>
<tr><td>Pin</td><td><input type="text" name="pin"></td></tr>
<tr><td>Phone</td><td><input type="text" name="phone"></td></tr>
<tr><td>Mobile</td><td><input type="text" name="mob"></td></tr>
<tr><td>Email</td><td><input type="text" name="email"></td></tr>
</table>
</td></tr>
<tr><td>
12. Name of Father/Husband
</td><td>
<input type="text" size="50" name="research">
</td></tr>
<tr><td>
13. Present Position/Designation & Pay Drawn  
</td><td>
<input type="text" size="50" name="posn">
</td></tr>
<tr><td>
14. Educational Qualifications (Starting from Bachelor's Degree)
</td><td>

<table id="myTable1" border="1">
<tr><th size="10">Sl.No</th><th>Degree</th><th>Institution/University</th><th>Year Of Entry</th><th>Year Of Leaving</th><th>Percentage & Class</th></tr>
<tr><td><input type="text" size="10" name="sno"></td><td><input type="text" size="10" name="degree"></td><td><input type="text" size="10" name="insti"></td><td><input type="text" size="10" name="yoe"></td><td><input type="text" size="10" name="yol"></td><td><input type="text" size="10" name="percent"></td></tr>
</table>
<br>
<button type="button" onclick="displayResult()">Insert new row</button>
</td></tr>
<center>
</table>
</br>
<input type="submit" value="submit">
</form> 
</body>
</html> 
