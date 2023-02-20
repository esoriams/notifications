<?php

namespace App\Http\Notifications;

trait Notifiable
{
    /**
     * @var ConnectionInterface
     */
    protected ConnectionInterface $connection;

    /**
     * @var string
     */
    protected string $message;

    /**
     * @return ConnectionInterface
     */
    protected function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }

    /**
     * @param ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection): void
    {
        $this->connection = $connection;
    }

    /**
     * @param string $text
     * @return void
     */
    function setMessage(string $text): void
    {
        $this->message = $text;
    }

    /**
     * @return bool
     */
    public function sendMessage():bool
    {
        $this->connection->setMessage($this->message);
        return $this->connection->send();
    }

}
