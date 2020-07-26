<?php

class News implements JsonSerializable {

    private $idnews;
    private $content;
    private $isDeleted;
    private $publishedForAll;
    private $publishedBy;
    private $dateTime;

    /**
     * @return mixed
     */
    public function getIdnews()
    {
        return $this->idnews;
    }

    /**
     * @param mixed $idnews
     */
    public function setIdnews($idnews)
    {
        $this->idnews = $idnews;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getisDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param mixed $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return mixed
     */
    public function getPublishedForAll()
    {
        return $this->publishedForAll;
    }

    /**
     * @param mixed $publishedForAll
     */
    public function setPublishedForAll($publishedForAll)
    {
        $this->publishedForAll = $publishedForAll;
    }

    /**
     * @return mixed
     */
    public function getPublishedBy()
    {
        return $this->publishedBy;
    }

    /**
     * @param mixed $publishedBy
     */
    public function setPublishedBy($publishedBy)
    {
        $this->publishedBy = $publishedBy;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
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

?>