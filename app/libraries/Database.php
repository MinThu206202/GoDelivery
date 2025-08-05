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
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);

            // ✅ Anonymous function avoids redeclaration
            $columns = array_map(function ($item) {
                return $item . '=:' . $item;
            }, $columns);

            $bindingSql = implode(',', $columns);
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `id` = :id';
            $stm = $this->pdo->prepare($sql);

            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }

            return $stm->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function changefromcitystatus($table, $id, $data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);

            // ✅ Anonymous function avoids redeclaration
            $columns = array_map(function ($item) {
                return $item . '=:' . $item;
            }, $columns);

            $bindingSql = implode(',', $columns);
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `from_city_id` = :id';
            $stm = $this->pdo->prepare($sql);

            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }

            return $stm->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function changetocitystatus($table, $id, $data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);

            // ✅ Anonymous function avoids redeclaration
            $columns = array_map(function ($item) {
                return $item . '=:' . $item;
            }, $columns);

            $bindingSql = implode(',', $columns);
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `to_city_id` = :id';
            $stm = $this->pdo->prepare($sql);

            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }

            return $stm->execute();
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

    public function checkroute($table, $fromTownshipId, $toTownshipId)
    {
        $sql = "SELECT * FROM $table WHERE from_township_id = :from_township_id AND to_township_id = :to_township_id AND status = 'Active'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':from_township_id', $fromTownshipId);
        $stmt->bindValue(':to_township_id', $toTownshipId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // or fetchAll() if expecting multiple routes
    }


    public function checkadmin($table, $column, $value)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value AND role_id = 2 AND status_id = 1';
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





    public function 
    columnFilter($table, $column, $value)
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

    public function filterDoubleColumn($table, $val1, $val2)
    {
        $sql = "SELECT * FROM $table WHERE from_township_id = :val1 AND to_township_id = :val2";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':val1', $val1);
        $stmt->bindParam(':val2', $val2);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getNotificationsByAgentId($agent_id)
    {
        $sql = "SELECT * FROM view_agent_messages WHERE to_agent_id = :agent_id ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':agent_id', $agent_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAgentsByTownship($township_name)
    {
        $sql = "SELECT * FROM user_full_info WHERE township_name = :township_name AND role_name = 'agent' AND status_name = 'Suspended' ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':township_name', $township_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDeliveryId($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `sender_agent_id` =:sender_agent_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':sender_agent_id', $id);
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


    public function getCalculatedPrice($distance)
    {
        $sql = "SELECT Calculateprice(:distance) AS price";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':distance', $distance); 
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $row ? $row['price'] : null; 
    }


    ///-----------------------------STORE PROCEDURE---------------------------///

    public function insertRoute($fromCityId, $fromTownshipId, $toCityId, $toTownshipId, $distance, $price, $status, $time)
    {
        $sql = "CALL Insertroute(:fromCityId, :fromTownshipId, :toCityId, :toTownshipId, :distance, :price, :status, :time)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':fromCityId', $fromCityId, PDO::PARAM_INT);
        $stmt->bindParam(':fromTownshipId', $fromTownshipId, PDO::PARAM_INT);
        $stmt->bindParam(':toCityId', $toCityId, PDO::PARAM_INT);
        $stmt->bindParam(':toTownshipId', $toTownshipId, PDO::PARAM_INT);
        $stmt->bindParam(':distance', $distance, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status); // string
        $stmt->bindParam(':time', $time, PDO::PARAM_INT); // integer time value

        return $stmt->execute(); // returns true on success
    }

    public function insertuser($name, $phone, $email, $region_id, $city_id, $township_id, $ward_id, $address, $password, $otp_code, $otp_expiry, $security_code, $role_id, $status_id, $created_at, $is_login)
    {
        $sql = "CALL Insertuser(:name, :phone, :email, :region_id, :city_id, :township_id, :ward_id, :address, :password, :otp_code, :otp_expiry, :security_code, :role_id, :status_id, :created_at, :is_login)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':region_id', $region_id, PDO::PARAM_INT);
        $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        $stmt->bindParam(':township_id', $township_id, PDO::PARAM_INT);
        $stmt->bindParam(':ward_id', $ward_id, PDO::PARAM_INT);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':otp_code', $otp_code);
        $stmt->bindParam(':otp_expiry', $otp_expiry);
        $stmt->bindParam(':security_code', $security_code);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':is_login', $is_login, PDO::PARAM_BOOL);

        return $stmt->execute();
    }



}







