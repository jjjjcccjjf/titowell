<?php

class Scoreboard_model extends CI_model
{
	 public $steps_needed = 6000;
	 public $mood_needed = 3;

	 public $pedometer_counter_score_percentage = 15;
	 public $attendance_score_percentage = 20;
	 public $bmi_score_percentage = 50;
	 public $happiness_meter_score_percentage = 15;

      function __construct()
	 {
	    parent::__construct();
	
     	$this->quarter = $this->getQuarterByMonth(date('m'));
		$this->quarter_where = $this->getQuarterWhere($this->quarter);
	 }

/*	 function buildScoreboard()
	 {
		$pedometer_counter_scores =	$this->getPedometerCounterScores();
		$attendance_scores = $this->getAttendanceScores();
		$bmi_scores = $this->getBMIScores();
		$happiness_meter_scores = $this->getHappinessMeterScores();

		$users = $this->db->get('users')->result();

		foreach ($users as $key => $value) {
			$value->
		}

	 }*/

	 function getPedometerCounterScores()
	 {
	 	$total_items_in_quarter = $this->db->query("
	 		SELECT count(id) as total_items_in_quarter FROM pedometer_counter
	 		WHERE $this->quarter_where 
	 		GROUP BY user_id ORDER BY total_items_in_quarter DESC LIMIT 1")->row()->total_items_in_quarter;

	 	$res = $this->db->query("SELECT *, SUM(step_count) as total_steps, COUNT(id) as total_entries, ($total_items_in_quarter * $this->steps_needed) as steps_desired, (SUM(step_count) / ($total_items_in_quarter * $this->steps_needed)) * 100 as step_rate, (((SUM(step_count) / ($total_items_in_quarter * $this->steps_needed)) * 100) * $this->pedometer_counter_score_percentage) / 100 as score
	 		 	FROM pedometer_counter 
	 		 	WHERE $this->quarter_where 
	 		 	GROUP BY user_id
	 		 	ORDER BY step_rate DESC")->result();

	 	/** sample output */
	 	// SELECT *, SUM(step_count) as total_steps, COUNT(id) as total_entries, (17 * 6000) as steps_desired, (SUM(step_count) / (17 * 6000)) * 100 as step_rate, (((SUM(step_count) / (17 * 6000)) * 100) * 15) / 100 as score FROM pedometer_counter GROUP BY user_id ORDER BY step_rate DESC
	 	return $res;
	 }

	 function getAttendanceScores()
	 {
	 	$total_items_in_quarter = $this->db->query("
	 	SELECT *, count(id) as total_items_in_quarter 
	 	FROM `wellness_program`
	 	WHERE $this->quarter_where 
		GROUP BY user_id
		ORDER BY total_items_in_quarter DESC
		LIMIT 1
 		")->row()->total_items_in_quarter;

 		$res = $this->db->query("SELECT *, COUNT(id) as total_attendance, 
 			(((count(id) / ($total_items_in_quarter) * 100) * $this->attendance_score_percentage) / 100) as score
	 		 	FROM wellness_program
	 		 	WHERE $this->quarter_where 
	 		 	GROUP BY user_id
	 		 	ORDER BY score DESC")->result();

 		// var_dump($this->db->last_query(), $res); die();
 		/**
 		 * SELECT *, COUNT(id) as total_attendance, (((count(id) / (9) * 100) * 20) / 100) as score FROM wellness_program WHERE (`datetime` >= '2020-01-01' AND `datetime` <= '2020-03-31') GROUP BY user_id ORDER BY score DESC
 		 */
 		
 		return $res;
	 }


	 function getBMIScores()
	 {
	 	
	 }

	 function getHappinessMeterScores()
	 {
	 	$total_items_in_quarter = $this->db->query("
	 	SELECT *, count(id) as total_items_in_quarter 
	 	FROM `happiness_meter`
	 	WHERE $this->quarter_where 
		GROUP BY user_id
		ORDER BY total_items_in_quarter DESC
		LIMIT 1
 		")->row()->total_items_in_quarter;	

	 	$res = $this->db->query("SELECT *, SUM(mood) as total_mood, COUNT(id) as total_entries, ($total_items_in_quarter * $this->mood_needed) as mood_needed, (SUM(mood) / ($total_items_in_quarter * $this->mood_needed)) * 100 as mood_rate, 
	 		(
	 		  (((SUM(mood) / ($total_items_in_quarter * $this->mood_needed))
	 	     * 100) * $this->happiness_meter_score_percentage) / 100) as score
	 		 	FROM happiness_meter 
	 		 	WHERE $this->quarter_where 
	 		 	GROUP BY user_id
	 		 	ORDER BY score DESC")->result();

	 	/** sample output */
	 	// var_dump($res, $this->db->last_query()); die();
		// SELECT *, SUM(mood) as total_mood, COUNT(id) as total_entries, (9 * 3) as mood_needed, (SUM(mood) / (9 * 3)) * 100 as mood_rate, ( (((SUM(mood) / (9 * 3)) * 100) * 15) / 100) as score FROM happiness_meter WHERE (`datetime` >= '2020-01-01' AND `datetime` <= '2020-03-31') GROUP BY user_id ORDER BY score DESC
	 	return $res;
	 }
	 
	 function getQuarterWhere($quarter_number = 1, $date_column = 'datetime', $year = null)
	 {
	 	$quarter_where = '1';
	 	$year = ($year)?: date('Y');
	 	switch ($quarter_number) {
	 		default:
	 		case 1:
	 			$quarter_where = "(`$date_column` >= '$year-01-01' AND `$date_column` <= '$year-03-31')";
 			break;

	 		case 2:
	 			$quarter_where = "(`$date_column` >= '$year-04-01' AND `$date_column` <= '$year-06-30')";
 			break;

	 		case 3:
	 			$quarter_where = "(`$date_column` >= '$year-07-01' AND `$date_column` <= '$year-09-30')";
 			break;

	 		case 4:
	 			$quarter_where = "(`$date_column` >= '$year-10-01' AND `$date_column` <= '$year-12-31')";
 			break;
	 	}
	 	return $quarter_where;
	 }

	################################################# 
    ### date function helpers beyondd this point ####
	################################################# 
	#
 	public static function getQuarterByMonth($monthNumber) {
	  return floor(($monthNumber - 1) / 3) + 1;
	}

	public static function getQuarterDay($monthNumber, $dayNumber, $yearNumber) {
	  $quarterDayNumber = 0;
	  $dayCountByMonth = array();

	  $startMonthNumber = ((self::getQuarterByMonth($monthNumber) - 1) * 3) + 1;

	  // Calculate the number of days in each month.
	  for ($i=1; $i<=12; $i++) {
	    $dayCountByMonth[$i] = date("t", strtotime($yearNumber . "-" . $i . "-01"));
	  }

	  for ($i=$startMonthNumber; $i<=$monthNumber-1; $i++) {
	    $quarterDayNumber += $dayCountByMonth[$i];
	  }

	  $quarterDayNumber += $dayNumber;

	  return $quarterDayNumber;
	}

	public static function getCurrentQuarterDay() {
	  return self::getQuarterDay(date('n'), date('j'), date('Y'));
	}
}
