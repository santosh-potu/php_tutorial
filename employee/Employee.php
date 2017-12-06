<?php
class Employee {
    
  var $name;
   var $id ;
   var $age;
   var $dept;
   
   
    function getName()
    {
        return $this->name;
    }
   function getId()
    {
        return $this->id;
    }
   function getAge()
    {
        return $this->Age;
    }
	function getDept()
    {
        return $this->dept;
    }
    function __toString(){
      return $this->name.$this->id.$this->age.$this->dept;  
    }
  /* public function Employee()
    {
        
    }*/
   public function Employee($name,$id,$age,$dept)
    {
        $this->name=$name;
        $this->age=$age;
        $this->id=$id;
        $this->dept=$dept;
    }
    function setAge($age)
    {
        $this->age=$age;
        return true;
    }
    function setId($id)
    {
        $this->id=$id;
        return true;
    }
    function setName($name)
    {
        $this->name=$name;
        return true;
    }
	 function setDept($name)
    {
        $this->name=$name;
        return true;
    }
    function updateEmployee($id,$name,$age,$dept){
        if($id==NULL)return false;
        
        
        
        return true;
    }
    
}







?>
