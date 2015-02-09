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
		$dobTimestamp=mktime(0, 0, 0, $month, $day, $year);
		// echo $dobTimestamp;
		$currentTimestamp=time();
		// echo $currentTimestamp;
		if($dobTimestamp>=$currentTimestamp)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function validateEmail($email)
	{
		$emailSplit=explode("@",$email);
		if(count($emailSplit)==2)
		{
			$addressSplit=explode(".",$emailSplit[1]);
			if(count($addressSplit)>=2)
			{
				$noOFATs=0;
				for($i=0;$i<strlen($email);$i++)
				{
					if($email[$i]=='@')
					{
						$noOFATs=$noOFATs+1;
					}
				}
				if($noOFATs>1)
				{
					return false;
				}
				else
				{
					return true;
				}
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

?>