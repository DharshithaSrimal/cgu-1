<?php 
    class User {

        private $fname;
        private $lname;
        private $email;
        private $dob;
        private $tpnumber;
        private $image;
        private $user_id;
        private $role;
        private $gender;


        public function __construct()
        {
        }


            public function getFname(){
            return $this->fname;
        }
    
        public function setFname($fname){
            $this->fname = $fname;
        }
    
        public function getLname(){
            return $this->lname;
        }
    
        public function setLname($lname){
            $this->lname = $lname;
        }
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
        }
    
        public function getDob(){
            return $this->dob;
        }
    
        public function setDob($dob){
            $this->dob = $dob;
        }
    
        public function getTpnumber(){
            return $this->tpnumber;
        }
    
        public function setTpnumber($tpnumber){
            $this->tpnumber = $tpnumber;
        }
    
        public function getImage(){
            return $this->image;
        }
    
        public function setImage($image){
            $this->image = $image;
        }
    
        public function getUser_id(){
            return $this->user_id;
        }

        public function setUser_id($user_id){
            $this->user_id = $user_id;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($role){
            $this->role = $role;
        }

    }

    class Student extends User{

        private $rate;
        private $fac_id;
        private $facName;
        private $degName;


        public function getDegName()
        {
            return $this->degName;
        }

        public function setDegName($degName)
        {
            $this->degName = $degName;
        }

        public function getFacName()
        {
            return $this->facName;
        }

        public function setFacName($facName)
        {
            $this->facName = $facName;
        }

        private $deg_id;
    
        function __construct(){

        }

        public function getRate(){
            return $this->rate;
        }
    
        public function setRate($rate){
            $this->rate = $rate;
        }
    
        public function getFac_id(){
            return $this->fac_id;
        }
    
        public function setFac_id($fac_id){
            $this->fac_id = $fac_id;
        }
    
        public function getDeg_id(){
            return $this->deg_id;
        }
    
        public function setDeg_id($deg_id){
            $this->deg_id = $deg_id;
        }

    }

    class Staff extends User{

        private $experience;
        private $fac_id;
        private $facName;
        private $specialized_area;
        private $academic_position;
        private $cgu_position;

        function __construct(){
        }

        public function getExperience(){
            return $this->experience;
        }
    
        public function setExperience($experience){
            $this->experience = $experience;
        }
    
        public function getFac_id(){
            return $this->fac_id;
        }
    
        public function setFac_id($fac_id){
            $this->fac_id = $fac_id;
        }
    
        public function getSpecialized_area(){
            return $this->specialized_area;
        }
    
        public function setSpecialized_area($specialized_area){
            $this->specialized_area = $specialized_area;
        }

        public function getFacName()
        {
            return $this->facName;
        }

        public function setFacName($facName)
        {
            $this->facName = $facName;
        }

        public function getAcademicPosition()
        {
            return $this->academic_position;
        }

        public function setAcademicPosition($academic_position)
        {
            $this->academic_position = $academic_position;
        }

        public function getCguPosition()
        {
            return $this->cgu_position;
        }

        public function setCguPosition($cgu_position)
        {
            $this->cgu_position = $cgu_position;
        }
    }
?>