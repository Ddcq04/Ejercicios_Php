<?php
include_once "Producto.php";
include_once 'AccesoDatos.php';

function accionBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tproducto = $db->borrarProducto($id);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}

function accionAñadir(){
    $producto = new Producto();
    $producto->id  = "";
    $producto->nombre   = "";
    $producto->precio   = "";
    $producto->stock = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($id){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProducto($id);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($id){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProducto($id);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAñadir(){
    $producto = new Producto();
    $producto->id  = $_POST['id'];
    $producto->nombre   = $_POST['nombre'];
    $producto->precio   = $_POST['precio'];
    $producto->stock = $_POST['stock'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($producto);
    
}

function accionPostModificar(){
    
    $producto = new Producto();
    $producto->id  = $_POST['id'];
    $producto->nombre   = $_POST['nombre'];
    $producto->precio  = $_POST['precio'];
    $producto->stock = $_POST['stock'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($producto);   
}
