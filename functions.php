<?php

	function validateDate($month,$year,$day)
	{
		// $ndate=explode($seperator,$rawDate);
		//var_dump($ndate);
		if($year<1947||$year>2050)
		{
			return false;
		}
		if($year%4==0)
		{
			$daysArray=[31,29,31,30,31, 30,31,31,30,31, 30,31];
			if($month>=1&&$month<=12)
			{
				if($day>=0&&$day<=$daysArray[$month-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			$daysArray=[31,28,31,30,31, 30,31,31,30,31, 30,31];
			if($month>=1&&$month<=12)
			{
				if($day>=0&&$day<=$daysArray[$month-1])
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}

	function validateDateOfBirth($month,$year,$day)
	{
		/*$date=implode("-", $day, $month, $year);
		$currentDate=new Date("yyyy-mm-dd");
		echo $currentDate;
		/*if($dobTimestamp>=$currentTimestamp)
		{
			return false;
		}
		else
		{
			return true;
		}*/
	}

?>