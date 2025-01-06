<?php

declare(strict_types=1);

class Task
{
    /**
     * @var PDO
     */

    #singleton

        private static $instance = null;
        private $connection;
    
        private function __construct() {
            $this->connection = new PDO('mysql:host=localhost;dbname=list', 'root', '1507FriedLiver.c');
        }
    
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
    
        public function getConnection() {
            return $this->connection;
        }
    
    
    
    public function insert(string $description): int
    {
        $sql = 'insert into tasks(descricao) values(?)';
 
        $prepare = $this->connection->prepare($sql); 
    
        $prepare->bindParam(1, $description); # metodo que possui prevencao contra sql injection
        $prepare->execute();
    
        return $prepare->rowCount();
        
    }
    public function list(): array #Read
    {
        $sql = 'select * from tasks';

        $tasks = [];
        
        foreach ($this->connection->query($sql) as $value) {
            
            array_push($tasks, $value);
        }
        return $tasks;

    
    }
    public function update(string $newDescription, int $id): int
    {
        $sql = 'update tasks set descricao = ?  where id = ?';
        
        $prepare = $this->connection-> prepare($sql);
        
        $prepare->bindParam(1, $newDescription);
        $prepare->bindParam(2, $id);
        
        $prepare -> execute();
        
        return $prepare->rowCount();
        
    }
    public function upStatus(bool $is_done, int $id): int
    {
        $sql = 'update tasks set is_done = ?  where id = ?';
        
        $prepare = $this->connection-> prepare($sql);
        
        $prepare->bindParam(1, $is_done);
        $prepare->bindParam(2, $id);
        
        $prepare -> execute();

        return $prepare->rowCount();
          
    }
    public function delete(int $id): int #Delete
    {
        $sql = 'delete from tasks where id = ?';

        $prepare = $this->connection->prepare($sql);
        
        $prepare->bindParam(1, $id);
        $prepare->execute();
        
        return $prepare->rowCount();
        
               
    }
    public function deleteAll(): void
    {
        $sql = "TRUNCATE TABLE tasks"; #Truncar a tabela (remove todos os dados e reseta o contador):
        $prepare = $this->connection->prepare($sql);
        $prepare->execute();  
               
    }
    public function __destruct()
    {
        $this->connection = null;
    }

};



?>