<?php
    $word = $_POST['ins'];
    $length = 6;

    if($_POST['trig'] == '0'){

        if(preg_match('/\s/', $word)){

            $split = preg_split("/\s+/", "$word");
            $acronym = "";
            
            foreach ($split as $s) {
              $acronym .= mb_substr($s, 0, 1);
            }
    
            if(strlen($acronym) <= $length){
                echo strtoupper($acronym);
            }
            else{
                $short = substr($acronym,0,$length);
                echo strtoupper($short);
            }
        }
        else{
            if(strlen($word) <= $length){
                echo strtoupper($word);
            }
            else{
                $short = substr($word,0,$length);
                echo strtoupper($short);
            }
        }

    }
?>
