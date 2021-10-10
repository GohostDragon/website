<?header("content-type:text/html; charset=UTF-8");  
   include '../lib/db_connect.php';
   $connect=dbconn();

$id=$_POST[id];
$user_id=$_POST[user_id];
$nick_name=$_POST[nick_name];
$email=$_POST[email]; 
$pws=$_POST[pw]; 

if(!$user_id)Error("아이디를 입력하세요.");
if(substr($user_id,"12"))Error("회원아이디는 12자 까지만 허용됩니다.");
if(preg_match("/[^a-z 0-9]/",$user_id))Error("아이디는 영문소문자와 숫자만 가능합니다."); 

if(!$pws)Error("비밀번호를 입력하세요.");
$pw=md5($pws);  //비밀번호 암호화

$regdate=date("YmdHis", time()); //날짜 시간
$ip=getenv("REMOTE_ADDR"); //ip

$query="insert into member(id, user_id, nick_name, email, pw, regdate, ip)
values('$id', '$user_id', '$nick_name', '$email', '$pw', '$regdate', '$ip')";
mysql_query("set names utf8",$connect);
mysql_query($query,$connect);
mysql_close; //mysql끝내기
?>

<script>
window. alert('회원가입이 완료 되었습니다.');
location.href='../index.html';
</script>