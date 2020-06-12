
<?php
/*
 * Created by Sean Conquest
 * This is the List of questions that are used to generate the questions on the quiz.
 * This also holds the array of answers and which type of question the answer is.
 * Using multidimensional arrays, it groups each question and related information together
 * for later use in generating objects that contain each.
 */


	/*
	*
	*	This is where the questions and answers are located
	*
	*/
	
	//Using multi-dimensional arrays, the questions, potential answers and question will be located
	//in their respective layers 0, 1, 2 respectively
	/*
	$question_set = array(
		array(
	"This is question1",
	),
		array(
	
	),
		array(
	
	),
	);
	
	*/
	
	//Configure empty multidimensional array
	$question_set = array(array());
	$answer_set = [[]]; /**
 *                          [0][0]: type
                            [0][1]: answer
                        Answer Types:   0: multiple choice - !Not working, have yet to find a way to handle multiple inputs, for now reverts to RADIO buttons
                                        1: true/false
 *                                      2: fill in blank
 *
 * */
	$questionCollection = [];
	
	
	// [0][][] Question
	// [][0][] answers
	$question_set[0][0] = "Water signs include all but?";
	$question_set[0][1] = "Sagittarius";
	$question_set[0][2] = "Aquarius";
	$question_set[0][3] = "Capricorn";
	$question_set[0][4] = "Aries";
	$answer_set[0][0] = 0; //type
	$answer_set[0][1] = 4; //answer

	$question_set[1][0] = "Gemini is a _______ type of sign?.";
	$question_set[1][1] = "Wood";
	$question_set[1][2] = "Metal";
	$question_set[1][3] = "Fire";
    $answer_set[1][0] = 0;
    $answer_set[1][1] = 3;

	$question_set[2][0] = "Chinese Zodiac signs are reliable and provide accurate information to base your life off of?";
	$question_set[2][1] = "Probably True. ";
	$question_set[2][2] = "Probably False.";
    $answer_set[2][0] = 1; // t/f
    $answer_set[2][1] = 2;

    $question_set[3][0] = "There are _____ elements that are related to Chinese Zodiac signs.";
	$question_set[3][1] = "";
    $answer_set[3][0] = 2; // fill in blank
    $answer_set[3][1] = "4";

    $question_set[4][0] = "There are _____ Chinese Zodiac signs.";
	$question_set[4][1] = "";
    $answer_set[4][0] = 2; // fill in blank
    $answer_set[4][1] = "12";

    $question_set[5][0] = "The sign that represents Jul 7 - Jul 22 is?";
	$question_set[5][1] = "Leo";
	$question_set[5][2] = "Gemini";
	$question_set[5][3] = "Cancer";
	$question_set[5][4] = "Aries";
    $answer_set[5][0] = 1;
    $answer_set[5][1] = "3";

    $question_set[6][0] = "The Chinese Zodiac sign that most closely represents the animal of USF (Bull) is?";
    $question_set[6][1] = "Taurius";
    $question_set[6][2] = "Libra";
    $question_set[6][3] = "Virgo";
    $answer_set[6][0] = 1;
    $answer_set[6][1] = 1;

    $question_set[7][0] = "The Chinese Zodiac sign that falls between December 22 - January 19 is?";
    $question_set[7][1] = "";
    $answer_set[7][0] = 2; // fill in blank
    $answer_set[7][1] = "Capricorn";

    $question_set[8][0] = "The Chinese Zodiac animal pig, which is one of the lucky numbers?";
    $question_set[8][1] = "1";
    $question_set[8][2] = "4";
    $question_set[8][3] = "8";
    $answer_set[8][0] = 1; // t/f
    $answer_set[8][1] = 3;

    $question_set[9][0] = "The Chinese Zodiac Rat does not match with?";
    $question_set[9][1] = "Goat";
    $question_set[9][2] = "Rat";
    $question_set[9][3] = "Horse";
    $answer_set[9][0] = 1; // t/f
    $answer_set[9][1] = 3;

    $question_set[10][0] = "The Chinese Zodiac for the day Sunday is ______?";
    $question_set[10][1] = "";
    $answer_set[10][0] = 2; // t/f
    $answer_set[10][1] = "monkey";
	///echo var_dump($question_set) . "<br />";
	
	//echo sizeof($question_set) . "<br />";
	//echo sizeof($question_set[0]) . "<br />";

	
	//can we determine the size of each array

    function returnAnswerType($type) {
        switch($type) {
            case 1:
                echo "radio";
                break;
            case 2:
                echo "text";
                break;
            default:
                //echo "checkbox";
                echo "radio";
                break;
        }
    }

	
	

?>