<?php 

namespace Core;

use PDO;

abstract class Model
{
    /**
     * The properties that point to database table.
     * 
     * @var string
     */
    protected $table = '';

    /**
     * The properties that point to primary key table.
     * 
     * @var string The default primary key is "id"
     */
    protected $primary_key = 'id';

    /**
     * The properties that should be 
     * fill of list rows table for insert or update.
     * 
     * @var array
     */
    protected $fillable = [];

    /**
     * Insert a new data to database.
     * 
     * @param $data
     */
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

    /**
     * Display data from database.
     * 
     * @param $query
     * @return array
     */
    private function _show($query)
    {
        $stmt = Database::connect()->prepare($query);
        $stmt->execute();
        $rows = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Display of all data.
     * 
     * @return array
     */
    public function all()
    {
        $query = "SELECT * FROM " . $this->table;

        return $this->_show($query);
    }

    /**
     * Display the specified data.
     * 
     * @param $select Show selected data.
     * @param $where Add a basic where clause to the query.
     * @return array
     */
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

        return $this->_show($query);
    }

    /**
     * Updating a specified data in database.
     * 
     * @param $data
     * @param $id
     */
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

    /**
     * Delete a specified data in database.
     * 
     * @param $id
     */
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
