<?php
session_start();
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'project3';

//$connec = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
try{
  $conn = new PDO("mysql:host=$host;dname=$dbname", $username, $password);
}
catch(PDOException $e){
  echo $e;
}
// login
$logname = $_POST["logname"];
$logpass = sha1($_POST["logpass"]);

if(isset($logname) && isset($logpass)){
    $sql = "SELECT * FROM users WHERE username = '$logname' AND password = '$logpass';";
    $stmt = $conn->query($sql);
    $res = $stmt->fetch();
        
    if($res != null){
        $_SESSION["username"] = $res["username"];
        $_SESSION["user_id"] = $res["id"];
          echo "User Found";
    }
     else{
         echo "No User Found";
        }
    }
    
/*    
if($_SERVER['REQUEST_METHOD']==='POST'){
  //code for the user to be added
  $f_name = $_POST["firstname"];
  $l_name = $_POST["lastname"];
  $u_name = $_POST["username"];
  $pword = hash('password1234',$_POST["password"]);


  // code for the mail to be sent
  $senr = $_POST["sender"];
  $subj = $_POST["subject"];
  $body = $_POST["body"];
  $recps = $_POST["recipients"];
  
  if (isset($uname) && isset($pword) && isset($fname) && isset($lname)){
     $sql = "INSERT INTO users(firstname, lastname, username, password) VALUES('$fname', '$lname', '$uname', '$pword');";
     $stmt = $conn->query($sql);
     echo 'Successfilly Added User';
  }
  else if (isset($senr)&&isset($recps)){
    sendMail($senr, $recps, $subj, $body);
  }
  //send a message
  else if (isset($senr) && isset($recps) && isset($subj) && isset($body)){
    //get id of sender
    $stmt = $conn->query("SELECT id FROM users WHERE username = $senr");
    $m = $stmt->fetch();
    $sid = $m["id"];
    $cdate = date("Y/m/d");
    foreach($recps as $recp){
      //get id of receiver
             $stmt2 = $conn->query("SELECT id FROM users WHERE username = $recp");
             $s = $stmt2->fetch();
             $rid = $s["id"];
     
             // query to be sent
             $q = "INSERT INTO messages(recipient_id, user_id, subject, body, date_sent) VALUES('$sid', '$rid', '$subj', '$body', '$cdate');";
             $stmt3 = $conn->query($q);
         }
         
         echo 'Message Sent';
      }
  }

if ($_SERVER['REQUEST_METHOD']==='GET'){
  // user name to recieve mail
  $rcvr = $_GET["receiver"];
  if(isset($rcver)){
   /* getMail($rcvr);
  }
  
}
function getMail($rcvr){
  $stmt = $conn->query("SELECT * FROM messages WHERE recipient_id = $rcvr");
  $res = $stmt->fetchALL(PDO::ASSOC);
       $stmt = $conn->query("SELECT * FROM messages WHERE recipient_id = $rcvr");
       $res = $stmt->fetchAll(PDO::ASSOC);
  /*foreach($res as $mail){
    $arr = aray(
      "user_id" => $mail["user_id"],
      "subject" => $mail["subject"],
      "body"=>$mail["body"]
      );
        foreach($res as $mail){
          $arr = array(
             "user_id" => $mail["user_id"],
             "subject" => $mail["subject"],
             "body" => $mail["body"]
             );
      header('Content-type: application/json');
      echo json_encode($arr);
      
  }
*/
