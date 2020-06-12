<?php

/*
 * Created by Sean Conquest
 * Dynamically generated quiz that handles incorrect answers, incomplete answers. Requires all answers to be completed before grading can be done.
 *
 */
	//error_reporting(-1);
	//ini_set('display_errors', 'On');

        //The use of sessions are important in retaining the information the user enters for their answers.
        session_start();

        /*
         * canGrade global variable, it is used to capture if the quiz can be graded. This value is ultimately checked when generating the questions
         * since each page load, the questions are regenerated as to enable ME the developer to respond answered questions and generate appropriate reponses for doing so
        */
        $GLOBALS['canGrade'] = False;

        $GLOBALS['amountCorrect'] =0; //initialize this for use later, to count number of correct answers

        //RESET button for the quiz, it enables the destroying of the session, which removes all saved information.
        if($_GET['destroy'] == true) {
            session_unset();
        }

        //ESSENTIAL inclusions of the Question class and the question set which are both referenced later down.
		include_once("includes/Question_class.php");
		include_once("includes/question_set.php");

        //THIS IS WHERE THE QUESTION OBJECTS ARE CREATED
		//GENERATE, Populate, and then assign object to an array
        $temp = [];
        $count=0;

        //Loops through the array of questions in the question set and assigns the information to a new object class each different
        //part of the array
        //THIS was the hardest part of this quiz, multidimensional arrays can be tricky and getting the size of each particular
        //dimension was a challenge, but nonetheless I got it working to accommodate any changes in the question set (if new questions were to be added or deleted).
        for($i = 0; $i <= sizeof($question_set) -1; $i++) {
            // $this->questionCollection[$i] = (new Question())->setID($i);

            for($j =0; $j <= sizeof($question_set[$i]) -1; $j++) {
                //echo "[" . $i . "]" . "[" . $j . "]" . $question_set[$i][$j] . "<br />";
                $temp[] = $question_set[$i][$j];
            }

            // echo $i . var_dump(array_slice($temp, 0, 1)) . var_dump( array_slice($temp, 1));
            //Making the new object, splitting information up to the appropriate arguments required for the class
            $questionCollection[] = new Question($i, array_slice($temp, 0, 1), array_slice($temp, 1));
                
            //$questionCollection[] = new Question(1, array(1), array(2));

            //used to temporarily store information for each iteration
            unset($temp);
            $temp = array();
        }

?>
<!-- Sean Conquest -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<title>Zodiac Quiz</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
    <body>

        <h1>Zodiac Quiz</h1>
        <div style="display: block; margin-left: auto;margin-right: auto;width: 40%;">
        
        <?php
        //Seperate validation for Name and Email
        //Loop through the POSTED information
        if(isset($_POST['submitted'])) {
            if (!empty($_POST['submitted'])) {


                //The plan is to iterate through the answers here and display whether they have even been answered or not
                //however since the questions are generated after each page load, I can display the
                //incorrect answers at each question location instead of creating another object check

                //I can display which answers have not been answered, but then when they are all answered, i can
                //go ahead and issue a answer check against the actual correct answer in the object

                //Putting each POST value into an array so that it can be looped through

                //loop through the number of times there are of objects (to work if new questions are added)
                $unAnsweredCount = 0; //self explanatory
                $Count = 0; //counts the number of answered questions

                //Don't want to loop more than needed, and since answers and questions are parallel...
                for ($i = 0; $i < sizeof($questionCollection); $i++) {

                    //Have to check if the answer actually is empty of not, if it is empty, not answered
                    if (empty($_POST["Question" . $i])) {
                        echo "You must answer Question " .($i+1) ." before the quiz is graded ." . "<br />";
                        $GLOBALS['canGrade'] = false;
                        $unAnsweredCount++;
                    } else {
                        //Creates a session so I can store their answers while they attempt to answer the rest of the quiz
                        //Also so that I can recheck the answers they have already chosen so that they don't have to
                        //reanswer all of the questions again

                        //assign their input so we can keep it until the end of the quiz
                        $_SESSION["Question" . $i] = $_POST["Question" . $i];
                        $Count++;
                    }
                }
                //Checks at the end of the loop to see if all answers are answered
                //Make sure we don't start grading if there are still unanswered questions
                if($unAnsweredCount <= 0) {
                    $GLOBALS['canGrade'] = true;
                } else {
                    echo "You must answer " . $unAnsweredCount . " more questions.";
                    $GLOBALS['canGrade'] = false;
                }

            } else {
                echo "Post value for submission is false.";
            }

            //Check if name is filled
            if(isset($_POST['name'])) {
                if(empty($_POST['name'])) {
                    echo "Name cannot be empty. <br />";
                    $GLOBALS['canGrade'] = False;
                } else {
                    $_SESSION['name'] = $_POST['name'];
                }
            } else {
                echo "You must define your name. <br />";
                $GLOBALS['canGrade'] = False;
            }

            //check if email is filled
            if(isset($_POST['email'])) {
                if(empty($_POST['email'])) {
                    echo "Email cannot be empty. <br />";
                    $GLOBALS['canGrade'] = False;
                } else {
                    $_SESSION['email'] = $_POST['email'];
                }
            }else {
                echo "You must define your email. <br />";
                $GLOBALS['canGrade'] = False;
            }
        }
        ?>


        <form  id="Answers" action="" method="post">

            <!-- DEBUGGING FORM
            <fieldset>
                <legend>Answer 1</legend>
                <div>
                    <input type="radio" name="A1" value="a1"  />
                    <label for="Answer1">Answer 1</label>
                </div>
                <div>
                    <input type="radio" name="A1" value="a2" />
                    <label for="Answer2">Answer 2</label>
                </div>
            </fieldset>
`           -->

            <div>
                Name: <input type="text" name="name" value="<? echo $_SESSION['name']; ?>"/> <br />
                Email Address: <input type="text" name="email" value="<? echo $_SESSION['email']; ?>"/>
            </div>


		<?php
        //if(isset($_SESSION)) {print_r($_SESSION); } else {echo "Session is not set.";}


        //$questionCollection[] = new Question(1, array(1,"3","5"), array("1","2"));
        //echo "Size of collection" . sizeof($questionCollection) . "<br />";
        //var_dump($questionCollection);

        //Assign values to each class Question from question_set
        //Generate Question HTML based off of the Question Objects
        foreach($questionCollection as $item) {
           $num = $item->getID();
           $num++;

            $onceCount = 0; //make this one so I count one correct answer per question

            ?>

            <fieldset>
                <legend><? echo "#" . $num . " "  . $item->getQuestion(); ?></legend>
                <?php
                //LOOP through each question answer and display them with the appropriate look
                if(sizeof($item->collection) >= 1) {
                    
                    
                    for ($x = 0; $x < sizeof($item->collection); $x++) {
                        $var = $item->getID();
                        $type= $answer_set[$var][0]; //the answer set corresponds to the question ID, this checks the number for the type of question
                                                    //so that I can format the response for the type of answer
                        $correctAnswer= $answer_set[$var][1];
                        //echo "ANSWER TYPE:" . $answer_set[$var][0];
                        //echo "ANSWER ID:" . $var;

                        $stylizedResponse;
                        $hasResponsed = FALSE;
                        if($GLOBALS["canGrade"] == true) {
                           
                            if($_SESSION["Question".$var] == $correctAnswer) {
                                //echo "You got this answer correct!";
                                if($onceCount < 1) {  //make sure it only counts once per question
                                    $GLOBALS['amountCorrect']++; //got one correct, increment
                                    $onceCount++; //prevent it counting the amount of questions in the pool as correct, only once per question IF correct
                                }
                                $stylizedResponse = "green";
                            } else {
                                
                                $stylizedResponse = "red";
                 
                                    //show the correct answer
                                    echo "The correct answer is ";
                                    if($type == 2) { //must literally display the correct answer due to fill in the blank
                                        echo $correctAnswer;
                                    } else { //otherwise correct the response to a a,b,c,d
                                    switch($correctAnswer) { case 1: echo "a"; break; case 2: echo "b"; break; case 3: echo "c"; break; case 4: echo "d"; break; case 4: echo "e"; break; case 5: echo "f"; break; case 6: echo "g"; break;}
                                    }
                                    echo ".";
                              
                            }
                            }
                            

                        ?>

                        <?
                            switch($stylizedResponse) {
                                case "red":
                                    echo "<div style='background-color: #F9A391;'><font color='red'>&#10008;</font>";
                                    break;
                                case "green":
                                    echo "<div style='background-color: #91F9BA;'><font color='green'>&#10004;</font>";
                                    break;
                                default:
                                    echo "<div>";
                                    break;
                        }
                      
                        ?>
                            <input type="<? returnAnswerType($type); ?>" name="<? echo "Question$var"; ?>"
                               value="<? if((isset($_SESSION["Question".$var])) && ($type == 2)) { echo $_SESSION["Question".$var]; } else if(empty($_SESSION["Question".$var]) && $type==2) { echo ""; } else  {echo "". ($x+1) . ""; } ?>"
                                <? if((!empty($_SESSION["Question".$var])) && ($_SESSION["Question".$var] == ($x+1))) { echo "checked"; } else {}?>>
                            <label for="<? echo $x; ?>"><? switch($x) { case 0: echo "a) ";break; case 1: echo "b) "; break; case 2: echo "c) "; break; case 3: echo "d) "; break; case 4: echo "e) "; break; case 4: echo "f) "; break; case 5: echo "g) "; break; case 6: echo "h) "; break;} echo $item->getCollection($x); ?></label>
                        </div>

                        <?

                    }
                    
                   
                }
                ?>
            </fieldset>

            <?php
        }

        if(($GLOBALS['amountCorrect'] >= 0) && ($GLOBALS['canGrade'])) {
            echo "You scored a " . $GLOBALS['amountCorrect'] . " out of " . sizeof($questionCollection) . ".";
            $calculatedScore = round(($GLOBALS['amountCorrect']/sizeof($questionCollection)) * 100, 2);
            
            echo "<div style='font-size: x-large'>SCORE: " . $calculatedScore . "%</div>";
            
            //Give a customized response depending on the grade they got
            if($calculatedScore >= 100) {
                echo "Nice! You really know your Zodiac signs! You reached Master Zodiac!";
            } elseif ($calculatedScore < 100 && $calculatedScore >=90) {
                echo "You may know your Zodiac signs, but you aren't a master.";
            } elseif ($calculatedScore < 90 && $calculatedScore >=70) {            
                echo "You did great, perhaps you should study your Zodiac signs more.";
            } elseif ($calculatedScore < 70 && $calculatedScore >=50) {
                echo "Lackluster score, you might have to refreshen up on your Zodiac knowledge.";
            } elseif ($calculatedScore < 50 && $calculatedScore >=30) {
                echo "You really didn't do so hot, maybe study more?";
            } elseif ($calculatedScore < 30 && $calculatedScore >=0) {
                echo "You don't know much about Zodiac signs, unfortunately.";
            } else{
                echo "Somehow your score did not issue a customized response.";
            }
            echo "<br />";
        }
		?>
            
            <input type="hidden" name="submitted" value="true" />
            <input type="submit" <?php if($GLOBALS['canGrade']) {echo 'disabled';} ?>>
        </form>

        <p>&nbsp;</p>
        <a href="?destroy=true">Restart Quiz</a>
        </div>
    </body>
</html>