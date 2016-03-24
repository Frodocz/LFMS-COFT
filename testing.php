<?php

include('connect.php');
$currentMonth = date("m");
$currentYear = date("Y");
$num_days = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

for ($i=0;$i<$num_days;$i++){
    $days[$i]=$i+1;
}

    $sql_money = "SELECT fl.facility_name, bl.starttime, bl.fee
                  FROM booking_list bl
                  INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id
                  WHERE bl.type = 'book' AND bl.approved = 1 AND bl.starttime>".strtotime(date('Y-m-01 00:00:00'))." AND bl.endtime <=".strtotime(date('Y-m-t 23:59:59'));
    $query_money = mysqli_query($db,$sql_money);
    $num_money = mysqli_num_rows($query_money);

    for ($j=0;$j<$num_money;$j++){
        $money = mysqli_fetch_assoc($query_money);
        for ($i=0;$i<$num_days;$i++){
            $today = $currentYear.'-'.$currentMonth.'-'.$days[$i];
            if (strtotime(date("Y-m-d",$money['starttime'])) == strtotime($today)) {
                $income[$i] += $money['fee'];
            } else {
                $income[$i] += 0;
            }
        }
    }
    for ($k=0; $k<$num_days; $k++){
        $data = array(
            'income' => $income,
            'days' => $days
        );
    }
    echo json_encode($data);
?>