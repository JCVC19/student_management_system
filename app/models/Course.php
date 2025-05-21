<?php
require_once 'Model.php';
require_once 'Student.php';

class Course extends Model{
    protected static $table = 'courses';

    public $id;
    public $code;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct(array $data = []){
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    public static function all(){
        $results = parent::all();

        return $results
            ? array_map(fn($course) => new self($course), $results)
            : null;
    }

    public static function find($id){
        $result = parent::find($id);

        return $result 
            ? new self($result)
            : null;
    }

    public static function create(array $data){
        $result = parent::create($data);

        return $result 
            ? new self($result)
            : null;
    }

    public function update(array $data){
        $result = parent::updateById($this->id, $data);

        if($result){
            foreach($data as $key => $value){
                if(property_exists($this, $key)){
                    $this->$key = $value;
                }
            }
        }

        return $result;
    }

    public function save(){
        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        $this->update($data);
    }

    public function delete(){
        $result = parent::deleteById($this->id);
        if($result){
            foreach($this as $key => $value){
                if(property_exists($this, $key)){
                    unset($this->$key);
                }
            }
        }
        else{
            return false;
        }
    }

    public static function where($column, $operator, $value){
        $results = parent::where($column, $operator, $value);

        return $results
            ? array_map(fn($user) => new self($user), $results)
            : null;
    }

    public function student(){
        $result = Student::where('course_id', '=', $this->id);

        return $result ?? null;
    }
}