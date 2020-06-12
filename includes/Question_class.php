<?php

/*
 * Created by Sean Conquest
 * Question class that holds important information for when generating the questions in the quiz dynamically
 */
class Question {
	
	//Basic structure for a question, 
	//this will include the Answer and then possible answers
	//and then it will include the answer choice
	
	public $id;
	public $answer = [];
	public $question;
	public $collection = [];

	
	//Constructor
	/*
	*	$id == the unique id assigned
	*	$Question == string
	*	$collection == strings
	*	$answer == the placement of the answer in the original collection. 
	*				E.G answer is the first of the collection, thus 0 for array location
	*				
	*/

	public function __construct($id, $question, $collection) {
	    $this->id = $id;
	    $this->question = $question;
	    $this->collection = $collection;
	    //$this->answer = $answer;
	}

	public function setID($id){
		$this->id = $id;
	}	
	public function setQuestion($question){
		$this->question = $question;
	}	
	public function setCollection($collection){
		$this->collection = $collection;
	}	
	public function setAnswer($answer){
		$this->answer = $answer;
	}

	
	public function getID(){
		return $this->id;
	}	
	public function getQuestion(){
		return $this->question[0]; //Must be 0 since that is where the question was positioned
	}	
	public function getCollection($num){
		return $this->collection[$num];
	}	
	public function getAnswer(){
		return $this->answer;
	}

	public function checkAnswer($input) {
	    if($input = $this->answer) {
	        echo "True";
        } else {
	        echo "False;";
        }
    }

	function displayQuestion()
    {
        echo "QUESTION: " . $this->question . "<br />";

        foreach ($this->collection as $a) {
            echo $a . " <br />";
        }
    }


	
}

?>