<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Productos y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 2: El contructor crea las sentencias precompiladas
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_producto = null;
    private $stmt_productos = null;
    private $stmt_borproducto  = null;
    private $stmt_modproducto  = null;
    private $stmt_creaproducto = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
        $this->stmt_productos  = $this->dbh->prepare("select * from productos");
        $this->stmt_producto   = $this->dbh->prepare("select * from productos where id=:id");
        $this->stmt_borproducto   = $this->dbh->prepare("delete from productos where id =:id");
        $this->stmt_modproducto   = $this->dbh->prepare("update productos set nombre=:nombre, precio=:precio, stock=:stock where id=:id");
        $this->stmt_creaproducto  = $this->dbh->prepare("insert into productos (id,nombre,precio,stock) Values(?,?,?,?)");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_producto = null;
            $obj->stmt_productos = null;
            $obj->stmt_borproducto  = null;
            $obj->stmt_modproducto  = null;
            $obj->stmt_creaproducto = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Productos
    public function getProductos ():array {
        $tproductos = [];
        $this->stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        
        if ( $this->stmt_productos->execute() ){
            while ( $producto = $this->stmt_productos->fetch()){
               $tproductos[]= $producto;
            }
        }
        return $tproductos;
    }
    // Devuelvo un producto o false
    public function getProducto(String $id) {
        $producto = false;
        
        $this->stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $this->stmt_producto->bindParam(':id', $id);
        if ( $this->stmt_producto->execute() ){
             if ( $obj = $this->stmt_producto->fetch()){
                $producto= $obj;
            }
        }
        return $producto;
    }
    // UPDATE
    public function modProducto($producto):bool{
      
        $this->stmt_modproducto->bindValue(':id',$producto->id);
        $this->stmt_modproducto->bindValue(':nombre',$producto->nombre);
        $this->stmt_modproducto->bindValue(':precio',$producto->precio);
        $this->stmt_modproducto->bindValue(':stock',$producto->stock);
        $this->stmt_modproducto->execute();
        $resu = ($this->stmt_modproducto->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($producto):bool{
        
        $this->stmt_creaproducto->execute( [$producto->id, $producto->nombre, $producto->precio, $producto->stock]);
        $resu = ($this->stmt_creaproducto->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $id):bool {
        $this->stmt_borproducto->bindValue(':id', $id);
        $this->stmt_borproducto->execute();
        $resu = ($this->stmt_borproducto->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

