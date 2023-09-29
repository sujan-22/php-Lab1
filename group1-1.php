<?php
$serial_number = $_GET['serial_number'];

    function radarNote($serial_number){
        return ((strrev($serial_number) === $serial_number) && (strlen($serial_number) > 0));
    }

    function ladderNote($serial_number) {
        $ladderDigits = str_split($serial_number);
        $isLadderUp = true;
        $isLadderDown = true;
    
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
        $rotatable_digits = ['0', '1', '6', '8', '9'];

        for ($i=0; $i < strlen($serial_number) / 2; $i++) { 
            $first_digit = $serial_number[$i];
            $last_digit = $serial_number[strlen($serial_number) - 1 - $i];

            if ($first_digit === '6' && $last_digit === '9'){
                return true;
            } if ($first_digit === '9' && $last_digit === '6'){
                return true;
            } if ($first_digit === '0' && $last_digit === '0'){
                return true;
            } if ($first_digit === '1' && $last_digit === '1'){
                return true;
            } if ($first_digit === '8' && $last_digit === '8'){
                return true;
            }
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
        if (binaryNote($serial_number)){
            $categories[] = "Binary note";
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
        } elseif ($ladderNoteResult === "Ladder Up-Down note"){
            $categories[] = "Ladder Up-Down note";
        } elseif ($ladderNoteResult === "Ladder Down-Up note"){
            $categories[] = "Ladder Down-Up note";
        }
        if (rotatorNote($serial_number)){
            $categories[] = "Rotator note";
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