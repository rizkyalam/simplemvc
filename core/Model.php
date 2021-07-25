<?php 

namespace Core;

use PDO;

abstract class Model
{
    protected $table = '';
    protected $primary_key = 'id';
    protected $fillable = [];

    public function create($data)
    {

        $query = "INSERT INTO ".$this->table." (";

        foreach ($this->fillable as $fill) {
            $query .= "$fill, ";
        }

        $query = trim($query, ', ') . ") VALUES (";

        foreach ($this->fillable as $fill) {
            $query .= ":$fill, ";
        }

        $query = trim($query, ', ') . ")";

        $conn = Database::connect();

        $stmt = $conn->prepare($query);

        foreach ($this->fillable as $fill) {
            $stmt->bindParam($fill, $data[$fill]);
        }

        $stmt->execute();
    }

    private function show($query)
    {
        $stmt = Database::connect()->prepare($query);
        $stmt->execute();
        $rows = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function all()
    {
        $query = "SELECT * FROM " . $this->table;

        return $this->show($query);
    }

    public function get($select, $where = [])
    {
        $query = "SELECT ";

        foreach ($select as $data) {
            $query .= "$data, ";
        }
        
        $query = trim($query, ', ') . " FROM ". $this->table . " ";
        
        if (count($where) > 0) {
            $query .= " WHERE ";

            foreach ($where as $key => $val) {
                $query .= "$key = $val AND ";
            }

            $query = trim($query, ' AND');
        }

        return $this->show($query);
    }

    public function update($data, $id)
    {
        $query = "UPDATE ".$this->table." SET ";

        foreach ($this->fillable as $fill) {
            $query .= "$fill = :$fill, ";
        }

        $query = trim($query, ', ').
                " WHERE ".$this->primary_key." = :". $this->primary_key;

        $conn = Database::connect();

        $stmt = $conn->prepare($query);
        $stmt->bindParam($this->primary_key, $id);

        foreach ($this->fillable as $fill) {
            $stmt->bindParam($fill, $data[$fill]);
        }
        
        $stmt->execute();
    }

    public function delete($id)
    {
        $conn = Database::connect();

        $query = "DELETE FROM ".$this->table.
                 " WHERE ".$this->primary_key." = :". $this->primary_key;

        $stmt = $conn->prepare($query);
        $stmt->bindParam($this->primary_key, $id);
        $stmt->execute();
    }
}