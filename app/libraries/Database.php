<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Database
{

    //call to database
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;


    private $pdo;
    private $error;
    private $success;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false // For General Error
        );

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            // print_r($this->pdo);
            // echo "Success";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function create($table, $data)
    {
        try {
            $column = array_keys($data);
            $columnSql = implode(', ', $column);
            $bindingSql = ':' . implode(',:', $column);
            // echo $bindingSql;
            $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
            // echo $sql;
            $stm = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            // print_r($stm);
            $status = $stm->execute();
            // echo $status;
            return ($status) ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function update($table, $id, $data)
    {
        // First, we don't want id from category table
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);
            function map($item)
            {
                return $item . '=:' . $item;
            }
            $columns = array_map('map', $columns);
            $bindingSql = implode(',', $columns);
            // echo $bindingSql;
            // exit;
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `id` =:id';
            $stm = $this->pdo->prepare($sql);

            // Now, we assign id to bind
            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            $status = $stm->execute();
            // print_r($status);
            return $status;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getByRoleIdWithNames($table)
    {
        $sql = "SELECT 
                    u.*, 
                    r.name AS region_name,
                    c.name AS city_name,
                    t.name AS township_name,
                    w.name AS ward_name,
                    s.name AS status_name
                FROM $table u
                LEFT JOIN regions r ON u.region_id = r.id
                LEFT JOIN cities c ON u.city_id = c.id
                LEFT JOIN townships t ON u.township_id = t.id
                LEFT JOIN wards w ON u.ward_id = w.id
                LEFT JOIN statuses s ON u.status_id = s.id
                WHERE u.role_id = :role_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', 2); // Role 2 = agent
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            die("SQL Error: " . $error[2]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    // public function getById($table, $id)
    // {
    //     $sql = 'SELECT * FROM ' . $table . ' WHERE `id` =:id';
    //     // print_r($sql);
    //     $stm = $this->pdo->prepare($sql);
    //     $stm->bindValue(':id', $id);
    //     $success = $stm->execute();
    //     $row = $stm->fetch(PDO::FETCH_ASSOC);
    //     return ($success) ? $row : [];
    // }

    // public function getByRole($table, $id)
    // {
    //     $sql = 'SELECT * FROM ' . $table . ' WHERE `role_id` =:id';
    //     // print_r($sql);
    //     $stm = $this->pdo->prepare($sql);
    //     $stm->bindValue(':id', 2);
    //     $success = $stm->execute();
    //     $row = $stm->fetch(PDO::FETCH_ASSOC);
    //     return ($success) ? $row : [];
    // }

    public function agentbyid($id)
    {

        $sql = "
        SELECT u.*, s.name AS status_name
        FROM users u
        LEFT JOIN statuses s ON u.status_id = s.id
        WHERE u.id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        // var_dump($stmt);
        // die();        // ✔ Prepared statement
        $stmt->bindValue(':id', $id);              // ✔ Binding ID safely
        $stmt->execute();                          // ✔ Executes the query
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);    // ✔ Gets one row as an associative array
        return $rows ?: [];
        // ✔ Returns empty array if no result
    }

    public function deliverybyid($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                id,
                sender_name, sender_phone, sender_email, sender_address,
                receiver_name, receiver_phone, receiver_email, receiver_address,
                from_region_id, to_region_id, address,
                total_amount, payment_status_id, delivery_status_id,
                created_at
            FROM deliveries 
            WHERE sender_id = :sender_id
            ORDER BY created_at DESC
        ");

        $stmt->bindValue(':sender_id', $id);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    // public function registermailcheck($email){
    //     $sql = "SELECT * FROM users WHERE `email` = :email";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindValue(':email',$email);
    //     $success = $stmt->execute();
    //     $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return ($success) ? $row : [];
    // }

    public function columnFilter($table, $column, $value)
    {
        // $sql = 'SELECT * FROM ' . $table . ' WHERE `' . $column . '` = :value';
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', $value);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }
    public function columnFilterAll($table, $column, $value)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function readAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($sql);
        $success = $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }
    public function delete($table, $id)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        return ($success);
    }
}







// // public function categoryView()
// // {
// //     $sql = 'SELECT * FROM vw_categories_type';
// //     $sql = 'SELECT categories.id, categories.name, categories.description, types.name AS type_name FROM categories LEFT JOIN types ON categories.type_id = types.id';
// //     $stm = $this->pdo->prepare($sql);
// //     $success = $stm->execute();
// //     $row = $stm->fetchAll(PDO::FETCH_ASSOC);
// //     return ($success) ? $row : [];
// // }

// public function getById($table, $id)
// {
//     $sql = 'SELECT * FROM ' . $table . ' WHERE `id` =:id';
//     // print_r($sql);
//     $stm = $this->pdo->prepare($sql);
//     $stm->bindValue(':id', $id);
//     $success = $stm->execute();
//     $row = $stm->fetch(PDO::FETCH_ASSOC);
//     return ($success) ? $row : [];
// }

// public function getByCategoryId($table, $column)
// {
//     $stm = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE name =:column');
//     $stm->bindValue(':column', $column);
//     $success = $stm->execute();
//     $row = $stm->fetch(PDO::FETCH_ASSOC);
//    //  print_r($row);
//     return ($success) ? $row : [];
// }

// // For Dashboard
// public function incomeTransition()
// {
//    try{

//        $sql        = "SELECT *,SUM(amount) AS amount FROM incomes WHERE
//        (date = { fn CURDATE() }) ";
//        $stm = $this->pdo->prepare($sql);
//        $success = $stm->execute();

//        $row     = $stm->fetch(PDO::FETCH_ASSOC);
//        return ($success) ? $row : [];

//     }
//     catch( Exception $e)
//     {
//         echo($e);
//     }

// }

// public function expenseTransition()
// {
//    try{

//        $sql        = "SELECT * ,SUM(amount*qty) AS amount FROM expenses WHERE
//        (date = { fn CURDATE() }) ";
//        $stm = $this->pdo->prepare($sql);
//        $success = $stm->execute();

//        $row     = $stm->fetch(PDO::FETCH_ASSOC);
//        return ($success) ? $row : [];

//     }
//     catch( Exception $e)
//     {
//         echo($e);
//     }

// }///
