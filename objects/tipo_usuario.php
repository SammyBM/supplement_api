<?php
class TipoUsuario
{
    private $connection;
    private $table_name = "tipos_usuario";

    public $tipoUsuarioID;
    public $tipo;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
