<? header("content-type:text/html; charset=UTF-8");

 include('../../lib/db_connect.php');
 $connect=dbconn(); //DB컨넥트
 $member=member(); //회원정보

if(!$member[user_id])Error('로그인 후 이용해 주세요.');
$no=$_GET[no];

$query="select * from bbs1 where no='$no' and user_id='$member[user_id]' ";
$result= mysql_query($query, $connect);
$data= mysql_fetch_array($result);
if(!$result)die("연결에 실패 하였습니다.".mysql_error());

if($data[file01]){
$qy = "update bbs1 set
 file01=''
 where no='$no' and user_id='$data[user_id]' ";
 mysql_query($qy, $connect);

$del_file= "./data/".$data[file01];
if($data[file01] && is_file($del_file)) unlink($del_file);
}


mysql_close;
?>

<script language="JavaScript">
alert('파일이 삭제 되었습니다.');
opener.location.reload();
window.close();
</script>