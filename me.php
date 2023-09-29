<?php
    echo '<b><i>Sujan Rokad, 000882948</i></b>';
    // Check for ladder up pattern (e.g., 3456789)
        // if (preg_match('/^\d{0,9}$/', $serialNumber) && $serialNumber === implode('', range(min(str_split($serialNumber)), max(str_split($serialNumber))))) {
        //     return "Ladder up note";
        // }
    
        // Check for ladder down pattern (e.g., 9876543)
        // if (preg_match('/^\d{0,9}$/', $serial_number) && $serial_number === implode('', range(max(str_split($serial_number)), min(str_split($serial_number))))) {
        //     return "Ladder down note";
        // }

        
        // // Check for ladder up-down pattern (e.g., 4567654)
        // $digits = str_split($serialNumber);
        // $length = count($digits);
        // $increasing = false;
        // $decreasing = false;

        // for ($i = 1; $i < $length; $i++) {
        //     if ($digits[$i] > $digits[$i - 1]) {
        //         $increasing = true;
        //     } elseif ($digits[$i] < $digits[$i - 1]) {
        //         $decreasing = true;
        //     }

        //     if ($increasing && $decreasing) {
        //         return "Ladder up-down note";
        //     }
        // }

        // // Check for ladder down-up pattern (e.g., 7654567)
        // $reversedSerialNumber = strrev($serialNumber);
        // if (
        //     preg_match('/^\d{0,9}$/', $serialNumber) &&
        //     preg_match('/^\d*(\d)(?:\d*\1)+\d*$/', $serialNumber) &&
        //     preg_match('/^\d*(\d)(?:\d*\1)+\d*$/', $reversedSerialNumber)
        // ) {
        //     return "Ladder down-up note";
        // }
        
        // return "Not a Ladder Number";
?>    