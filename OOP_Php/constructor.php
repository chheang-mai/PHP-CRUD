<?php  
    class Person{
        private $name;
        private $gender;
        private $dob;
        private $phone;
        private $email;
        private $address;
     public function _construct($name,$gender,$dob,$phone,$email,$address){
            $this->name = $name ;
            $this->gender = $gender;
            $this->dob = $dob;
            $this->phone = $phone;
            $this->email = $email;
            $this->address = $address;
    }   
    }
   
?>