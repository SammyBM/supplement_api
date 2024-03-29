<?php
include '../imagenes/imageController.php';
class Articulo
{
    private $connection;
    private $table_nombre = "articulos";

    public $articuloID;
    public $titulo;
    public $etiquetas;
    public $imagen;
    public $categoriaID;
    public $tamanoPorcion;
    public $calorias;
    public $proteina;
    public $lipidos;
    public $carbohidratos;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_nombre;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create()
    {
        $etiquetas = "";
        $temp = json_decode($this->etiquetas, true);
        for ($i = 0; $i < sizeof($temp); $i++) {
            if ($etiquetas == "") {
                $etiquetas = "#" . $temp[$i]["etiqueta"];
            } else {
                $etiquetas = $etiquetas . ",#" . $temp[$i]["etiqueta"];
            }
        }
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $etiquetas = htmlspecialchars(strip_tags($etiquetas));
        $this->categoriaID = htmlspecialchars(strip_tags($this->categoriaID));
        $this->tamanoPorcion = htmlspecialchars(strip_tags($this->tamanoPorcion));
        $this->calorias = htmlspecialchars(strip_tags($this->calorias));
        $this->proteina = htmlspecialchars(strip_tags($this->proteina));
        $this->lipidos = htmlspecialchars(strip_tags($this->lipidos));
        $this->carbohidratos = htmlspecialchars(strip_tags($this->carbohidratos));
        $query = "INSERT INTO " .
            $this->table_nombre .
            " VALUES(NULL,'" . $this->titulo . "',
            '" . $etiquetas . "',
            '" . $this->imagen->imageName . "',
            '" . $this->categoriaID . "',
            '" . $this->tamanoPorcion . "',
            '" . $this->calorias . "',
            '" . $this->proteina . "',
            '" . $this->lipidos . "',
            '" . $this->carbohidratos . "')";
        $result = mysqli_query($this->connection, $query);
        $id = mysqli_insert_id($this->connection);
        if (uploadProductImage($this->imagen->imageName, $this->imagen->imageSrc, $id)) {
            if ($result) {
                return json_encode("{status:true,data:" . $id . "}");
            } else {
                return json_encode("{status:false}");
            }
        } else {
            return json_encode("{status:false}");
        }
    }

    function readRow()
    {
        $query = "SELECT a.titulo, a.etiquetas, a.imagen, c.categoriaID, a.tamanoPorcion, a.calorias, a.proteina, a.lipidos, a.carbohidratos FROM " . $this->table_nombre . " AS a 
        INNER JOIN categorias AS c ON a.categoriaID = c.categoriaID
        WHERE articuloID = ? LIMIT 1";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->titulo = $row['titulo'];
        $this->etiquetas = $row['etiquetas'];
        $this->imagen = $row['imagen'];
        $this->categoriaID = $row['categoriaID'];
        $this->tamanoPorcion = $row['tamanoPorcion'];
        $this->calorias = $row['calorias'];
        $this->proteina = $row['proteina'];
        $this->lipidos = $row['lipidos'];
        $this->carbohidratos = $row['carbohidratos'];
    }

    function readByProps()
    {
        $query = "SELECT * FROM " . $this->table_nombre . " WHERE categoriaID=:categoriaID,tamanoPorcion BETWEEN :tamanoPorcionLow AND :tamanoPorcionHigh, calorias BETWEEN :caloriasLow AND :caloriasHigh, proteina BETWEEN :proteinaLow AND :proteinaHigh, lipidos BETWEEN :lipidosLow AND :lipidosHigh, carbohidratos BETWEEN :carbohidratosLow AND :carbohidratosHigh";

        $stmt = $this->connection->prepare($query);

        $this->categoriaID = htmlspecialchars(strip_tags($this->categoriaID));
        $this->tamanoPorcion = htmlspecialchars(strip_tags($this->tamanoPorcion));
        $this->calorias = htmlspecialchars(strip_tags($this->calorias));
        $this->proteina = htmlspecialchars(strip_tags($this->proteina));
        $this->lipidos = htmlspecialchars(strip_tags($this->lipidos));
        $this->carbohidratos = htmlspecialchars(strip_tags($this->carbohidratos));

        $stmt->bindParam(':etiquetas', $this->etiquetas);
        $stmt->bindParam(':categoriaID', $this->categoriaID);
        $stmt->bindParam('tamanoPorcionLow', $this->tamanoPorcion * .9);
        $stmt->bindParam('tamanoPorcionHigh', $this->tamanoPorcion * 1.1);
        $stmt->bindParam('caloriasLow', $this->calorias * .9);
        $stmt->bindParam('caloriasHigh', $this->calorias * 1.1);
        $stmt->bindParam('proteinaLow', $this->proteina * .9);
        $stmt->bindParam('proteinaHigh', $this->proteina * 1.1);
        $stmt->bindParam('lipidosLow', $this->lipidos * .9);
        $stmt->bindParam('lipidosHigh', $this->lipidos * 1.1);
        $stmt->bindParam('carbohidratosLow', $this->carbohidratos * .9);
        $stmt->bindParam('carbohidratosHigh', $this->carbohidratos * 1.1);

        $stmt->execute();

        return $stmt;
    }

    function update()
    {
        $query = "UPDATE" . $this->table_nombre . "SET titulo=:titulo, etiquetas=:etiquetas, imagen=:imagen,categoriaID=:categoriaID,tamanoPorcion=:tamanoPorcion,calorias=:calorias, proteina=:proteina, lipidos=:lipidos, carbohidratos=:carbohidratos WHERE articuloID = :id";

        $stmt = $this->connection->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->etiquetas = htmlspecialchars(strip_tags($this->etiquetas));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
        $this->categoriaID = htmlspecialchars(strip_tags($this->categoriaID));
        $this->tamanoPorcion = htmlspecialchars(strip_tags($this->tamanoPorcion));
        $this->calorias = htmlspecialchars(strip_tags($this->calorias));
        $this->proteina = htmlspecialchars(strip_tags($this->proteina));
        $this->lipidos = htmlspecialchars(strip_tags($this->lipidos));
        $this->carbohidratos = htmlspecialchars(strip_tags($this->carbohidratos));

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':etiquetas', $this->etiquetas);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':categoriaID', $this->categoriaID);
        $stmt->bindParam('tamanoPorcion', $this->tamanoPorcion);
        $stmt->bindParam('calorias', $this->calorias);
        $stmt->bindParam('proteina', $this->proteina);
        $stmt->bindParam('lipidos', $this->lipidos);
        $stmt->bindParam('carbohidratos', $this->carbohidratos);
        $stmt->bindParam(':id', $this->articuloID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_nombre . " WHERE articuloID = ?";
        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        echo json_encode($stmt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
