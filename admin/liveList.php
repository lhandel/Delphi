<?php
include '../function.php';
header("Content-type: application/json; charset=ut8");

$c_id = $_SESSION["c_id"];
$result = get_services($c_id);

$return = array();

while($row = $result->fetch_assoc()){
    $return[] = array
                  (
                      's_id'          => $row['s_id'],
                      'ewt'           => ewt($row['s_id']),
                      'queue_count'   => $row['queue_count'],
                      'handler'       => $row['handler']
                  );
}

echo json_encode($return);
