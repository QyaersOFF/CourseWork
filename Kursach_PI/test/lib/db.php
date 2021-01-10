<?php
session_start();
$user_login=$_SESSION['login'];
include_once $_SERVER['DOCUMENT_ROOT'] . "/Kursach_PI/test/config.php";
mysqli_query($link,"SET NAMES 'utf8");
mysqli_query($link,"SET CHARACTER SET 'utf8'");

@define("VARIABLE_ID", 1);

class DBTask 
{ 
	public $link;
	
	function __construct ($db_host,$db_user,$db_password,$db_base) {
		$this->link = mysqli_connect($db_host,$db_user,$db_password,$db_base);
		mysqli_query($this->link,"SET NAMES 'utf8");
		mysqli_query($this->link,"SET CHARACTER SET 'utf8'");
	}
	// result = [ 
	//	 id : task_id
	// 	 text_task: task_text,	
	// 	 ans : [
	//     0: [id: ans_id, text: ans_tex,is_true: ans_bool]
	//   ]
	// ]
	public function getTaskById ($task_id) {
		$str_query = "
			SELECT task.id_task,task.text_task, va.id_v_a, va.ansver, va.true_or_false
			FROM task
			LEFT JOIN variable_ansvers AS va ON task.id_task=va.id_task_va
			wHERE task.id_task=$task_id
		";
		
		
		$db_task = mysqli_query($this->link, $str_query);
		
		if (!$db_task) 
			return false;
		
		$res = $ans = []; 
		while ($row = $db_task->fetch_array(MYSQLI_ASSOC)) {
			if (!array_key_exists('id', $res)) {
				$res['id'] = $row['id_task'];	
				$res['text'] = $row['text_task'];				
			}
			$ans = [
				"id" => $row['id_v_a'],
				"text" => $row['ansver'],
				"true_or_false" => $row['true_or_false']
			];
			$res['answer'][] = $ans;
		}
		return $res;
	}
	
	public function getTasksByTheme ($theme) {
		// $str_query = "
			// SELECT DISTINCT task.id_task
			// FROM task, thema, test
			// WHERE thema_text='$theme_name' AND  test.id_task_t=task.id_task AND test.id_theme=thema.id_th 
		// ";
		
		$str_query = "
			SELECT DISTINCT ta.id_task,ta.text_task, va.id_v_a, va.ansver, va.true_or_false, ta.id_type_task
			FROM test ts 
			INNER JOIN task ta ON ta.id_task=ts.id_task_t 
			INNER JOIN thema th ON ts.id_theme=th.id_th 
			INNER JOIN variable_ansvers va ON ta.id_task=va.id_task_va 
			WHERE th.thema_text='$theme'	
		";
		
		
		$db_task = mysqli_query($this->link, $str_query);
		
		if (!$db_task) 
			return false;
		
		$res = $ans = []; 
		while ($row = $db_task->fetch_array(MYSQLI_ASSOC)) {
			$taskId = $row['id_task'];
			if (!array_key_exists($taskId, $res)) 
				$res[$taskId] = [];
			if (!array_key_exists('id', $res[$taskId])) {
				$res[$taskId]['id'] = $row['id_task'];	
				$res[$taskId]['text'] = $row['text_task'];
				$res[$taskId]['type'] = $row['id_type_task'];				
			}
			$ans = [
				"id" => $row['id_v_a'],
				"text" => $row['ansver'],
				"true_or_false" => $row['true_or_false']
			];
			$res[$taskId]['answer'][] = $ans;
		}
		return $res;
	}

	public function getThemeList () {
		$db_list_theme = mysqli_query($this->link,"SELECT  login_u FROM user_t where privelegy_u='doctor'");
		
		if(mysqli_num_rows($db_list_theme)<=0) {
			return false;
		}
		$res = [];
		while ($row = $db_list_theme->fetch_array(MYSQLI_ASSOC)) {
			$res[] = [
				"text" => $row['login_u'],
			];

		}
		return $res;
	}
	
	public function getTaskIDListByTheme ($theme_name) {
		$str_query = "
			SELECT DISTINCT task.id_task
			FROM task, thema, test
			WHERE thema_text='$theme_name' AND  test.id_task_t=task.id_task AND test.id_theme=thema.id_th 
		";
		
		$db_task_id_list = mysqli_query($this->link,$str_query);
		if(mysqli_num_rows($db_task_id_list)<=0) {
			return false;
		}
		
		$res = [];
		while ($row = $db_task_id_list->fetch_array(MYSQLI_ASSOC)) {
			$res[] = $row['id_task'];

		}
		return $res;
	}
	//Получаем id теста по теме.
	public function getIdTheme($theme_name){
		$str_query="
			SELECT DISTINCT thema.id_th
			FROM thema 
			WHERE thema.thema_text='$theme_name'
		";
		$db_theme_id = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		while ($row = $db_theme_id->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['id_th'];

		}
		return $res;
		
	}
	public function getIdUser($user)
	{
		$str_query="
			SELECT DISTINCT id_u
			FROM user_t WHERE login_u=$user
		";
		$db_user_id = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		while ($row = $db_user_id->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['id_u'];

		}
		return $res;
		
	}
	
	public function setResults ($id_th_r, $id_user, $id_task ,$id_answer, $date, $number_try) {
		$str_query = "
			INSERT INTO results (id_th_r, id_user_r, id_task_r, id_ansver_r, date_ansver_r, number_try) 
			VALUES ($id_th_r, $id_user, $id_task ,'$id_answer', $date, $number_try)
			";
		$db_result = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows  ($this->link)>0) {
			return false;
		} else {
			return true;
		}
		
	}
	//Получаем количество правильных ответов пользователя
	public function getEnumRightAnsvers($user_login,$thema,$number_try){
		$str_query = "
			SELECT count(id_ansver_r) 
			FROM variable_ansvers,results,thema 
			WHERE ansver=id_ansver_r and id_user_r=$user_login and 
			id_th=id_th_r and true_or_false='Да' and number_try=$number_try;
		";
		$db_select_enum_ansvers = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		if ($row = $db_select_enum_ansvers->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['count(id_ansver_r)'];

		}
		return $res;		
	}
	public function getAnsvers($user_login,$thema,$number_try){
		$str_query = "
		SELECT count(id_ansver_r) 
			FROM results,thema 
			WHERE id_user_r=$user_login and 
			id_th=id_th_r and number_try=$number_try;
			";
		$db_select_enum_ansvers = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		if ($row = $db_select_enum_ansvers->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['count(id_ansver_r)'];

		}
		return $res;		
	}
		public function setResultsPeoples ($id_user_rp,$id_th_rp,$enum_of_right_ansvers) {
		$str_query = "
			INSERT INTO rait_of_peoples (id_user_RP, id_th_rp,enum_of_right_ansvers) 
			VALUES ($id_user_rp,$id_th_rp,$enum_of_right_ansvers)
			";
		$db_result_p = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows  ($this->link)>0) {
			return false;
		} else {
			return true;
		}
		
	}
	public function getPrivelegyUserById($user_id){
		$str_query="
			SELECT privelegy_u FROM user_t WHERE id_u='$user_id'
		";
		$db_select_privelegy = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		if ($row = $db_select_privelegy->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['privelegy_u'];

		}
		return $res;
		
	}	
		public function getPrivelegyUserByUserName($user_login){
		$str_query="
			SELECT privelegy_u FROM user_t WHERE id_u='$user_login'
		";
		$db_select_privelegy = mysqli_query($this->link,$str_query);
		if(mysqli_affected_rows ($this->link)<0) {
			return false;
		}
		
		$res = 0;
		if ($row = $db_select_privelegy->fetch_array(MYSQLI_ASSOC)) {
			$res = $row['privelegy_u'];

		}
		return $res;

	}	
}

$DB = new DBTask($db_host,$db_user,$db_password,$db_base);
	function isAdmin(){
	global $DB,$user_login;
	$check_user_access= $DB->getPrivelegyUserByUserName($user_login);
}
