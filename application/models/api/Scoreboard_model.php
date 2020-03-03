<?php

class Scoreboard_model extends CI_model
{
	 public $steps_needed = 6000;
	 public $mood_needed = 3;
	 public $floor_ideal_bmi = 18.5;

	 public $pedometer_counter_score_percentage = 15;
	 public $attendance_score_percentage = 20;
	 public $bmi_score_percentage = 50;
	 public $happiness_meter_score_percentage = 15;

      function __construct()
	 {
	    parent::__construct();

		$this->year = $this->input->get('year')?: date('Y');
    	$this->quarter = $this->input->get('quarter')?: $this->getQuarterByMonth(date('m'));
		$this->quarter_where = $this->getQuarterWhere($this->quarter, $this->year);

		$this->pedometer_counter_scores =	$this->getPedometerCounterScores();
		$this->attendance_scores = $this->getAttendanceScores();
		$this->bmi_scores = $this->getBMIScores();
		$this->happiness_meter_scores = $this->getHappinessMeterScores();

	 }

	 function getSingleUserCiteriaScore($criteria = 'bmi_scores', $user_id)
	 {
	 	#other values, 'pedometer_counter', 'attendance', 'bmi', 'happiness_meter'
	 	foreach ($this->$criteria as $key => $value) {
	 		if ($value->user_id == $user_id) {
	 			return $value->score;
	 		}
	 	}

	 	return 0; # if user is not existing
	 }

	 function buildScoreboard($target = 'all')
	 {
	 	if ($target!= 'all') {
	 		$this->db->where('gender', $target); # 'male' or 'female' only
	 	}
		$users = $this->db->get('users')->result();

		foreach ($users as $key => $value) {
			$value->bmi_score = $this->getSingleUserCiteriaScore('bmi_scores', $value->id);
			$value->pedometer_counter_score = $this->getSingleUserCiteriaScore('pedometer_counter_scores', $value->id);
			$value->attendance_score = $this->getSingleUserCiteriaScore('attendance_scores', $value->id);
			$value->happiness_meter_score = $this->getSingleUserCiteriaScore('happiness_meter_scores', $value->id);

			$value->total_score = 
				$value->bmi_score +
				$value->pedometer_counter_score +
				$value->attendance_score +
				$value->happiness_meter_score;
		}

		usort($users, function($a, $b)
		{
		    return strcmp($a->total_score, $b->total_score);
		});

		$users = array_reverse($users); 
		return $users;
	 }



	 function getPedometerCounterScores()
	 {
	 	$total_items_in_quarter = @$this->db->query("
	 		SELECT count(id) as total_items_in_quarter FROM pedometer_counter
	 		WHERE $this->quarter_where 
	 		GROUP BY user_id ORDER BY total_items_in_quarter DESC LIMIT 1")->row()->total_items_in_quarter ?: 0;

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
	 	$total_items_in_quarter = @$this->db->query("
	 	SELECT *, count(id) as total_items_in_quarter 
	 	FROM `wellness_program`
	 	WHERE $this->quarter_where 
		GROUP BY user_id
		ORDER BY total_items_in_quarter DESC
		LIMIT 1
 		")->row()->total_items_in_quarter ?: 0;

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

	 	/* 
		SELECT y.id, y.user_id, CONCAT(z.fname, ' ', z.lname) as full_name, z.fname, z.lname, z.gender, 	z.birth_date, z.initial_weight_in_pounds, z.height_in_feet, z.height_in_inches, 
		((z.height_in_feet * 12) + z.height_in_inches) as total_height_in_inches,
		ROUND(18.5 * POWER((z.height_in_feet * 12) + z.height_in_inches, 2) / 703) as ideal_weight,
		ABS(y.weight_in_pounds - ROUND(18.5 * POWER((z.height_in_feet * 12) + z.height_in_inches, 2) / 703)) as target_weight,
		((ABS(((MAX(target_weight) / y.weight_in_pounds) * 100) - 100) * 50) / 100) as score,
		y.datetime, y.weight_in_pounds, y.type, y.created_at, y.updated_at 
		FROM (
		    SELECT id, user_id, MAX(datetime) as datetime, weight_in_pounds, type, created_at, updated_at FROM tito GROUP BY user_id
		) as x
		INNER JOIN tito as y
		ON x.user_id = y.user_id AND
		x.datetime = y.datetime
		LEFT JOIN users as z 
		ON y.user_id = z.id
		ORDER BY target_weight ASC
	 	 */
	 	
	 	# current weight - ideal
	 	# pag underweight
	 	# dun sa lowest range ng Healthy
	 	# pag overweight
	 	# dun sa lowest range ng Healthy
		# ((ABS(((MAX(target_weight) / y.weight_in_pounds) * 100) - 100) * 50) / 100) as score,
	 	
	 	$floor_ideal_bmi = $this->floor_ideal_bmi;
 		$res = $this->db->query("
			SELECT y.id, y.user_id, CONCAT(z.fname, ' ', z.lname) as full_name, z.fname, z.lname, z.gender, z.birth_date, z.initial_weight_in_pounds, z.height_in_feet, z.height_in_inches, 
			((z.height_in_feet * 12) + z.height_in_inches) as total_height_in_inches,
			ROUND(18.5 * POWER((z.height_in_feet * 12) + z.height_in_inches, 2) / 703) as ideal_weight,
			ABS(y.weight_in_pounds - ROUND($floor_ideal_bmi * POWER((z.height_in_feet * 12) + z.height_in_inches, 2) / 703)) as target_weight,
			y.datetime, y.weight_in_pounds, y.type, y.created_at, y.updated_at 
			FROM (
			    SELECT id, user_id, MAX(datetime) as datetime, weight_in_pounds, type, created_at, updated_at FROM tito GROUP BY user_id
			) as x
			INNER JOIN tito as y
			ON x.user_id = y.user_id AND
			x.datetime = y.datetime
			LEFT JOIN users as z 
			ON y.user_id = z.id
			ORDER BY target_weight ASC")->result();

 		if (!$res) {
 			return [];
 		}

 		$max_target_weight = array_reduce($res, function($a, $b){
		  return $a ? ($a->target_weight > $b->target_weight ? $a : $b) : $b;
		})->target_weight; # get target weight maximum

 		foreach ($res as $key => $value) {
		// var_dump($max_target_weight, $value->target_weight); die();
		// ((ABS(((MAX(target_weight) / y.weight_in_pounds) * 100) - 100) * 50) / 100) as score,
			$rate = $value->target_weight ?($max_target_weight / $value->target_weight) : 2;
 			$value->score = abs((($rate * 100) - 100) * $this->bmi_score_percentage) / 100;
 		}

 		return $res;
	 }	

	 function getHappinessMeterScores()
	 {
	 	$total_items_in_quarter = @$this->db->query("
	 	SELECT *, count(id) as total_items_in_quarter 
	 	FROM `happiness_meter`
	 	WHERE $this->quarter_where 
		GROUP BY user_id
		ORDER BY total_items_in_quarter DESC
		LIMIT 1
 		")->row()->total_items_in_quarter ?: 0;	

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
	 
	 function getQuarterWhere($quarter_number = 1, $year = null, $date_column = 'datetime')
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
