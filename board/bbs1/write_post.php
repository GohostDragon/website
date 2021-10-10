<?header("content-type:text/html; charset=UTF-8");

include("../../lib/db_connect.php");
$connect= dbconn(); //DB컨넥트
$member=member(); //회원정보

if(!$member[user_id])Error("로그인 후 이용해 주세요.");

 $id= $_POST[id];  //게시판 ID
 $user_id=$_POST[user_id];  //회원 USER_ID
 $nick_name=$_POST[nick_name]; //닉네임
 $subject=$_POST[subject]; //게시판 제목
 $story=$_POST[story]; //게시판 내용
 
 if($_FILES[file01][name]){
 $size= $_FILES['file01']['size'];
    if($size > 2097152) Error('파일용량:2MB 제한합니다.'); 

$file01_name=strtolower($_FILES['file01']['name']); //파일명과 확장자를 소문자로 변경
 $file01_split= explode(".",$file01_name);   // 파일명과 확장자를 분리

  $extexplode= $file01_split[count($file01_split)-2.3]; //파일명만 가져오기
  $file01_type= $file01_split[count($file01_split)-1]; // 확장자만 가져오기

$img_ext= array('jpg','jpeg','gif','png'); //이미지 확장자 종류를 배열에 넣는다.
  if(array_search($file01_type, $img_ext) === false)Error('이미지 파일이 아닙니다.');

 $tates= date("mdhis", time());  //날짜 (월,일,시간,분,초)
 $newfile01= chr(rand(97,122)).chr(rand(97,122)).$tates.rand(1,9).rand(1,9).".".$file01_type; //파일명 생성;

 $dir="./data/";  //업로드할 디렉터리 지정
 move_uploaded_file($_FILES['file01']['tmp_name'],$dir.$newfile01); //파일업로드;
  chmod($dir.$newfile01,0777);
 }
 
if(!$subject)Error('제목을 입력하세요.');
if(!$story)Error('내용을 입력하세요.');

 
 $regdate=date("YmdHis", time()); //날짜 , 시간
 $ip=getenv("REMOTE_ADDR"); //ip
 $level=$member[level];   //회원 레벨 3=일반 2=관리자 1=최고관리자



//쿼리전송
$query="insert into bbs1(id, user_id, nick_name, subject, story, level, file01, regdate, ip) 
                   values('$id','$user_id','$nick_name','$subject','$story','$level','$newfile01','$regdate','$ip')";
mysql_query("set names utf8", $connect);
mysql_query($query, $connect);

mysql_close; //끝내기.
?>

<script>
window. alert('글 작성이 완료되었습니다.');
location.href='./list.html';
</script>