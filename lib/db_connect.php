<?

function dbconn(){
$host_name="localhost"; //호스트 네임
$db_user_id="root"; //DB user id
$db_name="webdb"; // DB name
$db_pw="123456";  // DB  비번
$connect= mysql_connect($host_name,$db_user_id,$db_pw);
mysql_query("set names utf8",$connect);
mysql_select_db($db_name,$connect);
if(!$connect)die("연결에 실패 하였습니다.".mysql_error());
return $connect;
}

//에러메세지 출력
function Error($msg){
echo "
 <script>
 window.alert('$msg');
 history.back(1);
 </script>
 ";
 exit; //위에 에러 메세지만 뛰운다.
}

function member(){
global $connect;
$temps=$_COOKIE["COOKIES"];
$cookise= explode("//",$temps);

//////회원정보///////
$query= "select * from member where user_id='$cookise[0]' ";
mysql_query("set names ust8",$connect);
$result= mysql_query($query, $connect);
$member= mysql_fetch_array($result);
return $member;
}
?>