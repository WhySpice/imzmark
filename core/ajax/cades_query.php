<?php
$action = $_POST['action'];

if ($action === 'check_queue') {
    $queue = CADES::readQueue();
    foreach ($queue as $queue_id => $item) {
        if ($item['status'] === 'pending') {
            die(json_encode(['data' => $item['data'], 'queue_id' => $queue_id]));
        }
    }
    echo json_encode(['data' => null]);
}
elseif ($action === 'update_queue') {
    $queue_id = $_POST['queue_id'];
    $signed_data = $_POST['signed_data'];

    $queue = CADES::readQueue();
    if (isset($queue[$queue_id])) {
        $queue[$queue_id]['signed_data'] = $signed_data;
        $queue[$queue_id]['status'] = 'signed';
        CADES::writeQueue($queue);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Queue ID not found']);
    }
}