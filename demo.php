<?php include 'header1.php'; ?>
<html>
<body>

<div id="header">
  <ul>
    <li id="current"><a href="Form1.php">Form1</a></li>
    <li><a href="form2.php">Form2</a></li>
    <li><a href="form3.php">Form3</a></li>
    <li><a href="form4.php">Form4</a></li>
	<li><a href="#">Submit</a></li>
  </ul>
</div>
<br/><br/>
<!--<iframe name="iframe_a" width="1500" height="1200"></iframe>
<!-- put it in style tag ref http://alistapart.com/article/slidingdoors-->

<style>
#header {
    float:left;
    width:100%;
    background:#DAE0D2 url("bg.gif")
      repeat-x bottom;
    font-size:93%;
    line-height:normal;


	box-shadow:10px 5px 40px 20px #051f3c;
	position:relative;
	width:1250px;
	margin:10px auto;
	z-index:10;

}

#header ul {
    margin:0;
    padding:10px 10px 0;
    list-style:none;
}

#header li {
    float:left;
    background:url("left.gif")
      no-repeat left top;
    margin:0;
    padding:0 0 0 9px;
}

#header a, #header strong, #header span {
    display:block;
    background:url("right.gif")
      no-repeat right top;
    padding:5px 15px 4px 6px;
}

#header #current {
    background-image:url("left_on.gif");
}

#header #current a {
    background-image:url("right_on.gif");
    padding-bottom:5px;
	
}

#header a {
    float:left;
    display:block;
    background:url("right.gif")
      no-repeat right top;
    padding:5px 15px 4px 6px;
    text-decoration:none;
    font-weight:bold;
    color:#765;
}

</style>
</body>
</html>
