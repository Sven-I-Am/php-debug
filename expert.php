<?php
declare(strict_types=1);


// Below are several code blocks, read them, understand them and try to find whats wrong.
// Once this exercise is finished, we'll go over the code all together and we can share how we debugged the following problems.
// Try to fix the code every time and good luck ! (write down how you found out the answer and how you debugged the problem)
// =============================================================================================================================

// === Exercise 1 ===
// Below we're defining a function, but it doesn't work when we run it.
// Look at the error you get, read it and it should tell you the issue...,
// sometimes, even your IDE can tell you what's wrong
echo "Exercise 1 starts here:";
new_exercise();
function new_exercise() { //unused element //new_exercise -> function is never called
    $x = '1';
    $block = "<br/><hr/><br/><br/>Exercise" . "$x" . "starts here:<br/>"; //IDE threw error $x not defined after fixing the concat of the echo
    echo $block;
}


// === Exercise 2 ===
// Below we create a week array with all days of the week.
// We then try to print the first day which is monday, execute the code and see what happens.

$week = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
$monday = $week[0]; //xdebug showed array $week[0] is monday

echo $monday;


//new_exercise(3);
// === Exercise 3 ===
// This should echo ` "Debugged !" `, fix it so that that is the literal text echo'ed

$str = '"Debugged !" Also very fun'; //PHPStorm threw error unknown constant "Debugged" and more... upon review, backticks were used instead of quotes. singe quotes on the outside, doubles around the word Debugged
echo substr($str, 0, 12); //had to add 2 to the length to account for the quotes and exclamation mark




//new_exercise(4);
// === Exercise 4 ===
// Sometimes debugging code is just like looking up code and syntax...
// The print_r($week) should give:  Array ( [0] => mon [1] => tues [2] => wednes [3] => thurs [4] => fri [5] => satur [6] => sun )
// Look up whats going wrong with this code, and then fix it, with ONE CHARACTER!

foreach($week as &$day) { //had to google "change values in array during foreach" and the result from so showed the issue -> adding & before $variable makes it so the variable gets changed and written back to the array at once
    $day = substr($day, 0, strlen($day)-3);
}

print_r($week);


//new_exercise(5);
// === Exercise 5 ===
// The array should be printing every letter of the alfabet (a-z) but instead it does that + aa-yz
// Fix the code so the for loop only pushes a-z in the array

$arr = [];
for ($letter = 'a'; $letter <= 'z'; $letter++) {
    if (strlen($letter)==1){ //since the exercise asked to fix the for loop I didn't change to a $arr=range('a','z'); instead I checked the length of $letter to be exactly 1 before pushing it to $arr
        array_push($arr, $letter);
    }
}

print_r($arr); // Array ([0] => a, [1] => b, [2] => c, ...) a-z alfabetical array

// === Final exercise ===
// The fixed code should echo the following at the bottom:
// Here is the name: $name - $name2
// $name variables are decided as seen in the code, fix all the bugs whilst keeping the functionality!
//removed function combineNames, not needed to get same result
//removed function randomGenerate, not needed in this case

function randomHeroName(): string
{
    $hero_firstnames = ["captain", "doctor", "iron", "Hank", "ant", "Wasp", "the", "Hawk", "Spider", "Black", "Carol"];
    $hero_lastnames = ["America", "Strange", "man", "Pym", "girl", "hulk", "eye", "widow", "panther", "daredevil", "marvel"];//semicolon missing
    $hero = [$hero_firstnames[rand(0,count($hero_firstnames))],$hero_lastnames[rand(0,count($hero_lastnames))]]; //creating array with firstname and lastname as elements
    return implode(" - ", $hero);//use return to return variable outside function + implode[array,separator] is now implode[separator, array] since php8.0
}

echo "Here is the name: " . randomHeroName();

////new_exercise(7);
function copyright(int $year): string //return type not declared
{
    return "&copy; $year BeCode";
}
//print the copyright
echo copyright((int)date('Y')); //return value wasn't used anywhere, so added echo + parsed date('y') to INT

////new_exercise(8);
function login(string $email, string $password) {
    if($email == 'john@example.be' && $password == 'pocahontas') { //email AND password need to be correct to allow access
        echo 'Welcome John';
        echo ' Smith';
    } else {
        echo 'No access'; //no access was always echoed, must be placed within else{} to only get called when email or password are false
    }

}

//do not change anything below
//should great the user with his full name (John Smith)
echo login('john@example.be', 'pocahontas');
//no access
echo login('john@example.be', 'dfgidfgdfg');
//no access
echo login('wrong@example.be', 'wrong');
//you can change things again!

////new_exercise(9);
function isLinkValid(string $link) {
    $unacceptables = array('https:','.doc','.pdf', '.jpg', '.jpeg', '.gif', '.bmp', '.png');
    $error = 0;
    foreach ($unacceptables as $unacceptable) { //only check for error in foreach loop, no echo in here because it will echo for each element in array
        if (strpos($link, $unacceptable) == true || str_starts_with($link, $unacceptable)==true) { //had issues finding https:string in link, added str_starts_with to fix
            $error++;
        }
    }
    if ($error>0){
        echo 'Unacceptable Found<br />';//expression result is never used, change to echo...
    } else {
        echo 'Acceptable<br />'; //again, if()else... Acceptable can only be echoed in case if(=false)
    }
}
//invalid link
isLinkValid('http://www.google.com/hack.pdf');
//invalid link
isLinkValid('https://google.com');
//VALID link
isLinkValid('http://google.com');
//VALID link
isLinkValid('http://google.com/test.txt');

////new_exercise(10);

//Filter the array $areTheseFruits to only contain valid fruits
//do not change the arrays itself
$areTheseFruits = ['apple', 'bear', 'beef', 'banana', 'cherry', 'tomato', 'car'];
$validFruits = ['apple', 'pear', 'banana', 'cherry', 'tomato'];
//from here on you can change the code
$countOrig = count($areTheseFruits); //because we're destroying elements as we go, the length of the array changes as well, and we end up not being able to destroy the last element if needed.
for($i=0; $i <= $countOrig; $i++) {
    if(!in_array($areTheseFruits[$i], $validFruits)) { //in_array(mixed $needle, array $haystack, bool $strict = false): bool
        unset($areTheseFruits[$i]);
    }
}
var_dump($areTheseFruits);//do not change this