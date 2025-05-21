<?php

require_once 'Model.php';
require_once 'Subject.php';

class User extends Model{
    protected static $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status;
    public $created_at;
    public $updated_at;
    public $designation;

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
            ? array_map(fn($user) => new self($user), $results)
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'designation' => $this->designation
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

    public static function findByRole($role){
        $results = parent::where('role', '=', $role);

        return $results
            ? array_map(fn($user) => new self($user), $results)
            : null;
    }

    public static function findByEmail($email){
        $results = parent::where('email', '=', $email);

        return $results
            ? new self($results[0])
            : null;
    }
    
    public function subjects(){
        $results = Subject::where('instructor_id', '=', $this->id);

        return $results ?? null;
    }
}