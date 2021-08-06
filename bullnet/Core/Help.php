<?php

namespace Bullnet\Core;


class Help {

	public static function sanitize($value) 
	{
		return htmlentities($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	}

	public static function formatdatetime($datetime = "") 
	{
		return (empty($datetime) || $datetime === "") ? date("F j, Y, g:i a") : date("F j, Y, g:i a", strtotime($datetime));
	}

	public static function formatDate($date = "") 
	{
		return (empty($date) || $date === "") ? date("F j, Y") : date("F j, Y", strtotime($date));
	}

}
