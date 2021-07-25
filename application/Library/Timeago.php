<?php declare(strict_types=1);

namespace Bullnet\Library;


class Timeago {


	public static function make($timeago){
		$timeago = strtotime($timeago);
		$seconds = time() - $timeago;
		$minutes = round($seconds / 60); // value 60seconds
		$hours   = round($seconds / 3600); // 60 minutes * 60 seconds
		$days    = round($seconds / 86400); //24hours * 60 * 60;
		$weeks   = round($seconds / 604800); // 7days * 24 * 60 * 60;
		$months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
		$years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

	    if ($seconds <= 60){
	        return "Just Now";
	    } else if ($minutes <= 60){
		    if ($minutes == 1){
		        return "One Minute Ago";
		    } else {
		        return "$minutes Minutes Ago";
		    }
	    } else if ($hours <= 24){
		    if ($hours == 1){
		        return "An Hour Ago";
		    } else {
		        return "$hours Hours Ago";
		    }
	    } else if ($days <= 7){
		    if ($days == 1){
		        return "Yesterday";
		    } else {
		        return "$days Days Ago";
		    }
	    } else if ($weeks <= 4.3){
		    if ($weeks == 1){
		      	return "A Week Ago";
		    } else {
		      	return "$weeks Weeks Ago";
		    }
	    } else if ($months <= 12){
		    if ($months == 1){
		      	return "A Month Ago";
		    } else {
		      	return "$months months Ago";
		    }
	    } else {
		    if ($years == 1){
		      	return "One Year Ago";
		    } else {
		      	return "$years Years Ago";
		    }
	    }
	}

}



