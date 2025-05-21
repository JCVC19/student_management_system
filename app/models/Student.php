<?php

require_once 'Model.php';
require_once 'Course.php';
require_once 'User.php';
require_once 'Subject.php'; 
require_once 'Grade.php';

class Student extends Model{
    protected static $table = 'students';

    public $id;
    public $student_id;
    public $name;
    public $gender;
    public $birthdate;
    public $course_id;
    public $year_level;
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
            ? array_map(fn($student) => new self($student), $results)
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
            'name' => $this->name,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'course_id' => $this->course_id,
            'year_level' => $this->year_level,
            'status' => $this->status,
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
            ? array_map(fn($student) => new self($student), $results)
            : null;
    }

    // public function grades(){
    //     return $this->belongsToMany(Grade::class, 'grades', 'student_id', 'student_id');
    // }

    public static function findByCourse($course_id){
        $results = parent::where('course_id', '=', $course_id);
        
        return $results
            ? array_map(fn($student) => new self($student), $results)
            : null;
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'subject_enrollments', 'student_id', 'subject_id');
    }

    public function course() {
        $results = Course::find($this->course_id);

        return $results ?? null;
    }

    public function grades() {
        $results = Grade::where('student_id', '=', $this->id);

        return $results ?? null;
    }

    public static function findByStudentId($student_id){
        $results = parent::where('student_id', '=', $student_id);
        
        return $results ? array_map(fn($student) => new self($student), $results)
            : null;
    }
}
