<?php

class User 
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function instantiation($the_record)
    {
        $the_object = new self;

        $the_object -> id = $the_record['id'];
        $the_object -> username = $the_record['username'];
        $the_object -> password = $the_record['password'];
        $the_object -> first_name = $the_record['first_name'];
        $the_object -> last_name = $the_record['last_name']; 
        
        foreach($the_record as $the_attribute    => $value)
        {
            if ($the_object->has_the_attribute($the_attribute))
            {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public static function find_all_users()
    {
        return self::find_this_query("Select * from users");
    }

    public static function find_user_by_id($id)
    {
        $the_result_array = self::find_this_query("Select * from users where id=$id limit 1");

        if(!empty($the_result_array))
        {
            $first_item = array_shift($the_result_array);
            return $first_item;
        }

        return false;
    }

    static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set))
        {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }
}

$user =  new User();

?>