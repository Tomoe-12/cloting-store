<?php 

function update1($a,$b,$c){ 
    include("connection.php");
$con->query("UPDATE orderhistory set admindec='$a' ,quantity='$c' where his_id='$b'");    
} 
function update2($x,$y){
    include("connection.php");
$con->query("UPDATE closet set instock='$x' where clo_id='$y'");    
}

function update3($d,$e,){ 
    include("connection.php");
$con->query("UPDATE orderhistory set admindec='$d'  where his_id='$e'");    
} 

function update($a,$b){ 
    include("connection.php");
$con->query("UPDATE closet set instock='$a' where clo_id='$b'");    
} 
function profileimgvalidate($user_id){
    include("connection.php");
$result=$con->query("SELECT * FROM customers  WHERE cus_id=$user_id");
if(!empty($result)&& $result->num_rows>0){
 if($row=$result->fetch_assoc()){
        if(empty($row["per_img"])){
return false;
        }
        if(isset($row["per_img"])){
            return true;
        }
  }}
}

function sizeupdate($xxx,$left,$clo_id){
    include("connection.php");
$con->query("UPDATE size set $xxx=$left  where clo_Id=$clo_id");  

}

function removeitemfromcart($xxx,$yyy,$clo_id){ 
    include("connection.php");

    $result=$con->query("SELECT $xxx,clo_id from size  where clo_Id=$clo_id");
    if(!empty($result)&& $result->num_rows>0){
     if($row=$result->fetch_assoc()){ 
 $left= $row[$xxx]+$yyy;
 
echo $row[$xxx];
echo $left;

sizeupdate($xxx,$left,$row["clo_id"]); 
  

     }}

    }
function sizeretri($xxx,$yyy,$clo_id){ 
    include("connection.php");

    $result=$con->query("SELECT $xxx,clo_id from size  where clo_Id=$clo_id");
    if(!empty($result)&& $result->num_rows>0){
     if($row=$result->fetch_assoc()){ 
 $left= $row[$xxx]-$yyy;
 
echo $row[$xxx];
echo $left;

sizeupdate($xxx,$left,$row["clo_id"]); 
  

     }}

    }
    
function sizequantity($xxx,$clo_id){ 
    include("connection.php");

    $result=$con->query("SELECT $xxx,clo_id from size  where clo_Id=$clo_id");
    if(!empty($result)&& $result->num_rows>0){
     if($row=$result->fetch_assoc()){ 
   return $row[$xxx];
 



  

     }}

    }
    function cartnoti($cus_id){
        include("connection.php");
        $count=0;
        $result=$con->query("SELECT *  from cart  where cus_id=$cus_id");
        if(!empty($result)&& $result->num_rows>0){
         while($row=$result->fetch_assoc()){
$count++;
    }
    return $count;
}}
function insertorder($clo_id,$cus_id,$quantity,$size,$orderprice){
    include("connection.php");
    $con->query("INSERT INTO orderhistory (clo_id,cus_id,quantity,size,orderprice,admindec) values ('$clo_id','$cus_id','$quantity','$size','$orderprice','Pending')");
}
function movtoorder($user_id){
    include("connection.php");
   
    $result=$con->query("SELECT *  from cart  where cus_id=$user_id");
    if(!empty($result)&& $result->num_rows>0){
        $count=0;
     while($row=$result->fetch_assoc()){
    insertorder($row["clo_id"],$row["cus_id"],$row["quantity"],$row["size"],$row["orderprice"]);
$count++;
     }}
     echo $count;
}


function deletcartcartid($cart_id){
    include("connection.php");
    $con->query("DELETE from cart where cart_id='$cart_id'");
}
function deletcart($user_id){
    include("connection.php");
    $con->query("DELETE from cart where cus_id='$user_id'");
}
    function emailout($user_id){
        include("connection.php");
   
        $result=$con->query("SELECT *  from customers  where cus_id=$user_id");
        if(!empty($result)&& $result->num_rows>0){
            $count=0;
         if($row=$result->fetch_assoc()){
   return $row["email"];
    }}}
    function usernameout($user_id){
        include("connection.php");
   
        $result=$con->query("SELECT *  from customers  where cus_id=$user_id");
        if(!empty($result)&& $result->num_rows>0){
            $count=0;
         if($row=$result->fetch_assoc()){
   return $row["user_name"];
    }}}
?>