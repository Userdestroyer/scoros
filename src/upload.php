<?php
if(isset($_POST['submit'])){
    if(isset($_FILES["firstFile"]["tmp_name"]) || isset($_FILES["secondFile"]["tmp_name"])){
        if (move_uploaded_file($_FILES["firstFile"]["tmp_name"], '../input/1.txt')) {
            if(move_uploaded_file($_FILES["secondFile"]["tmp_name"], '../input/2.txt')){

                $firstArray = explode(",",file_get_contents('../input/1.txt'));
                $secondArray = explode(",",file_get_contents('../input/2.txt'));
                
                separate($firstArray, $secondArray, '1');
                separate($secondArray, $firstArray, '2');

                unlink('../input/1.txt');
                unlink('../input/2.txt');

                echo "The files have been processed.";
                echo '<br><a href="./output/1.txt" download>1st file</a><br>
                <a href="./output/2.txt" download>2nd file</a><br><br>';
            }
        } else {
            echo "Sorry, there was an error uploading your files";
        }
    }
    $_POST['submit'] = null;
}

//ALGORHITM
function separate($mainArray, $secArray, $filename) {

    $output = [];
    $i = 0;
    $j = 0;
        while($i<count($mainArray)){
        //COMPARISON
        $compare = strcmp($mainArray[$i], $secArray[$j]);

        switch(true){
            //if main is less than second
            case $compare<0:
                array_push($output, $mainArray[$i]);
                $i++;
            break;
            //if main more than second
            case $compare>0:
                if($j<(count($secArray)-1)){
                    $j++;
                } else {
                    array_push($output, $mainArray[$i]);
                    $i++;
                }
            break;
            //if equal, continue
            case $compare === 0:
                $i++;
                if($j<(count($secArray)-1)){$j++;} 
            break;
        }
    }
    file_put_contents("../output/" . $filename . ".txt", implode(",",$output));
    return;
}
?>
<a href="/index.php">Back</a>