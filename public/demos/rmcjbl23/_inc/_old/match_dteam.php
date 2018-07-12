<?php
require('../connect.php');
$conn = new connect();
/*
$sql = "select if(count(*)=0,'same','different') from (
select id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc
from dreamteam_selection
where ( id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc ) not in
( select id_gardiens, id_defenseurs, id_milieux, id_attaquants
  from selections )
union
select id_gardiens, id_defenseurs, id_milieux, id_attaquants
from selections
where id_joueurs=1 AND ( id_gardiens, id_defenseurs, id_milieux, id_attaquants ) not in
( select id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc
  from dreamteam_selection )
) minusintersec";

$sql = "select  *,count(*)  from (
select id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc
from dreamteam_selection
where  ( id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc )  in
( select id_gardiens, id_defenseurs, id_milieux, id_attaquants
  from selections where id_joueurs=1)
union
select id_gardiens, id_defenseurs, id_milieux, id_attaquants
from selections
where ( id_gardiens, id_defenseurs, id_milieux, id_attaquants )  in
( select id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc
  from dreamteam_selection where id_dt_slc=1)
) minusintersec";
*/

$sql="SELECT id_dt_slc FROM dreamteam_selection
WHERE (id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc)  IN (
    SELECT  id_gardiens, id_defenseurs, id_milieux, id_attaquants FROM selections WHERE id_joueurs=100001)";

$query = $conn->execute_query($sql);
$res=array();

while ($arr= mysql_fetch_assoc($query)){
  //echo count($arr);
  //echo '<br/>';

  foreach($arr as $key => $val){
    echo $key.' / '.$val;
    echo '<br/>';
    array_push($res,$val);
  }

}
//print_r($res);
$class = array_count_values($res);
uasort($class, 'cmp');
print_r($class); // le premier element du tableau coorespond le mieux


function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

/*
$arr = mysql_fetch_row($query);
print_r($arr);
echo '------------------------------------------------'.'<br/>';
  print_r(array_count_values($arr));
*/
?>
