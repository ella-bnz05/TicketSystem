<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'ticketingsystem';

class ConfigClass
{
    public static $db;

    public static function dbConnect()
    {
        $host = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_DATABASE;

        try {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
            self::$db = new PDO($dsn, $username, $password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$db;
        } catch (PDOException $e) {
            echo 'Database connection error: ' . $e->getMessage();
            exit();
        }
    }

    public static function prepareAndExecute($query, $params)
    {
        try {
            // Check if the database connection is established
            if (!isset(self::$db)) {
                self::dbConnect();
            }

            $stmt = self::$db->prepare($query);
            $stmt->execute($params);

            return $stmt;
        } catch (PDOException $e) {
            echo 'Error executing query: ' . $e->getMessage();
            exit();
        }
    }

    public static function sanitizeInput($input)
    {
        switch (gettype($input)) {
            case 'string':
                if (preg_match('/^\d{4}-\d{8}[A-Z]{2}$/', $input)) {
                    // Sanitize varchar with the specified pattern
                    $input = strtoupper($input);
                } else {
                    $input = trim($input);
                    $input = stripslashes($input);
                    $input = htmlspecialchars($input);
                }
                break;
            case 'integer':
                $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'float':
                // Allow all numbers up to infinity
                $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION |
                    FILTER_FLAG_ALLOW_THOUSAND);
                break;
            case 'double':
                // Allow all numbers up to infinity
                $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION |
                    FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC);
                break;
            case 'boolean':
                $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'array':
                $input = array_map('sanitizeInput', $input);
                break;
            default:
                throw new InvalidArgumentException('Invalid input type: ' . gettype($input) . ' not supported');
        }

        return $input;
    }

//  public static function baseURL(): string
   // {
        // return 'http://localhost/JKPS-web-development/ON%20DEVELOPMENT/New-CITRMU-HelpDesk-Support-System-DEVELOPMENT/'; // LAPTOP
        // return 'http://localhost/.OFFICE_PROJECTS/New-CITRMU-HelpDesk-Support-System-DEVELOPMENT/'; // PC
   //     return 'http://172.16.200.246:4000/'; // SERVER
  //  }

}
