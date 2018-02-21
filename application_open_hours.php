<?php
    // Open Hours App 
    // 2017 copyright
    // Patricia Georgescu 
    
	date_default_timezone_set ("Europe/Sofia");

	$today = date('j/n');
	$current_hour = date('G:i');
	$day = date('D');
	
	// -> Insert hour intervals in the 24 hours format; if you wish to target 12am, 23:59 is advised
	// -> If one day is completely off, use the interval "00:00-00:00"
	// -> For holidays, put the day in the format day/month without zeros and the specific hours using 24 hours format
	// -> If you are off the whole day in the holiday, use "00:00-00:00" in the specific hour interval 
	
	$open_hours = array ( 'Mon' => '00:00-00:00',
						  'Tue' => '09:00-15:00',
						  'Wed' => '09:00-15:00',
						  'Thu' => '12:00-18:00',
						  'Fri' => '10:00-20:00',
						  'Sat' => '11:00-15:00',
						  'Sun' => '00:00-00:00' );
						  
	$holidays = array( "26/4"  => "10:00-15:00",
					   "25/12" => "00:00-00:00",
					   "1/1"   => "00:00-00:00", 
					  );
	
	$hour_interval = $open_hours["$day"];
	
	$hours = explode("-", $hour_interval);
	
	$start = strtotime($hours[0]);
	$end = strtotime($hours[1]);
	$now = strtotime($current_hour);
	
	if (array_key_exists($today, $holidays) && $holidays["$today"] == "00:00-00:00")
		{
			$closed_for_holiday_all_day = true;
		} 
	elseif (array_key_exists($today, $holidays) && !($holidays["$today"] == "00:00-00:00"))
		{
			$closed_for_holiday_all_day = false;
			$closed_for_holiday = true;
			while (key($holidays) !== $today)
				{
					next($holidays);
				}
			$holiday_hours = current($holidays);
			$holiday_open_hours = explode("-", $holiday_hours);
			$start_open_holiday = strtotime($holiday_open_hours[0]);
			$end_open_holiday = strtotime($holiday_open_hours[1]);
		}
	else
		{
			$closed_for_holiday_all_day = false;
			$closed_for_holiday = false;	
		}
	
	if ($open_hours["$day"] == "00:00-00:00") 
	{
		$closed_today = true;
	} 
	else 
	{
		$closed_today = false;
	}
	
	while (key($open_hours) !== $day)  
	{
		next($open_hours);
	} 	
	
	if ($day == "Sun") 
	{
		reset($open_hours);
		$tomorrow = current($open_hours);
	} 
	else
	{	
	$tomorrow = next($open_hours);
	}
	
	if ($tomorrow == "00:00-00:00")
	{
		$tomorrow_closed = true;
	} 
	else 
	{
		$tomorrow_closed = false;
	}
	
	 if ($tomorrow_closed == true && !($now<$start) && !($now>=$start && $now<=$end) && ($closed_today = true || $now > $end)) 
	{
		  while (current($open_hours) == "00:00-00:00") 
				{
					next($open_hours);
				}
				
			if (current($open_hours) == false)
			{
				reset($open_hours);
				while (current($open_hours) == "00:00-00:00") 
					{
						next($open_hours);
					} 
			} 	
			$interval_back = current($open_hours); 
			$day_back = key($open_hours); 
	 
		$weekday = array (
						  'Mon' => 'Monday',
						  'Tue' => 'Tuesday',
						  'Wed' => 'Wednesday',
						  'Thu' => 'Thursday',
						  'Fri' => 'Friday',
						  'Sat' => 'Saturday',
						  'Sun' => 'Sunday' 
		);
	
		$weekday_back = $weekday["$day_back"];
	} 
	
	 if ($closed_for_holiday_all_day == true)
	{
		echo "<br><span style='color:red;'>Today is a bank holiday. We are enjoying our free time as much as you do!</span><br>";
	} 
	elseif ($closed_for_holiday == true && $now < $start_open_holiday)
	{
		echo "<br><span style='color:orange;'>Though today is a bank holiday, we will be open between $holiday_hours. Drop us a visit then!</span><br>";  
	}
	elseif ($closed_for_holiday == true && $now > $end_open_holiday)
	{
		echo "<br><span style='color:red;'> Ouch! You just missed us for today! We were open between $holiday_hours. We are closed now and enjoying our bank holiday, just like you!</span><br>";
	}
	elseif ($closed_for_holiday == true && $start_open_holiday <= $now && $now <= $end_open_holiday)
	{
		echo "<br><span style='color:green';>Yay! Though today is a bank holiday, we are open right now! Come pay us a visit between $holiday_hours!</span><br>";
	}
	elseif ($closed_today == true && $tomorrow_closed == false) 
	{
		echo "<br><span style='color:red;'>Today is our day off. Please pay us a visit tomorrow between $tomorrow!</span><br>";
	} 
	elseif ($now < $start)
	{
		echo "<br><span style='color:orange;'>Sorry, we are closed right now, but today we will be opened between $hour_interval. Drop us a visit then!</span><br>";
	} 
	elseif ($now > $end && $tomorrow_closed == false) 
	{
		echo "<br><span style='color:red;'> Sorry, we are closed for today, but we will be back tomorrow between $tomorrow. Drop us a visit then!</span><br>";
	} 
	else if ($now > $end && $tomorrow_closed == true)
	{
		echo "<br><span style='color:red;'> Today we are closed. Please come by on $weekday_back between $interval_back.</span>";
	}	
	else
	{
		echo "<br><span style='color:green';> We are opened right now! We are waiting for you! Drop us a visit between $hour_interval!</span><br>";
	}

?>