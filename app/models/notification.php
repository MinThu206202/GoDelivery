<?php 

class Notification{

    private $from_agent_id;
    private $to_agent_id;
    private $type_id;
    private $title;
    private $message;
    private $created_at;

    public function setFromagentid($from_agent_id)
    {
        $this->from_agent_id = $from_agent_id;
    }

    public function getFromagentid()
    {
        return $this->from_agent_id;
    }

    public function setToagentid($to_agent_id)
    {
        $this->to_agent_id = $to_agent_id;
    }
    public function getToagentid()
    {
        return $this->to_agent_id;
    }
    public function setTypeid($type_id)
    {
        $this->type_id = $type_id;
    }
    public function getTypeid()
    {
        return $this->type_id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function toArray()
    {
        return [
            "from_agent_id" => $this->getFromagentid(),
            "to_agent_id" => $this->getToagentid(),
            "type_id" => $this->getTypeid(),
            "title" => $this->getTitle(),
            "message" => $this->getMessage(),
            "created_at" => $this->getCreatedAt()
        ];
    }

}



?>