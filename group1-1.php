    <?php
    $serial_number = $_GET['serial_number'];
        function radarNote($serial_number){
            return strrev($serial_number) === $serial_number && strlen($serial_number > 0);
        }
        
        function solidNote($serial_number){
            $solid_digit = [1];
            $temp1 = str_split($serial_number);
            return count(array_diff($temp1, $solid_digit)) === 0;
        }
        
        // function rotatorNote($serial_number){
        //     $rotator_digit = [0,1,6,8,9];
        //     $temp2 = str_split($serial_number);
        //     return foreach($temp2 as $digit){
        //         if (in_array($digit, $rotator_digit))
        //     }
        // }
        
        function binaryNote($serial_number){
            $binary_digit = [0,1];
            $temp3 = str_split($serial_number);
            return empty(array_diff($temp3,  $binary_digit));
        }

        // if (isset($_GET['serial_number'])) {
        //     $serial_number = $_GET['serial_number'];
        //     $answer2 = binaryNote($serial_number);
        //     echo $answer2;
        // } elseif ($serial_number === " ") {
        //     echo "Please provide a serial number.";
        // }

        function noteCategory($serial_number){
            $categories = [];
            if (radarNote($serial_number)){
                $categories[] = "Radar note";
            }
            if (binaryNote($serial_number)){
                $categories[] = "Binary note";
            }
            if (solidNote($serial_number)){
                $categories[] = "Solid note";
            }
            
            return $categories;
            
        }

        if (isset($_GET['serial_number'])) {
            $serial_number = $_GET['serial_number'];
            $categories = noteCategory($serial_number);
            if (!empty($categories)){
                // echo "<ul>";
                    foreach($categories as $category){
                        echo "<li>$category</li>";
                    }
                // echo "</ul>";
            } elseif (empty($categories)){
                echo "Uninteresting serial number";
            }
             else {
                echo "Please enter a serial number!!";
            }
        }

    ?>