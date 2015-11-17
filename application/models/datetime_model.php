<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DateTime_model extends CI_Model
{
	private $twoweeks_formated;
	private $twoweeks_sql;
	private $correction;
	public function __construct()
	{
		$this->get14days();
		$this->correction = CORRECTION_DATE;
	}
    private function get14days($offset = 0)
	{
		$cid = -1;
		$dates = array();
		$d = date("d");
		$date_time_now = mktime(date("H")-$this->correction, date("i"), date("s"), date("m"), $d, date("Y"));
		$day_of_week = date("w",$date_time_now);
		if ($day_of_week==0) $day_of_week=7;
		for ($i=0; $i<14; $i++)
		{
			$tmp = mktime(date("H")-$this->correction, date("i"), date("s"), date("m"), $d-$day_of_week+1+$i+$offset, date("Y"));
			if (date("Y-m-d", $date_time_now)==date("Y-m-d", $tmp))
				$cid=$i;
			$dates1[] = date("Y-m-d", $tmp);
			$dates2[] = array('day' => $this->rus_date("d", $tmp), 'month'=> $this->rus_date("F", $tmp), 'day_of_week' => $this->rus_date("l", $tmp));
		}
		$this->twoweeks_formated = array('dates' => $dates2, 'cid' => $cid);
		$this->twoweeks_sql = array('dates' => $dates1, 'cid' => $cid);
	}
	public function getTimeNow()
	{
		$d = date("d");
		$date_time_now = mktime(date("H")-$this->correction, date("i"), date("s"), date("m"), $d, date("Y"));
		return date("Y-m-d H:i:s", $date_time_now);
	}
	public function getDates($format, $id=false)
	{
		if ($id === false)
		{
			if ($format == "sql")
				return $this->twoweeks_sql;
			if ($format == "div")
				return $this->twoweeks_formated;
		}
		else
		{
			if ($format == "sql")
				return $this->twoweeks_sql['dates'][$id];
			if ($format == "div")
				return $this->twoweeks_formated['dates'][$id];
		}
	}
	public function otherWeeks($cnt)
	{
		$this->get14days(7*$cnt);
	}
	private function rus_date()
	{
		$translate = array(
			"am" => "дп",
			"pm" => "пп",
			"AM" => "ДП",
			"PM" => "ПП",
			"Monday" => "Понедельник",
			"Mon" => "Пн",
			"Tuesday" => "Вторник",
			"Tue" => "Вт",
			"Wednesday" => "Среда",
			"Wed" => "Ср",
			"Thursday" => "Четверг",
			"Thu" => "Чт",
			"Friday" => "Пятница",
			"Fri" => "Пт",
			"Saturday" => "Суббота",
			"Sat" => "Сб",
			"Sunday" => "Воскресенье",
			"Sun" => "Вс",
			"January" => "Января",
			"Jan" => "Янв",
			"February" => "Февраля",
			"Feb" => "Фев",
			"March" => "Марта",
			"Mar" => "Мар",
			"April" => "Апреля",
			"Apr" => "Апр",
			"May" => "Мая",
			"May" => "Мая",
			"June" => "Июня",
			"Jun" => "Июн",
			"July" => "Июля",
			"Jul" => "Июл",
			"August" => "Августа",
			"Aug" => "Авг",
			"September" => "Сентября",
			"Sep" => "Сен",
			"October" => "Октября",
			"Oct" => "Окт",
			"November" => "Ноября",
			"Nov" => "Ноя",
			"December" => "Декабря",
			"Dec" => "Дек",
			"st" => "ое",
			"nd" => "ое",
			"rd" => "е",
			"th" => "ое"
		);
		if (func_num_args() > 1)
		{
			$timestamp = func_get_arg(1);
			return strtr(date(func_get_arg(0), $timestamp), $translate);
		}
		else
		{
			return strtr(date(func_get_arg(0)), $translate);
		}
	}
}