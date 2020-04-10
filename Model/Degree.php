<?php 
    class Degree {

        private $deg_id;
        private $fac_id;
        private $degree_title;
        private $degree_duration;
        


        public function __construct()
        {
        }

        public function setFacultyId($fac_id){
            $this->fac_id = $fac_id;
        }

        public function getFacultyId(){
            return $this->fac_id;
        }
    
        public function setDegreeId($deg_id){
            $this->deg_id = $deg_id;
        }

        public function getDegreeId(){
            return $this->deg_id;
        }

        public function getDegreeTitle(){
            return $this->degree_title;
        }

        public function setDegreeTitle($degree_title){
            $this->degree_title = $degree_title;
        }

        public function getDegreeDuration(){
            return $this->degree_title;
        }

        public function setDegreeDuration($degree_duration){
            $this->degree_duration = $degree_duration;
        }
        


    }

   
?>