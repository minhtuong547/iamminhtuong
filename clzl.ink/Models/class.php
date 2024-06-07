<?php
// require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/Model/config.php');
class VIP
{
    // Các biến thông tin kết nối
    private $hostname = SERVERNAME,
    $username = USERNAME,
    $password = PASSWORD,
    $dbname = DATABASE;

    // Biến lưu trữ kết nối
    public $cn = null;

    // Hàm kết nối
    public function connect()
    {
        $this->cn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);

        if (!$this->cn) {
            header('Location: /404');
            exit;
        }
        mysqli_set_charset($this->cn, "utf8");
        return $this->cn;
    }
    // Hàm kết nối
    public function get_config()
    {
        $config = array("hostname" => $this->hostname, "username" => $this->username, "password" => $this->password, "dbname" => $this->dbname);
        return $config;
    }
    // Hàm chống sql injection
    public function real_escape_string($sql = null)
    {
        if ($this->cn) {
            return mysqli_real_escape_string($this->cn, $sql);
        }

    }
    // Hàm ngắt kết nối
    public function close()
    {
        if ($this->cn) {
            mysqli_close($this->cn);
        }
    }

    // Hàm truy vấn
    public function query($sql = null)
    {
        if ($this->cn) {
            mysqli_query($this->cn, $sql);
        }
    }

    public function query2($sql = null)
    {
        if ($this->cn) {
            mysqli_query($this->cn, $sql);
        }
    }

    // Hàm đếm số hàng

    // Hàm đếm tổng số hàng
    public function fetch_row($sql = null)
    {
        if ($this->cn) {
            $query = mysqli_query($this->cn, $sql);
            if ($query) {
                $row = $query->fetch_row();
                return $row[0];
            }
        }
    }

    // Hàm lấy dữ liệu
    public function fetch_assoc($sql = null, $type)
    {
        if ($this->cn) {
            $query = mysqli_query($this->cn, $sql);
            if ($query) {
                if ($type == 0) {
                    $data = array();
                    // Lấy nhiều dữ liệu gán vào mảng
                    while ($row = mysqli_fetch_assoc($query)) {
                        $data[] = $row;
                    }
                    return $data;
                } else if ($type == 1) {
                    // Lấy một hàng dữ liệu gán vào biến
                    $data = mysqli_fetch_assoc($query);
                    return $data;
                }
            }
        }
    }
    public function insert2($tableName, $insData)
    {
        $columns = implode(", ", array_keys($insData));
        $escaped_values = array_map('mysql_real_escape_string', array_values($insData));
        foreach ($escaped_values as $idx => $data) {
            $escaped_values[$idx] = "'" . $data . "'";
        }

        $values = implode(", ", $escaped_values);
        $query = "INSERT INTO $tableName ($columns) VALUES ($values)";
        $insert = mysqli_query($this->cn, $query);
        if (!$insert) {
            return mysqli_error($this->cn);
        }
    }
    // Hàm lấy ID cao nhất
    public function insert_id()
    {
        if ($this->cn) {
            $count = mysqli_insert_id($this->cn);
            if ($count == '0') {
                $count = '1';
            } else {
                $count = $count;
            }
            return $count;
        }
    }

    // Hàm charset cho database
    public function set_char($uni)
    {
        if ($this->cn) {
            mysqli_set_charset($this->cn, $uni);
        }
    }

    public function getUsers($data)
    {
        if ($this->cn) {
            $row = $this->cn->query("SELECT * FROM `users` WHERE `email` = '" . $_SESSION['username'] . "' ")->fetch_array();
            return $row[$data];
        }
    }
    public function site($data)
    {
        if ($this->cn) {
            $row = $this->cn->query("SELECT * FROM `settings`  ")->fetch_array();
            return $row[$data];
        }
    }
    public function insert($table, $data)
    {
        if ($this->cn) {
            $field_list = '';
            $value_list = '';
            foreach ($data as $key => $value) {
                $field_list .= ",$key";
                $value_list .= ",'" . mysqli_real_escape_string($this->cn, $value) . "'";
            }
            $sql = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
            // echo $sql; die;
            return mysqli_query($this->cn, $sql);
        }
    }
    public function update($table, $data, $where)
    {
        if ($this->cn) {
            $sql = '';
            foreach ($data as $key => $value) {
                $sql .= "$key = '" . mysqli_real_escape_string($this->cn, $value) . "',";
            }
            $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;
            // echo $sql;
            // die;
            return mysqli_query($this->cn, $sql);
        }
    }

    public function remove($table, $where)
    {
        if ($this->cn) {
            $sql = "DELETE FROM $table WHERE $where";
            return mysqli_query($this->cn, $sql);
        }
    }
    public function get_list($sql)
    {
        if ($this->cn) {
            $result = mysqli_query($this->cn, $sql);
            if (!$result) {
                die('Lỗi kết nối database ');
            }
            $return = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $return[] = $row;
            }
            mysqli_free_result($result);
            return $return;
        }
    }
    public function get_row($sql)
    {
        if ($this->cn) {
            $result = mysqli_query($this->cn, $sql);
            if (!$result) {
                die('Lỗi kết nối database 2');
            }
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if ($row) {
                return $row;
            }
            return false;
        }
    }
    public function num_rows($sql)
    {
        if ($this->cn) {
            $result = mysqli_query($this->cn, $sql);
            if (!$result) {
                die('Lỗi kết nối database 2');
            }
            $row = mysqli_num_rows($result);
            mysqli_free_result($result);
            if ($row) {
                return $row;
            }
            return '0';
        }
    }

    public function xss_num_rows($sql, $params = array())
    {
        if ($this->cn) {
            // Chuẩn bị câu truy vấn với tham số
            $stmt = $this->cn->prepare($sql);
            // Gán dữ liệu cho từng tham số
            if (!empty($params)) {
                $types = '';
                $values = array();

                foreach ($params as $paramName => $paramValue) {
                    $types .= 's'; // 's' đại diện cho kiểu dữ liệu chuỗi, bạn có thể thay đổi kiểu dữ liệu tùy thuộc vào kiểu dữ liệu của từng tham số
                    $values[] = $paramValue;
                }

                $stmt->bind_param($types, ...$values);
            }
            // Thực thi câu truy vấn
            $stmt->execute();
            // Lấy số hàng kết quả
            $stmt->store_result();
            $row = $stmt->num_rows;
            // Đóng kết nối
            $stmt->close();
            if ($row) {
                return $row;
            }
            return '0';
        }  else {
            echo "Lỗi Kết Nối Database"; die;
        }
    }

}
