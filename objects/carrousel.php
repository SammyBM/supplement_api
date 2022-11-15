<?php

const IMG_DCTY = "C:/xampp/htdocs/supplement_api/imagenes/imagenes_carrousel/";

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

    // Se debe validar la carga de la imagen por fuera de esta función.
    public function create()
    {
        $query = "INSERT INTO " . $this->table_nombre . " (nombre_foto) VALUES (?);";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->nombre_foto, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
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


        if (!$row)
            return false;

        $this->nombre_foto = $row['nombre_foto'];

        return $this->nombre_foto;
    }

    public function read_by_name()
    {
        $query = "SELECT * FROM " . $this->table_nombre . " WHERE nombre_foto = ? LIMIT 1";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id, PDO::PARAM_STR);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!$row)
            return false;

        $this->nombre_foto = $row['nombre_foto'];
        $this->id = $row['id'];

        return $this->id;
    }

    public function delete()
    {

        $img = IMG_DCTY . $this->read_row();

        if (unlink($img)) {
            $query = "DELETE FROM " . $this->table_nombre . " WHERE fotoID = ?";
            $stmt = $this->connection->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                http_response_code(204);
                return true;
            }

            return false;
        } else
            http_response_code(404);
    }
}
