<?php

class Inquiry{
    private $stu_id;
    private $staff_id;
    private $inq_id;
    private $inq_type;
    private $feedback;
    private $description;

    /**
     * Inquiry constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getStuId()
    {
        return $this->stu_id;
    }

    /**
     * @param mixed $stu_id
     */
    public function setStuId($stu_id)
    {
        $this->stu_id = $stu_id;
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }

    /**
     * @param mixed $staff_id
     */
    public function setStaffId($staff_id)
    {
        $this->staff_id = $staff_id;
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
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}
