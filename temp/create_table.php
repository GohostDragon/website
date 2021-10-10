<?header("content-type:text/html; charset=UTF-8");
 
echo "
<head>
<title>TEST홈페이지-DB 테이블생성</title>
</head>";
/* 
 Editing PHP: 박정원 PJW(Jimmy)  pjws0321@gmail.com  
 Editing  Blog  http://blog.naver.com/pjws0321
*/

 include ("../lib/db_connect.php");
 $connect= dbconn();


$sql="CREATE TABLE bbs1
     (no int not null auto_increment,
	 PRIMARY KEY(no),
	 id char(15),
	 level int,
	 user_id char(15),
	 name char(15),
	 nick_name char(15),
	 pw char(32),
	 subject char(150),
	 story text,
	 hit int,
	 regdate char(20),
	 ip char(20)
      )"; 

if(!$sql)die("테이블 생성에 실패 하였습니다.".mysql_error());

echo "<p>테이블이 정상적으로 생성 되었습니다.</p>"; 



//$sql="alter table bbs1 drop column level";  //필드 삭제
//$sql="drop table bbs1"; //테이블 삭제
//$sql="alter table member add level int";  //필드명과 타입 추가하기 
 $sql="alter table member add level int default '1' not null ";  //필드명과 타입 추가하기 기본값 주기
//$sql="alter table bbs1 change level level2 varchar(20)"; //필드명과 타입을 변경 할 수있습니다.
//$sql="alter table bbs1 modify level2 int"; //필드 타입만 변경하기
//$sql="alter table bbs1 rename bbs2";  //테이블 이름 변경

/*
$sql="SHOW TABLES FROM jungwon";
$result= mysql_query($sql);
if(!$result){
	echo "MySQL Error".mysql_error();
	exit;
} 
while($row=mysql_fetch_row($result)){
	echo "Table:".$row[0]."<br>";
}*/

if($sql)echo ("정상적으로 실행 되었습니다.");

mysql_query($sql,$connect);
?>