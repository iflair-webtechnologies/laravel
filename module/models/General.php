<?php


namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;
use Sofa\Eloquence\Eloquence;
use DB; 
use Session;
use PDO;

class General extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

     private static $_table;
     private static $_fields;
     public  static $fields;    

    /**
 * Set table name
 * @access public
 * @param  string - sets table_name
 * @return null
 * @author Author
 */
    public static function set_table($table_name)
    {  

     General::$_table = $table_name;
     General::$_fields =  \Schema::getColumnListing(General::$_table);      
       foreach(General::$_fields as $field) {
         General::$fields[$field] = "";
       }       
    } 

 /**
 * Get record from tables
 * @access public
 * @return array()
 * @author Author
 */
    public static function get_fields_array()
    {  
      return General::$_fields;      
    }

    /**
 * Get record from table
 * @access public
 * @param number - sets limit
 * @param number - sets offset
 * @param array  - sets order
 * @author Author
 * @return array()
 */

    public static function get($select = array(),$fetchmode = 0,$conditions = array(),$order=array(),$limit=NULL,$offset=NULL)
    {
      if($fetchmode == 1){
          DB::setFetchMode(PDO::FETCH_ASSOC);          
        }else
        {
          DB::setFetchMode(PDO::FETCH_CLASS); 
        } 
        $query = DB::table(General::$_table)->select($select);

        if (!empty($conditions)) {
          foreach ($conditions as $key => $value) {
             $columname = substr($key,0,-2);
             $operator = substr($key,-2);
             $query = $query->where(trim($columname),trim($operator),$value);            
          }        
        }

        if($order)
        $query->orderby(key($order),$order[key($order)]);
        if($limit && $offset)
        $query->take($limit)->skip($offset);
        elseif($limit)
            $query->limit($limit);
        $result = $query->get();
         DB::setFetchMode(PDO::FETCH_CLASS);
        return $result;
    }
/**
 * Advance Get Function
 * @access public
 * @param number - select values
 * @param number - sets limit
 * @param number - sets offset
 * @param array  - sets order
 * @param array  - sets groupby
 * @author Author
 * @return array()
 */
  public static function advance_get($select = array(),$fetchmode = 0,$conditions = array(),$order=array(),$groupby='',$limit=NULL,$offset=NULL)
    {
      if($fetchmode == 1){
          DB::setFetchMode(PDO::FETCH_ASSOC);          
        } 
        $query = DB::table(General::$_table)->select($select);

        if (!empty($conditions)) {
          foreach ($conditions as $key => $value) {
             $columname = substr($key,0,-2);
             $operator = substr($key,-2);
             $query = $query->where(trim($columname),trim($operator),$value);            
          }        
        }
        if($order)
        $query->orderby(key($order),$order[key($order)]);

        if($groupby != ''){
         $query->groupby($groupby);
        }

        if($limit && $offset)
        $query->take($limit)->skip($offset);
        elseif($limit)
            $query->limit($limit);
        $result = $query->get();
        return $result;
    }
  /**
 * Get record by id from table
 * @access public
 * @param number - sets limit
 * @param number - sets offset
 * @param array  - sets order
 * @author Author
 * @return array()
 */

public static function get_by_id($id,$order=array("id"=>"ASC"),$limit='1',$offset=NULL)
{
    $query = DB::table(General::$_table)->where("id",$id)->orderby(key($order),$order[key($order)])->take($limit)->skip($offset);
    $result = $query->get();
    return $result;
}  

    /**
 * Save record in table
 * @access public
 * @param array  -
 * @return insert id
 * @author Author
 */
   public static function saveRecord($data,$password = NULL,$created = NULL)
    {
        if(!empty($data))
        {
            //if password field exist then
            if($password != NULL)
            {
                $data[$password] = md5($data[$password]);
            }
            if($created != NULL)
            {
                $data[$created] =  date('Y-m-d H:i:s');
            }

            //$data = elements($this->_fields,$data);
            $id = DB::table(General::$_table)->insertGetId($data);
            return $id;
        }
        return false;
    }
    /**
 * Save batch record in table
 * @access public
 * @param array  - all combine data
 * @return insert id
 * @author Author
 */
    public static function saveBatch($collection){
      //echo "<pre>";print_r($collection);exit;
        $id = DB::table(General::$_table)->insert($collection);
        return $id;
    }

    /**
 * Update record in table
 * @access public
 * @param array  - task data
 * @param array  - field name & value
 * @return boolean
 *  @author Author
 */
   public static function updateRecord($data,$fieldValue = array())
      {
          if(!empty($data) && !empty($fieldValue))
          {
              $query = DB::table(General::$_table);
              $query->where($fieldValue);

              $row = $query->update($data);

              if($row >= 0)
              return true;
              else
              return false;
          }
          return false;
      }

/**
 * Delete record in table
 * @access public
 * @param array  - field name & value
 * @return boolean
 *  @author Author
 */
  public static function deleteRecord($fieldValue = array())
      {
          if(!empty($fieldValue))
          {
              $query = DB::table(General::$_table);
              $query->where($fieldValue);
              $row = $query->delete();
              if($row > 0)
              return true;
              else
              return false;
          }
          return false;
      }
/**
 * Delete record in table
 * @access public
 * @param array  - field name & value
 * @return boolean
 *  @author Author
 */

public static function delete_multiple($where_in = array(), $fieldName)
{
    if(!empty($where_in))
    {
      $row = DB::table(General::$_table)->whereIn($fieldName,$where_in)->delete();
      if($row > 0)
      return true;
      else
      return false;
    }
    return false;
}

/**
 * Delete record in table
 * @access public
 * @param array  - field name & value
 * @return boolean
 *  @author Author
 */
public static function update_multiple($data, $fieldName)
{
    if(!empty($data))
    {

      foreach ($data as $key => $value) {
      $row = DB::table(General::$_table)->where($fieldName,'=',$value['id'])->update($value);
      }
      if($row > 0)
      return true;
      else
      return false;
    }
    return false;
}
/**
 * Get Field or Fields By Id
 * @access public
 * @param  string  - field name
 * @param  number  - field id
 * @return boolean
 *  @author Author
 */

public static function get_fields($field_names = NULL , $id = NULL,$field_id = NULL)
{
    if($field_names != NULL && $id != NULL)
    {
         DB::setFetchMode(PDO::FETCH_ASSOC); 
        $query = DB::table(General::$_table)->where($field_id,$id);
        $record = $query->get();
        
        if(!empty($record))
        {
            if(count(explode(",", $field_names)) > 1)
            return $record[0];
            else
            return $record[0][$field_names];
        }
        return "";
    }
    return "";
}
/**
 * Join Two Table
 * @access public
 * @param array  - result
 * @return stdClass
 *  @author Author
 */
public static function singleJoin($parentTable,$childTable,$select,$condition,$where=array(),$order=array(),$limit=null){
 
    $query = DB::table($parentTable)->select($select);
    
    if (!empty($where)) {
          foreach ($where as $key => $value) {
             $columname = substr($key,0,-2);
             $operator = substr($key,-2);
             $query = $query->where(trim($columname),trim($operator),$value);            
          }        
        }
       // echo $condition[1];exit;
   $query =  $query->leftjoin($childTable,$condition[0],'=',$condition[1]);


    if($limit != null){
    $query =  $query->limit($limit);
    } 

    if($order)
        $query->orderby(key($order),$order[key($order)]);
  
    return $query->get();
}

/**
 * Function check record is exist or not.
 * @access public
 * @param array  - result
 * @return boolean true if have dublicate record and false doen't dublicate record
 * @author Author
 */
public static function checkDuplicate($condition,$table=''){
    if($table == '')
    $table = General::$_table;

    $record = DB::table($table)->where($condition)->get();
    if(count($record) >= 1){
        return true;
    }else{
        return false;
    }
}

/**
 * Count Number of record from table
 * @access public
 * @Optional = table name
 * @author Author
 * @return array()
 */
public static  function count_record($condition,$table='')
{
    if($table == '')
    $table = General::$_table;


   $query = DB::table($table);
   foreach ($condition as $key => $value) {
     $columname = substr($key,0,-2);
             $operator = substr($key,-2);
             $query = $query->where(trim($columname),trim($operator),$value); 
      }

      
   return count($query->get());    
}

/**
 * Function give next/ successor id from calculating ids.
 * @access public
 * @param array  - result
 * @return id
 * @author Author
 */
public static function getNextId($tableName,$id='id',$alias='')
{
    if($alias == '')
    {
        $alias = $id;
    }

    $result = DB::table($tableName)->max($id,$alias);
    return $result+1;
}


}
