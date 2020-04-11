<?php 
    class Degree {

        private $deg_id;
        private $course_code;
        private $course_name;

        public function __construct()
        {
        }
    
        public function setDegreeId($deg_id){
            $this->deg_id = $deg_id;
        }

        public function getDegreeId(){
            return $this->deg_id;
        }

        public function setCourseName($course_name){
            $this->course_name = $course_name;
        }

        public function getCourseName(){
            return $this->course_name;
        }

        public function setCourseCode($course_code){
            $this->course_code = $course_code;
        }

        public function getCourseCode(){
            return $this->course_code;
        }

    }

   
?>