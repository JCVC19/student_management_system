<?php 

require_once 'Model.php';
require_once 'Student.php';

class Grade extends Model{
    protected static $table = 'grades';

    public $id;
    public $student_id;
    public $subject_id;
    public $instructor_id;
    public $grade;
    public $remarks;
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
            'instructor_id' => $this->instructor_id,
            'grade' => $this->grade,
            'remarks' => $this->remarks,
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

    public static function findGradesByStudent($student_id){
        $results = parent::where('student_id', '=', $student_id);

        return $results
            ? array_map(fn($user) => new self($user), $results)
            : null;
    }

    public function students(){
        $results = Student::find($this->student_id);

        return $results ?? null;
    }
}