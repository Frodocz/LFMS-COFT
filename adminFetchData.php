<?php 
  session_start(); 

include_once('connect.php');

$action = $_GET['action'];
switch ($action) {
    //User approved/unapproved
    case 'user':
        userStatus($db);
        break;
    //User internal/external
    case 'user2':
        userComp($db);
        break;
    // This month's daily income
    case 'd_money':
        dailyMoney($db);
        break;
    // This month's facility income
    case 'f_money':
        facilityMoney($db);
        break;
    // This month's facility booking/visiting condition
    case 'book':
        book($db);
        break;
    default:
        break;
}

function getFacilityName($db)
{
    $sql = "SELECT fl.facility_name FROM facility_list fl";
    $result=mysqli_query($db,$sql);
    while($facility = mysqli_fetch_assoc($result)){
        $categories[] = $facility['facility_name'];
    }
    $data = array('facility'=>$categories);
    return $data;
}

function userStatus($db) {
    $sql_userA = "SELECT user_id FROM normal_user WHERE approved=1";
    $sql_userN = "SELECT user_id FROM normal_user WHERE approved=0";
    $query_userA = mysqli_query($db,$sql_userA);
    $query_userN = mysqli_query($db,$sql_userN);
    $num_userA = mysqli_num_rows($query_userA);
    $num_userN = mysqli_num_rows($query_userN);
    $data[] = array(
        'value' => $num_userN,
        'name' => "Non-approved"
    );
    $data[] = array(
        'value' => $num_userA,
        'name' => "Approved"
    );
    echo json_encode($data);
}

function userComp($db) {
    $sql = "SELECT faculty AS name, COUNT(*) AS value FROM normal_user GROUP BY faculty";
    $query = mysqli_query($db,$sql);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
}

function dailyMoney($db){
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
}

function facilityMoney($db) {
    $facility = getFacilityName($db);
    $num_facility = sizeof($facility['facility']);

    $sql_money = "SELECT fl.facility_name, SUM(bl.fee) AS fee_sum
                  FROM booking_list bl
                  INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id
                  WHERE bl.type = 'book' AND bl.starttime > ".strtotime(date('Y-m-01 00:00:00'))." AND bl.endtime <=".strtotime(date('Y-m-t 23:59:59'))."
                  GROUP BY fl.facility_id";
    $query_money = mysqli_query($db,$sql_money);
    $num_money = mysqli_num_rows($query_money);

    for ($i=0; $i<$num_money; $i++) {
        $money = mysqli_fetch_assoc($query_money);
        for ($j=0; $j<$num_facility; $j++) {
            if ($income[$j] == 0) {
                if($facility['facility'][$j] == $money['facility_name']){
                    $income[$j] = intval($money['fee_sum']);
                } else {
                    $income[$j] = 0;
                }
            }
        }
    }
    for ($k=0; $k<$num_facility; $k++){
        $data[] = array(
            'value' => $income[$k],
            'name' => $facility['facility'][$k]
        );
    }
    $result = array(
        'categories' => $facility['facility'],
        'data' => $data
    );
    echo json_encode($result);
}

function book($db) {
    // Get all the current avaliable facilities
    $facility = getFacilityName($db);
    $num_facility = sizeof($facility['facility']);

    $sql_book = "SELECT fl.facility_name,COUNT(TB1.booking_id) AS bookNumber 
                    FROM (SELECT * FROM booking_list bl WHERE bl.type='book' AND bl.approved = 1 AND bl.starttime > ".strtotime(date('Y-m-01 00:00:00'))." AND bl.endtime <=".strtotime(date('Y-m-t 23:59:59')).") TB1 
                    LEFT JOIN facility_list fl
                    ON TB1.facility_id=fl.facility_id
                    GROUP BY facility_name";
    $query_book = mysqli_query($db, $sql_book);
    $num_book = mysqli_num_rows($query_book);
    
    for ($i=0; $i<$num_book; $i++) {
        $book = mysqli_fetch_assoc($query_book);
        for ($j=0; $j<$num_facility; $j++) {
            if ($b_number[$j] == 0) {
                if($facility['facility'][$j] == $book['facility_name']){
                    $b_number[$j] = intval($book['bookNumber']);
                } else {
                    $b_number[$j] = 0;
                }
            }
        }
    }

    $sql_visit = "SELECT fl.facility_name,COUNT(TB1.booking_id) AS bookNumber 
                    FROM (SELECT * FROM booking_list bl WHERE bl.type='visit' AND bl.approved = 1 AND bl.starttime > ".strtotime(date('Y-m-01 00:00:00'))." AND bl.endtime <=".strtotime(date('Y-m-t 23:59:59')).") TB1 
                    LEFT JOIN facility_list fl
                    ON TB1.facility_id=fl.facility_id
                    GROUP BY facility_name";
    $query_visit = mysqli_query($db, $sql_visit);
    $num_visit = mysqli_num_rows($query_visit);
    
    for ($i=0; $i<$num_visit; $i++) {
        $visit = mysqli_fetch_assoc($query_visit);
        for ($j=0; $j<$num_facility; $j++) {
            if ($v_number[$j] == 0) {
                if($facility['facility'][$j] == $visit['facility_name']){
                    $v_number[$j] = intval($visit['bookNumber']);
                } else {
                    $v_number[$j] = 0;
                }
            }
        }
    }
    $data = array(
        'categories' => $facility['facility'],
        'book' => $b_number,
        'visit' => $v_number
    );
    echo json_encode($data);
}
?>