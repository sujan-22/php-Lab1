<?php
$serial_number = $_GET['serial_number'];

    function radarNote($serial_number){
        return ((strrev($serial_number) === $serial_number) && (strlen($serial_number) > 0));
    }

    function ladderNote($serialNumber) {
        // Check for ladder up pattern (e.g., 3456789)
        if (preg_match('/^\d{0,9}$/', $serialNumber) && $serialNumber === implode('', range(min(str_split($serialNumber)), max(str_split($serialNumber))))) {
            return "Ladder up note";
        }
    
        // Check for ladder down pattern (e.g., 9876543)
        if (preg_match('/^\d{0,9}$/', $serialNumber) && $serialNumber === implode('', range(max(str_split($serialNumber)), min(str_split($serialNumber))))) {
            return "Ladder down note";
        }
    
        // Check for ladder up-down pattern (e.g., 4567654)
        $digits = str_split($serialNumber);
        $length = count($digits);
        $increasing = false;
        $decreasing = false;

        for ($i = 1; $i < $length; $i++) {
            if ($digits[$i] > $digits[$i - 1]) {
                $increasing = true;
            } elseif ($digits[$i] < $digits[$i - 1]) {
                $decreasing = true;
            }

            if ($increasing && $decreasing) {
                return "Ladder up-down note";
            }
        }

        // Check for ladder down-up pattern (e.g., 7654567)
        $reversedSerialNumber = strrev($serialNumber);
        if (
            preg_match('/^\d{0,9}$/', $serialNumber) &&
            preg_match('/^\d*(\d)(?:\d*\1)+\d*$/', $serialNumber) &&
            preg_match('/^\d*(\d)(?:\d*\1)+\d*$/', $reversedSerialNumber)
        ) {
            return "Ladder down-up note";
        }
        
        return "Not a Ladder Number";
    }
   
    function solidNote($serial_number){
        $solid_digit = '1';
        $temp1 = str_split($serial_number);
        foreach($temp1 as $digit){
            if ($digit !== $solid_digit){
                return false;
            }
        } return !empty($serial_number);
    }

    function rotatorNote($serial_number){
        // Define the digits that can rotate
        $rotatable_digits = [0, 1, 6, 8, 9];
    
        // Convert the serial number to an array of digits
        $digits = str_split($serial_number);
    
        // Create a mapping of digits that can rotate to their rotated counterparts
        $rotation_map = [
            '0' => '0',
            '1' => '1',
            '6' => '9',
            '8' => '8',
            '9' => '6',
        ];
    
        // Initialize the rotated serial number
        $rotated_serial_number = '';
    
        // Iterate through the digits and check if they can be rotated
        foreach ($digits as $digit) {
            if (!in_array($digit, $rotatable_digits)) {
                // If a non-rotatable digit is found, it's not a rotator note
                return "Not a Rotator Note";
            }
            // Append the rotated digit to the rotated serial number
            $rotated_serial_number .= $rotation_map[$digit] ?? $digit;
        }
    
        // Reverse the rotated serial number and check if it's the same as the original
        if (strrev($rotated_serial_number) === $serial_number) {
            return "Rotator note";
        } else {
            return "Not a Rotator Note";
        }
    }
    
    function binaryNote($serial_number){
        $binary_digit = [0,1];
        $temp3 = str_split($serial_number);
        return ((empty(array_diff($temp3,  $binary_digit))) && strlen($serial_number) > 0);
    }

    function noteCategory($serial_number){

        $categories = [];
        $serial_number = substr($serial_number, 3);
        if (radarNote($serial_number)){
            $categories[] = "Radar note";
        }
        if (binaryNote($serial_number)){
            $categories[] = "Binary note";
        }
        if (solidNote($serial_number)){
            $categories[] = "Solid note";
        }
        if (rotatorNote($serial_number)){
            $categories[] = "Rotator note";
        }

        $ladderNoteResult = ladderNote($serial_number);

        if ($ladderNoteResult === "Ladder up note"){
            $categories[] = "Ladder up";
        } elseif ($ladderNoteResult === "Ladder down note"){
            $categories[] = "Ladder down";
        } elseif ($ladderNoteResult === "Ladder Up-Down note"){
            $categories[] = "Ladder Up-Down note";
        } elseif ($ladderNoteResult === "Ladder Down-Up note"){
            $categories[] = "Ladder Down-Up note";
        }
        return $categories;
        
    }

    if (isset($_GET['serial_number'])) {
        $serial_number = $_GET['serial_number'];
        $categories = noteCategory($serial_number);
        if (empty($serial_number)) {
            echo "Please enter a serial number!!";
        }
        else {
            if (!empty($categories)){
                foreach($categories as $category){
                    echo "<li>$category</li>";
                }
            }  
            else {
            echo "<ul>";
            echo "<li>Uninteresting serial number</li>";
            echo "</ul>";
            }
        }
    }

?>