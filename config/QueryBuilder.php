<?php
require "Database.php";

class QueryBuilder{
    protected $data;
    public function __construct($pdo) {
        $this->data = $pdo;
    }
    public function select($query){
        $statement = $this->data->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function count($query){
        $statement = $this->data->prepare($query);
        $statement->execute();
        return $statement->rowCount();
    }
    public function insert($array){
        $statement = $this->data->prepare("INSERT INTO users (username,email,password,type) VALUES (?,?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertAdmins($array){
        $statement = $this->data->prepare("INSERT INTO admins (name,email,password) VALUES (?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertCate($array){
        $statement = $this->data->prepare("INSERT INTO categories (name) VALUES (?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertJob($array){
        $statement = $this->data->prepare("INSERT INTO jobs (job_title,job_region,job_type,job_location,job_category,job_experience,salary,gender,deadline,descrip,respon,education,benefit,company_email,c_name,c_id,c_image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute($array);
    }
    public function updateJob($array,$company_id){
        $statement = $this->data->prepare("UPDATE jobs SET job_title=?,job_region=?,job_type=?,job_location=?,job_category=?,job_experience=?,salary=?,gender=?,deadline=?,descrip=?,respon=?,education=?,benefit=?,company_email=?,c_name=?,c_id=?,c_image=? WHERE id='$company_id'");
        $statement->execute($array);
    }
    public function updateCate($array,$cate_id){
        $statement = $this->data->prepare("UPDATE categories SET name=? WHERE id='$cate_id'");
        $statement->execute($array);
    }
    public function updateStatus($query){
        $statement = $this->data->prepare($query);
        $statement->execute();
    }
    public function insertJobApplications($array){
        $statement = $this->data->prepare("INSERT INTO job_applications (username,email,cv,employee_id,job_id,job_title,company_id) VALUES (?,?,?,?,?,?,?)");
        $statement->execute($array);
    }
    public function insertSave($array){
        $statement = $this->data->prepare("INSERT INTO saved_jobs (job_id,employee_id) VALUES (?,?)");
        $statement->execute($array);
    }
    public function deleteQuery($delete){
        $statement = $this->data->prepare($delete);
        $statement->execute();
    }
    public function updateProfile($array,$user_id){
        $statement = $this->data->prepare("UPDATE users SET username=?,email=?,title=?,bio=?,facebook=?,instagram=?,linkin=?,img=?,cv=? WHERE id=$user_id");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function joinSavedJob($query){
        $statement = $this->data->prepare($query);
        $statement->execute($value);
    }
    public function insertKeyword($array){
        $statement = $this->data->prepare("INSERT INTO keyword (keyword) VALUES (?)");
        $statement->execute($array);
    }
}
$db = new QueryBuilder(Database::query());