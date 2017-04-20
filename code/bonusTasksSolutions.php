<?php

/**
 * Bonus task #1
 * (foobardoo) Consider the following code
 */

//$str1 = 'foobardoo';
//$str2 = 'foo';
//if (strpos($str1,$str2)===false) {
//  echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
//} else {
//  echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
//}

/**
  *  ANSWER:  strpos return the position in the string where the match is found,
  *           0 being a valid response...  PHP is a weakly typed language, so 0
  *           is not just an int, it can also equate to false.  To properly
  *           test for type and value you need to use the === operator.
  */


/**
 * Bonus task #2
 * How many elements contain the $_POST data after executing this request and why?
 */


//// js
//$.ajax({
//    url: 'http://my.site/some/path',
//    method: 'post',
//    data: JSON.stringify({a: 'a', b: 'b'}),
//    contentType: 'application/json'
//});

/**
  *  ANSWER:  count($_POST) would be 0.  Because the data is passed
  *           as contentType JSON, not as a typical form type POST.
  *           to retrieve the contents you would have to do a:
  *           file_get_contents('php://input') and pass the results
  *           into json_decode().
  */





/**
 * Bonus task #3
 * (Bread with butte) Solve the statement. Write down your solution.
 */

// A bread with butter cost 1.10 €. The bread is 1€ more expensive then the butter.
//
// How much does the butter cost?

/**
  *  ANSWER:  The butter costs 0.05 €.  The formula to solve this problem is...
  *           2b + 1 = 1.10
  *              - 1   -1
  *               2b = 0.10
  *               /2    /2
  *                b = 0.05
  *
  */
