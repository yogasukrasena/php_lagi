<?php
/* ini kita include koneksi database */
include 'db.php';

/* tentukan table nya */
$table = content;

$hal = $_GET[hal];

/* jika page default nya 1 */
if(!isset($_GET['hal'])){
    $page = 1;
} else {
    $page = $_GET['hal'];
}

/* tentukan jumlah item per halaman */
$max_results = 5;

/* halaman di kali MAX jumlah item per halaman dikurangi MAX jumlah item per halaman */
/* logika: 1 x 5 = 5  ,  5 - 5 = 0   , jadi id database dimulai dari 0*/
$from = (($page * $max_results) - $max_results); 

/* tampilkan dari databse, LIMIT dari contuh diatas id dari 0 sampai 5 */
$sql = mysql_query("SELECT * FROM $table ORDER BY id DESC LIMIT $from, $max_results ");
while($row = mysql_fetch_array($sql)){

/* display result, ini tergantung table database mu */
?>
<?php echo $row[2] ?><br>
<?php echo $row[3] ?></a><br />
<?php echo $row[1] ?> | Halaman Ini dibaca <?php echo $row[6] ?> kali<br />
<?php echo $row[4]; ?>

<hr>
<?php
}
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM $table"),0);

$total_pages = ceil($total_results / $max_results);

/* bangun jumlah hiperlink halaman*/
echo "<center>Select a Page<br />";

/* bangun Previous link */
if($hal > 1){
    $prev = ($page - 1);
    echo "<a href=$_SERVER[PHP_SELF]?hal=$prev> <-Previous </a> ";
}

for($i = 1; $i <= $total_pages; $i++){
    if(($hal) == $i){
        echo "$i ";
        } else {
            echo "<a href=$_SERVER[PHP_SELF]?hal=$i>$i</a> ";
    }
}

/* bangun Next link */
if($hal < $total_pages){
    $next = ($page + 1);
    echo "<a href=$_SERVER[PHP_SELF]?hal=$next>Next-></a>";
}
echo "</center>";
?>