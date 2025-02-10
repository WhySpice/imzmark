<?php

class CADES
{
    private static $queueFile = 'core/cache/cadesQueue.json';

    public static function checkQueueFile()
    {
        if(file_exists(self::$queueFile))
            return 'yes';

        //return file_exists(self::$queueFile) && is_readable(self::$queueFile);
    }

    public static function Sign($data) {
        $queue_id = self::addToQueue($data);
        $signed_data = self::waitForSignature($queue_id);

        return $signed_data;
    }

    public static function addToQueue($data) {
        $queue_id = uniqid();
        $queue = self::readQueue();
        $queue[$queue_id] = ['data' => $data, 'status' => 'pending'];
        self::writeQueue($queue);
        return $queue_id;
    }

    public static function waitForSignature($queue_id) {
        $signed_data = null;
        while (true) {
            $queue = self::readQueue();
            if (isset($queue[$queue_id]) && $queue[$queue_id]['status'] === 'signed') {
                $signed_data = $queue[$queue_id]['signed_data'];
                CADES::removeFromQueue($queue_id);
                break;
            }
            sleep(1);
        }
        return $signed_data;
    }

    public static function readQueue() {
        if (!file_exists(self::$queueFile)) {
            return [];
        }
        $json = file_get_contents(self::$queueFile);
        return json_decode($json, true);
    }

    public static function writeQueue($queue) {
        $json = json_encode($queue, JSON_PRETTY_PRINT);
        file_put_contents(self::$queueFile, $json);
    }

    public static function removeFromQueue($queue_id) {
        $queue = self::readQueue();
        if (isset($queue[$queue_id])) {
            unset($queue[$queue_id]);
            self::writeQueue($queue);
        }
    }
}
