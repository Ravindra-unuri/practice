<?php

use App\Models\User;
use Carbon\Exceptions\Exception;

if (!function_exists('dispatch_job')) {

    /**
     * Dispatch job and hold exception
     * @param object $job
     * @param string $connection
     * @param string $queue
     * @param int $delay_in_seconds
     * @return bool
     */
    function dispatch_job($job, $connection, $queue, $delay_in_seconds = 0)
    {
        try {
            if ($delay_in_seconds) {
                $job->delay = $delay_in_seconds;
                dispatch($job)->onConnection($connection)->onQueue($queue);
            } else {
                dispatch($job)->onConnection($connection)->onQueue($queue);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>