<?php

class Carrousel
{

    private $connection;
    private $table_nombre = "fotos_carrusel";
    public  $id;
    public  $nombre_foto;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function create()
    {

        if ($isFileUpload !== false) {

            $query = "INSERT INTO " . $this->table_nombre . " nombre_foto = ?";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } else {
        }
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_nombre;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_row()
    {
        $query = "SELECT nombre_foto FROM " . $this->table_nombre . " WHERE fotoID = ? LIMIT 1";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['fotoID'];
        $this->nombre_foto = $row['nombre_foto'];
    }

    public function delete()
    {

    }
}
