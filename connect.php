<?php


class User
{

    private $hostname = "localhost";
    private $name = "root";
    private $pass = "";
    private $dbname="companytask";
    private $mysqli='';

    public function __construct()
    {
        $this->mysqli = new mysqli($this->hostname,$this->name,$this->pass,$this->dbname);
    }

    public function insert($table,$condition_arr)
    {
        if($condition_arr != "")
        {
            foreach($condition_arr as $key => $value)
            {
                $field[] = $key;
                $values[] = $value;
            }
            $fieldname = implode(",",$field);
            
            $valuename = implode("','",$values); 
            $valuename = "'".$valuename."'";
           
            $sql = "insert into $table ($fieldname) values($valuename) ";
            
            $result = $this->mysqli->query($sql);
            if($result>0)
            {
                echo "Recoed added";
            }
        }
    }

    public function select($table,$field='*',$condition_arr='')
    {
        $sql = "select $field from $table ";
       
        if($condition_arr != '')
        {
           
            $sql .= "where ";
            $count = count($condition_arr);
            $i=1;
            foreach($condition_arr as $key=>$value)
            {
                    if($i == $count)
                    {
                        $sql .= "$key = '$value' ";
                     }else
                     {
                         $sql .= "$key = '$value' and ";
                      } 
                   $i++;
            }         
                   
        }  
        
       $result =  $this->mysqli->query($sql);
       if($result->num_rows > 0)
       {
           while($row=$result->fetch_assoc())
           {
               $data[] = $row;
           }
           return $data;
       }else
       {
           return 0;
       }
    }

    public function delete($table,$condition_arr)
    {
        $sql = "delete from $table where ";
        if($condition_arr != '')
        {

            foreach($condition_arr as $key => $value)
            {
                $sql .= "$key = '$value '";
            }

        }
        $result = $this->mysqli->query($sql);
        if($result>0)
        {
            echo "Record Deleted";
        }
    }

    public function update($table,$condition_arr,$wherefield,$wherecolumn)
    {
        //$sql = "update $table set fieldname = values where uid=''";
        $sql = "update $table set ";

            if($condition_arr != '')
            {
                $count = count($condition_arr);
                $i=1;
                foreach($condition_arr as $key=>$val)
                {
                    if($i==$count)
                    {
                        $sql .= " $key = '$val' ";
                    }else
                    {
                        $sql .= "$key = '$val', ";
                    }
                    $i++;
                }
              
              
                $sql .= "where $wherefield = '$wherecolumn' ";
            }
            $result = $this->mysqli->query($sql);
            if($result>0)
            {
                echo "Updated";
            }
    }

    public function validate($str)
    {
        if($str != '')
        {
            return mysqli_real_escape_string($this->mysqli,$str);
        }
    }
}



?>