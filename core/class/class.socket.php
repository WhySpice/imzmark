<?php
/*
# Welcome to WHYSPICE OS 0.0.1 (GNU/Linux 3.13.0.129-generic x86_64)

root@localhost:~ bash ./whyspice-work.sh
> Executing...

         _       ____  ____  _______ ____  ________________
        | |     / / / / /\ \/ / ___// __ \/  _/ ____/ ____/
        | | /| / / /_/ /  \  /\__ \/ /_/ // // /   / __/
        | |/ |/ / __  /   / /___/ / ____// // /___/ /___
        |__/|__/_/ /_/   /_//____/_/   /___/\____/_____/

                            Web Dev.
                WHYSPICE © 2024 # whyspice.su

> Disconnecting.

# Connection closed by remote host.
*/
class Socket
{
    private $host;
    private $port;
    private $timeout;
    private $socket;

    public function __construct($host, $port, $timeout = 5)
    {
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    private function connect()
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($this->socket === false) {
            throw new Exception("Ошибка при создании сокета: " . socket_strerror(socket_last_error()));
        }

        socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, ['sec' => $this->timeout, 'usec' => 0]);

        $result = @socket_connect($this->socket, $this->host, $this->port);

        if ($result === false) {
            throw new Exception("Ошибка при подключении: " . socket_strerror(socket_last_error($this->socket)));
        }
    }

    public function sendCommand($command)
    {
        $this->connect();

        $result = socket_write($this->socket, $command, strlen($command));
        if ($result === false) {
            throw new Exception("Ошибка при отправке данных: " . socket_strerror(socket_last_error($this->socket)));
        }

        $response = $this->readResponse();

        socket_close($this->socket);

        return $response;
    }

    private function readResponse()
    {
        $response = '';
        while (true) {
            $data = @socket_read($this->socket, 1024, PHP_NORMAL_READ);
            if ($data === false) {
                $errCode = socket_last_error($this->socket);
                if ($errCode === SOCKET_EAGAIN || $errCode === SOCKET_EWOULDBLOCK) {
                    throw new Exception("Превышен таймаут ожидания ответа.");
                } else {
                    throw new Exception("Ошибка при чтении данных: " . socket_strerror($errCode));
                }
            }

            $response .= $data;

            if (strpos($response, "\n") !== false) {
                break;
            }
        }

        return trim($response);
    }

    public function ping()
    {
        $startTime = microtime(true);
        $response = $this->sendCommand("/ping\n");

        if ($response === false) {
            return false;
        }

        $endTime = microtime(true);
        $latency = ($endTime - $startTime) * 1000;

        return round($latency, 2);
    }
}
