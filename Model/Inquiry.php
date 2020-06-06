<?php

class Inquiry implements JsonSerializable {
    private $sender;
    private $receiver;
    private $inq_id;
    private $inq_type;
    private $msg_body;
    private $time;
    private $sender_id;
    private $receiver_id;


    /**
     * Inquiry constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * @param mixed $sender_id
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    /**
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * @param mixed $receiver_id
     */
    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return mixed
     */
    public function getInqId()
    {
        return $this->inq_id;
    }

    /**
     * @param mixed $inq_id
     */
    public function setInqId($inq_id)
    {
        $this->inq_id = $inq_id;
    }

    /**
     * @return mixed
     */
    public function getInqType()
    {
        return $this->inq_type;
    }

    /**
     * @param mixed $inq_type
     */
    public function setInqType($inq_type)
    {
        $this->inq_type = $inq_type;
    }

    /**
     * @return mixed
     */
    public function getMsgBody()
    {
        return $this->msg_body;
    }

    /**
     * @param mixed $msg_body
     */
    public function setMsgBody($msg_body)
    {
        $this->msg_body = $msg_body;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $json = array();
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json; // or json_encode($json)
    }

}
