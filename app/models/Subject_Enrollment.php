<?php 

require_once 'Model.php';
require_once 'Student.php';

class Subject_Enrollment extends Model{
    protected static $table = 'subject_enrollments';

    public $id;
    public $student_id;
    public $subject_id;
    public $status;
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
            ? array_map(fn($book) => new self($book), $results)
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
        else{
            return false;
        }
    }

    public function save(){
        $data = [
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'status' => $this->status,
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
}