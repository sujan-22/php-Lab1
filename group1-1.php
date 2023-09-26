<?php
$serial_number = $_GET['serial_number'];

    function radarNote($serial_number){
        return ((strrev($serial_number) === $serial_number) && (strlen($serial_number) > 0));
    }

    function ladderNote($serial_number) {
        // Remove non-numeric characters
        $numeric_serial_number = preg_replace("/[^0-9]/", "", $serial_number);
    
        $digits = str_split($numeric_serial_number);
    
        $length = count($digits);
    
        if ($length < 2) {
            return "Not a Ladder Number";
        }
    
        $increasing = true;
        $decreasing = true;
    
        // Check if the sequence is strictly increasing
        for ($i = 1; $i < $length; $i++) {
            if ($digits[$i] <= $digits[$i - 1]) {
                $increasing = false;
                break;
            }
        }
    
        // Check if the sequence is strictly decreasing
        for ($i = 1; $i < $length; $i++) {
            if ($digits[$i] >= $digits[$i - 1]) {
                $decreasing = false;
                break;
            }
        }
    
        if ($increasing) {
            return "Ladder up note";
        } elseif ($decreasing) {
            return "Ladder down note";
        } else {
            // Check if it's a ladder up-down or ladder down-up pattern
            $up_found = false;
            $down_found = false;
    
            for ($i = 1; $i < $length; $i++) {
                if ($digits[$i] > $digits[$i - 1]) {
                    $up_found = true;
                } elseif ($digits[$i] < $digits[$i - 1]) {
                    $down_found = true;
                }
    
                if ($up_found && $down_found) {
                    return "Ladder Up-Down note";
                }
            }
    
            return "Not a Ladder Number";
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

        $ladderNoteResult = ladderNote($serial_number);

        if ($ladderNoteResult === "Ladder up note"){
            $categories[] = "Ladder up";
        } elseif ($ladderNoteResult === "Ladder down note"){
            $categories[] = "Ladder down";
        } elseif ($ladderNoteResult === "Ladder Up-Down note"){
            $categories[] = "Ladder Up-Down note";
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