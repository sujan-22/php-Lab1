<?php
// I, Sujan Rokad, 000882948, certify that this material is my original work.
// No other person's work has been used wihtout suitable acknoledgment and I
// have note made my work available to anyone else.

/** 
 * @author Sujan Rokad
 * @version 202335.00
 * @package COMP 10260 Assignment 1
*/
if(isset($_GET['serial_number'])){
    $serial_number = $_GET['serial_number'];
    if (empty($serial_number)) {
        echo "Please enter a serial number!!";
    }
    else {
        $categories = noteCategory($serial_number);

        if (!empty($categories)){
            foreach($categories as $category){
                echo "<li>$category</li>";
            }
        }  
        else {
        echo "Uninteresting serial number";
        }
    }
}

    /**
    * function to check Radar note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool true if pattern matched, false otherwise
    */
    function radarNote($serial_number){
        return ((strrev($serial_number) === $serial_number) && (strlen($serial_number) > 0));
    }

    /**
    * function to check Solid note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool true if serial number is solid, false otherwise
    */
    function solidNote($serial_number){
        $solid_digit = '1';
        $temp1 = str_split($serial_number);
        foreach($temp1 as $digit){
            if ($digit !== $solid_digit){
                return false;
            }
        } return !empty($serial_number);
    }

    /**
    * function to check Ladder Up and Ladder Down note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool "Ladder up note" if ladder up pattern, "Ladder down note" if ladder down pattern
    */
    function ladderNote($serial_number) {
        $ladderDigits = str_split($serial_number);
        $isLadderUp = true;
        $isLadderDown = true;
    
        // loop to iterartes through the serial number
        for ($i = 0; $i < count($ladderDigits) - 1; $i++) {
            $difference = $ladderDigits[$i] - $ladderDigits[$i + 1];
            
            if ($difference !== 1) {
                $isLadderDown = false;
            }
            
            if ($difference !== -1) {
                $isLadderUp = false;
            }
        }
    
        if ($isLadderUp) {
            return "Ladder up note";
        } elseif ($isLadderDown) {
            return "Ladder down note";
        } 
    }

    /**
    * function to check Ladder Up-Down note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool "Ladder Up-Down note" if pattern matched, false otherwise
    */
    function ladderUpDownNote($serial_number){
        $original_serial_number = $serial_number;
        $largestDigit = 0;

        // loop to find the biggest digit in serial number
        // reference: https://www.geeksforgeeks.org/largest-and-smallest-digit-of-a-number/
        while ($serial_number){
            $temp = $serial_number % 10;
            $largestDigit = max($temp, $largestDigit);
            $serial_number = intval($serial_number / 10);
        }

        $serialNumber_String = strval($original_serial_number); // reference: https://www.php.net/manual/en/function.strval.php
        $indexOfLargest = strpos($serialNumber_String, $largestDigit); // reference: https://www.php.net/manual/en/function.strpos.php

        $isValidUp = false;
        $isValidDown = false;

        // check for ladder up pattern
        for ($i = 0; $i < $indexOfLargest; $i++){
            if (intval($serialNumber_String[$i]) + 1 === intval($serialNumber_String[$i + 1]) && 
                $serialNumber_String[$i] !== $serialNumber_String[$i + 1]){
                $isValidUp = true;
                break;
            }
        }

        // check for ladder down pattern
        for ($i = $indexOfLargest; $i < strlen($serialNumber_String) - 1; $i++){
            if (intval($serialNumber_String[$i]) - 1 === intval($serialNumber_String[$i + 1]) && 
                $serialNumber_String[$i] !== $serialNumber_String[$i + 1]){
                $isValidDown = true;
                break;
            }
        }

        // loop to check if two consecutive digits are same and if found it returns false
        for ($i = 0; $i < strlen($serialNumber_String) - 1; $i++){
            if ($serialNumber_String[$i] === $serialNumber_String[$i + 1]) {
                return false; // not a ladder note
            }
        }

        if ($isValidUp && $isValidDown) {
            return "Ladder Up-Down note";
        }
    }

    /**
    * function to check Ladder Down-Up note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool "Ladder Down-Up note" if pattern matched, false otherwise
    */
    function ladderDownUpNote($serial_number){
        $original_serial_number = $serial_number;
        $smallestDigit = 9;
    
        while ($serial_number){
            $temp = $serial_number % 10;
            $smallestDigit = min($temp, $smallestDigit);
            $serial_number = intval($serial_number / 10);
        }
    
        $serialNumber_String = strval($original_serial_number);
        $indexOfSmallest = strpos($serialNumber_String, $smallestDigit);
    
        $isValidUp = false;
        $isValidDown = false;
    
        // check for ladder down pattern
        for ($i = 0; $i < $indexOfSmallest; $i++){
            if (intval($serialNumber_String[$i]) - 1 === intval($serialNumber_String[$i + 1]) && 
                $serialNumber_String[$i] !== $serialNumber_String[$i + 1]){
                $isValidDown = true;
                break;
            }
        }
    
        // check for ladder up pattern
        for ($i = $indexOfSmallest; $i < strlen($serialNumber_String) - 1; $i++){
            if (intval($serialNumber_String[$i]) + 1 === intval($serialNumber_String[$i + 1]) && 
                $serialNumber_String[$i] !== $serialNumber_String[$i + 1]){
                $isValidUp = true;
                break;
            }
        }
    
        // loop to check if two consecutive digits are same and if found it returns false
        for ($i = 0; $i < strlen($serialNumber_String) - 1; $i++){
            if ($serialNumber_String[$i] === $serialNumber_String[$i + 1]) {
                return false; // not a ladder note
            }
        }
    
        if ($isValidUp && $isValidDown) {
            return "Ladder Down-Up note";
        }
    }
    
    /**
    * function to check Rotator note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool "Rotator Note" if pattern found, false if not
    */
    function rotatorNote($serial_number){
        $serialNumber_String = strval($serial_number);
    
        // define the rotation map
        $rotationMap = [
            '0' => '0',
            '1' => '1',
            '6' => '9',
            '8' => '8',
            '9' => '6',
        ];
    
        $reversedSerial = '';
    
        // reverse the serial number
        for ($i = strlen($serialNumber_String) - 1; $i >= 0; $i--){
            $digit = $serialNumber_String[$i];
            if (!isset($rotationMap[$digit])) {
                return false; // not a valid rotator note
            }
            $reversedSerial .= $rotationMap[$digit];
        }
    
        //check if the reversed serial number is the same as the original
        if ($reversedSerial === $serialNumber_String) {
            return "Rotator Note";
        } else {
            return false;
        }
    }
    
    /**
    * function to check Binary note
    * @param string $serial_number The user entered serial number to check pattern
    * @return bool true if pattern matched, false otherwise
    */
    function binaryNote($serial_number){
        $binary_digit = [0,1];
        $temp = str_split($serial_number);
        return ((empty(array_diff($temp,  $binary_digit))) && strlen($serial_number) > 0); // reference: https://www.php.net/manual/en/function.array-diff.php
    }

    /**
    *function to check Radar note
    * @param string $serial_number The user entered serial number to check pattern
    * @return array An array containing categories of all the patterns that have been found
    */
    // function to store and print results
    function noteCategory($serial_number){

        $categories = []; //stores returned from functions
        $serial_number = substr($serial_number, 3); //ignores first three letters

        if (binaryNote($serial_number)){
            $categories[] = "Binary note";
        }

        if (ladderUpDownNote($serial_number)){
            $categories[] = "Ladder Up-Down note";
        }

        if (ladderDownUpNote($serial_number)){
            $categories[] = "Ladder Down-Up note";  
        }

        if (solidNote($serial_number)){
            $categories[] = "Solid note";
        } elseif (radarNote($serial_number)){
            $categories[] = "Radar note";
        }
        
        $ladderNoteResult = ladderNote($serial_number);
        
        if ($ladderNoteResult === "Ladder up note"){
            $categories[] = "Ladder up";
        } elseif ($ladderNoteResult === "Ladder down note"){
            $categories[] = "Ladder down";
        }

        if (rotatorNote($serial_number)){
            $categories[] = "Rotator note";
        }
        return $categories;
        
    }
    
?>