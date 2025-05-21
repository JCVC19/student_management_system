<?php

require_once 'Model.php';
require_once 'Course.php';
require_once 'User.php';
require_once 'Student.php';
require_once 'Subject_Enrollment.php';

class Subject extends Model{
    protected static $table = 'subjects';

    public $id;
    public $code;
    public $catalog_no;
    public $name;
    public $day;
    public $time;
    public $room;
    public $course_id;
    public $semester;
    public $year_level;
    public $instructor_id;
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
            ? array_map(fn($subject) => new self($subject), $results)
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

    public function students() {
        return $this->belongsToMany(Student::class, 'subject_enrollments', 'subject_id', 'student_id');
    }

    public static function findByInstructor($instructor_id) {
    $results = parent::where('instructor_id', '=', $instructor_id);
    
    return $results
        ? array_map(fn($subject) => new self($subject), $results)
        : [];
    }

    public function instructor(){
        $results = User::find($this->instructor_id);

        return $results ?? null;
    }

    public static function findByCatalogNo($catalog_no) {
        $results = parent::where('catalog_no', '=', $catalog_no);
        
        return $results
            ? array_map(fn($subject) => new self($subject), $results)
            : null;
    }

    public function course(){
        $results = Course::find($this->course_id);

        return $results ?? null;
    }

}
