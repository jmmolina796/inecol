<?php

	function makeLinks($str) 
	{
		$reg_exUrl =    "/((https?\:\/\/)|(www\.))(\S+)(\w{2,4})(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/";
	    $urls = array();
	    $urlsToReplace = array();
	    if(preg_match_all($reg_exUrl, $str, $urls)) 
	    {
	        $numOfMatches = count($urls[0]);
	        $numOfUrlsToReplace = 0;
	        for($i=0; $i<$numOfMatches; $i++) 
	        {
	            $alreadyAdded = false;
	            $numOfUrlsToReplace = count($urlsToReplace);
	            for($j=0; $j<$numOfUrlsToReplace; $j++) 
	            {
	                if($urlsToReplace[$j] == $urls[0][$i]) 
	                {
	                    $alreadyAdded = true;
	                }
	            }
	            if(!$alreadyAdded) 
	            {
	                array_push($urlsToReplace, $urls[0][$i]);
	            }
	        }
	        $numOfUrlsToReplace = count($urlsToReplace);
	        for($i=0; $i<$numOfUrlsToReplace; $i++) 
	        {
	        	$pos1 = strpos($urlsToReplace[$i], 'http');
	        	$pos2 = strpos($urlsToReplace[$i], 'https');

	        	if ($pos1 === false && $pos2 === false) 
	        	{
	        		$href = "http://".$urlsToReplace[$i];

	        		$str = str_replace($urlsToReplace[$i], "<a href=\"".$href."\" target='_blank'>".$urlsToReplace[$i]."</a> ", $str);
	        	}
	        	else
	        	{
	        		$str = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\" target='_blank'>".$urlsToReplace[$i]."</a> ", $str);
	        	}
	        }
	        return $str;
	    } 
	    else 
	    {
	        return $str;
	    }
	}

	function goHome()
	{
		header("Location: ./");
	}

	function getNameFile($url = "")
	{
		if($url == "")
		{
			$url = $_SERVER['REQUEST_URI'];
		}

		$position = strripos($url, "/") === false ? 0 : strripos($url, "/") + 1;  // +1 para no tomar en cuenta la /
		$name = substr($url, $position, strlen($url));
		
		return $name;
	}
	
	function getPaths()
	{
		$request = $_SERVER['REQUEST_URI'];

		if($request != "/")
		{
			$position = strpos($request, "/") === false ? 0 : strpos($request, "/") + 1;
			$paths = substr($request, $position, strlen($request));
		}
		else
		{
			$paths = "home";
		}
		return $paths;
	}

	function joinToProyect($date1,$date2)
	{
		$today = date("Y-m-d");
		return (strtotime($today) >= strtotime($date1) &&  strtotime($today) <= strtotime($date2));
	}

	function formatDate_dmy($date1)
	{
		$date1 = DateTime::createFromFormat('d/m/Y', $date1);
		$date1 = $date1->format('Y-m-d');

		return $date1;
	}