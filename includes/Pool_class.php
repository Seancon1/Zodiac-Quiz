<?php
/*
 *  Created by Sean Conquest
 * Deprecated Pool class that was originally going to be used to hold the question objects
 *
 */


//Pool of questions will be generated here from the question_set

include "Question_class.php"; //Enable the generation of object questions

class Pool {
	
	/*
	
	Question set will be designed as such: 
	0 - for questions,
	1 - for answer set
	2 - for answer
	
	In the multidimensional array.
	
	I'll assign a pool of answers dynamically so that the quiz is customizable
	*/
	
	private $qaPool = array(array(array())); //empty multidimensional
	private $questionCollection = array(); //empty single dimension, holds Question objects
	
	function __construct($qaPool) {
		$this->qaPool = $qaPool;
	}
	

	/*
	function displayQuestions() {
	    echo count($this->questionCollection) . "<br />";

		foreach($this->questionCollection as $q => $val) {
			//$this->$q = new Question();
			echo "ID: " . $q . "<br />";
		}
	}
	*/
}

?>