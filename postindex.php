<?php
session_start();
ob_start();
error_reporting(1);
//echo phpversion();
$connect= new mysqli("localhost","root","","ndb");
if($_POST['insertdata'] == "insertdata")
{
    //print_r($_post);
    $insertString = "INSERT INTO `tbl`(`messagebody`,`fk_senderid`,`tech_reciver_ID`)
    VALUES ('".$_POST['messageBody']."','".$_SESSION['userID']."','".$_SESSION['receiverID']."')";
    $connect->query($insertString);
    if($connect->affected_rows == 1){
        $_SESSION['messageID'] = $connect->insert_id;
        $_SESSION['MysenderID'] = $_SESSION['userID'];
        //
        $output .= "<div id='moveposition'>";
        $output .="<div class='roundEdges right'>";
             // message and user n date
            $output .= "<div class='u_name_date'>";
                    $output .= "<p class='u_name'>".$_SESSION['u_name']."</p>";
                    $output .="<p class='chat__date'>".date('Y-m-d H:m:s')."</p>";
            $output .= "</div>";
            $output .="<div>";
                $output .="<p class='message__body'>".$_POST['messageBody'] ."</p>";
            $output .="</div>";
            // message and user n date ends here 
        $output .="</div>";
    $output .="</div>";
        ///

        if($_SESSION['userID'] == $_SESSION['receiverID'])
        {
            $array = array("state"=>"success","append"=>true,"message"=>$output);
        }else{
            $array = array("state"=>"success","append"=>false,"message"=>$output);
        }
        echo json_encode($array);
       
    }else{
            $array = array("state"=>"failed","message"=>"<p>Could not hit database<p>");
            echo json_encode($array);
    };
    
}else if($_POST['insertdata'] == "retrievevedata")
{
    if(empty($_SESSION['receiverID'])){ $_SESSION['receiverID'] = 3; }
$queryString = "SELECT * FROM `tbl` where  `fk_senderid` = '".$_SESSION['userID']."' AND `tech_reciver_ID` ='".$_SESSION['receiverID']."' OR `fk_senderid` = '".$_SESSION['receiverID']."' AND `tech_reciver_ID` ='".$_SESSION['userID']."' ORDER BY id ASC";
$runquery = $connect->query($queryString);
//echo $runquery->num_rows;
while($rows = $runquery->fetch_array())
{
    $output .= "<div id='moveposition'>";
        $output .="<div class='roundEdges";
            if($rows[fk_senderid] == $_SESSION['userID']){
                $output.=" right" ;
            }else{
                $output.=" left";
            }
            $str = "SELECT * FROM `table_users` where `user_id` = '".$rows['fk_senderid']."' ";
            $runq = $connect->query($str);
            $name = $runq->fetch_array();
            $output .= "'>";
             // message and user n date
            $output .= "<div class='u_name_date'>";
                    $output .= "<p class='u_name'>".$name['display_name']."</p>";
                   // $output .= "<img src='https://gp1.wac.edgecastcdn.net/802892/http_public_production/fans/images/4767426/original/crop:x0y0w200h266/hash:1466432826/957842604261580-1449864517.jpg?1466432826'/>";
                    $output .="<p class='chat__date'>".$rows['datesent']."</p>";
            $output .= "</div>";
            $output .="<div>";
                $output .="<p class='message__body'>".nl2br(str_replace(':fire','&#128540;',html_entity_decode($rows['messagebody']))) ."</p>";
            $output .="</div>";
            // message and user n date ends here 
        $output .="</div>";
    $output .="</div>";
}
echo $output;
//$array = array("state"=>"success","message"=>$output);
//echo json_econde($array);

}else if($_POST['insertdata'] == "readNonRead")
{
if(empty($_SESSION['receiverID'])){ $_SESSION['receiverID'] = 3; }
$queryString = "SELECT * FROM `tbl` where  `fk_senderid` = '".$_SESSION['userID']."' AND `tech_reciver_ID` ='".$_SESSION['receiverID']."' and status = 0 OR `fk_senderid` = '".$_SESSION['receiverID']."' AND `tech_reciver_ID` ='".$_SESSION['userID']."' and status = 0 ORDER BY id ASC";
$runquery = $connect->query($queryString);
$countarra = $runquery->num_rows;

    if( $countarra > 0)
    {
        while($rows = $runquery->fetch_array()){
            $output .= "<div id='moveposition'>";
                $output .="<div class='roundEdges";
                    if($rows[fk_senderid] == $_SESSION['userID']){
                        $output.=" right" ;
                    }else{
                        $output.=" left";
                    }
                    $str = "SELECT * FROM `table_users` where `user_id` = '".$rows['fk_senderid']."' ";
                    $runq = $connect->query($str);
                    $name = $runq->fetch_array();
                    $output .= "'>";
                     // message and user n date
                    $output .= "<div class='u_name_date'>";
                            $output .= "<p class='u_name'>".$name['display_name']."</p>";
                            //$output .= "<img src='https://gp1.wac.edgecastcdn.net/802892/http_public_production/fans/images/4767426/original/crop:x0y0w200h266/hash:1466432826/957842604261580-1449864517.jpg?1466432826'/>";
                            $output .="<p class='chat__date'>".$rows['datesent']."</p>";
                    $output .= "</div>";
                    $output .="<div>";
                        $output .="<p class='message__body'>".nl2br(str_replace(':fire','&#128540;',html_entity_decode($rows['messagebody']))) ."</p>";
                    $output .="</div>";
                    // message and user n date ends here 
                $output .="</div>";
            $output .="</div>";
        }
        $resetMessage = array("statusCount"=>"yes","Count"=>$countarra,"message"=>$output);
    }else{
        $resetMessage = array("statusCount"=>"no");
    }
    echo json_encode($resetMessage);
}else if($_POST['insertdata'] == "resetMessageStatusTo1")
{
if(empty($_SESSION['receiverID'])){ $_SESSION['receiverID'] = 3; }
$queryString = "UPDATE `tbl` SET status = 1 where  `fk_senderid` = '".$_SESSION['userID']."' AND `tech_reciver_ID` ='".$_SESSION['receiverID']."' AND `id` NOT IN (".$_SESSION['messageID'].") 
OR `fk_senderid` = '".$_SESSION['receiverID']."' AND `tech_reciver_ID` ='".$_SESSION['userID']."' AND `id` NOT IN (".$_SESSION['messageID'].") ORDER BY id ASC";
$runquery = $connect->query($queryString);

}else if($_POST['login'])
{
   
    $queryString = "SELECT * FROM `table_users` where `username`='".$_POST['username']."' AND `password`='".$_POST['password']."' AND `status` = 1 ";
    $runquery = $connect->query($queryString);
    $count = $runquery->num_rows;
    if($count == 1)
    {
        $row = $runquery->fetch_array();
        $_SESSION['userID'] = $row['user_id'];
        $_SESSION['u_name'] = $row['display_name'];
        $_SESSION['mof'] = $row['memberOf'];
        $_SESSION['receiverID'] = 3;
        $_SESSION['ChatID'] = date(Hms); 
        echo "welcome";
        
    }else{
        echo "invaliud username or password!";
    }
}else if (isset($_GET['users'])){
    $queryString = "SELECT * FROM `table_users`";
    $runquery = $connect->query($queryString);
//echo $runquery->num_rows;
while($rows = $runquery->fetch_array())
{
        $output .="<a href='../mychat/index.php?userid=".$rows['user_id']."&u_name=".$rows['display_name']."&memberOf=".$rows['memberOf']."'>".$rows['display_name']."</a><br/>";
}
echo $output;
}

?>
