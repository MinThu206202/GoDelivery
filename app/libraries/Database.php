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

    public function getByRoleAndStatus($table, $roleName, $statusList = [])
    {
        $placeholders = implode(',', array_fill(0, count($statusList), '?'));
        $sql = "SELECT * FROM {$table} WHERE role_name = ? AND status_name IN ($placeholders)";

        $stm = $this->pdo->prepare($sql);

        // Merge parameters: roleName first, then statusList
        $params = array_merge([$roleName], $statusList);
        $success = $stm->execute($params);

        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $success ? $rows : [];
    }

    public function getByDeliveryIdAndStatuses($table, $agentId, $statusList = [])
    {
        if (empty($statusList)) {
            // No status filter: fetch all by agent
            $sql = "SELECT * FROM {$table} WHERE receiver_agent_id = ?";
            $stm = $this->pdo->prepare($sql);
            $success = $stm->execute([$agentId]);
        } else {
            // Prepare placeholders for the statuses
            $placeholders = implode(',', array_fill(0, count($statusList), '?'));

            // SQL to fetch rows where status_name IN (...)
            $sql = "SELECT * FROM {$table} WHERE receiver_agent_id = ? AND delivery_status IN ($placeholders)";
            $stm = $this->pdo->prepare($sql);

            // Merge parameters: agentId first, then status list
            $params = array_merge([$agentId], $statusList);
            $success = $stm->execute($params);
        }

        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $success ? $rows : [];
    }

    public function getById($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `id` =:id';
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function checkroute($table, $fromCityId, $toCityId)
    {
        $sql = "SELECT * FROM $table WHERE from_city_id = :from_city_id AND to_city_id = :to_city_id AND status = 'Active'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':from_city_id', $fromCityId);
        $stmt->bindValue(':to_city_id', $toCityId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // or fetchAll() if expecting multiple routes
    }


    public function checkadmin($table, $column, $value)
    {
        // $sql = 'SELECT * FROM ' . $table . ' WHERE `' . $column . '` = :value';
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value AND role_id = 2';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', $value);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    // public function getByRole($table, $id)
    // {
    //     $sql = 'SELECT * FROM ' . $table . ' WHERE `role_id` =:id';
    //     // print_r($sql);
    //     $stm = $this->pdo->prepare($sql);
    //     $stm->bindValue(':id', 2);
    //     $success = $stm->execute();
    //     $row = $stm->fetchAll(PDO::FETCH_ASSOC);
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

    public function getByDeliveryId($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `sender_id` =:sender_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':sender_id', $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
       //  print_r($row);
        return ($success) ? $row : [];
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

    public function setLogin($id)
    {
        $sql = 'UPDATE users SET `is_login` = :value WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', 1);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $stm->closeCursor();    // to solve PHP Unbuffered Queries
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function unsetLogin($id)
    {
        try {
            $sql        = "UPDATE users SET is_login = :false WHERE id = :id";
            $stm        = $this->pdo->prepare($sql);
            $stm->bindValue(':false', '0');
            $stm->bindValue(':id', $id);
            $success = $stm->execute();
            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
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

// }
