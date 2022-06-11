<?php
class DatabaseTable
{
    private $table;
    private $pdo;

    public function __construct($pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    function save($record, $primaryKey)
    {
        try {
            $this->insert($this->pdo, $this->table, $record);
        } catch (Exception $e) {
            $this->update($this->pdo, $this->table, $record, $primaryKey);
        }
    }
    //fuction to select from database table
    public function select($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = (:value)');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }
    //function to delete from a database table
    public function delete($field, $value)
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        // return $stmt->fetch();
    }

    //function to insert from a database table
    function insert($record)
    {
        $keys = array_keys($record);
        $values = implode(', ', $keys);
        $valuesWithColon = implode(', :', $keys);
        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    //function to update from a database table
    function update($record, $primaryKey)
    {
        $query = 'UPDATE ' . $this->table . ' SET ';
        $parameters = [];
        foreach ($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }
        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
        $record['primaryKey'] = $record[$primaryKey];
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    //function to store image
    function imageCheck($image)
    {
        //(Krossing, 2016)

        $fileName = $image['name'];
        $fileTmpName = $image['tmp_name'];
        $fileError = $image['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                $filenameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination1 = 'images/' . $filenameNew;
                $fileDestination2 = '../images/' . $filenameNew;

                move_uploaded_file($fileTmpName, $fileDestination2);
                return $fileDestination1;
            } else {
                echo 'Error uploading picture';
            }
        } else {
            echo 'Incompatible file format';
        }
    }

    function selectAllArt($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . 'JOIN auction on ' . $this->table . '.auction_id = auction.id WHERE ' . $field . ' = (:value)');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }
}
