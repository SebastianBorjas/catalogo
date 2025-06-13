

<html>
<head>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    font-size:100%;
}

.sidebar {
    position: fixed;
    height: 100%;
    width: 0;
    top: 0;
    left: 0;
    z-index: 1;
    background-color: #00324b;
    overflow-x: hidden;
    transition: 0.4s;
    padding: 1rem 0;
    box-sizing:border-box;
}

.sidebar .boton-cerrar {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    font-size: 2rem;
    display: block;
    padding: 0;
    line-height: 1.5rem;
    margin: 0;
    height: 32px;
    width: 32px;
    text-align: center;
    vertical-align: top;
}

.sidebar ul, .sidebar li{
    margin:0;
    padding:0;
    list-style:none inside;
}

.sidebar ul {
    margin: 4rem auto;
    display: block;
    width: 80%;
    min-width:200px;
}

.sidebar a {
    display: block;
    font-size: 120%;
    color: #eee;
    text-decoration: none;
    
}

.sidebar a:hover{
    color:#fff;
    background-color: #f90;

}

h1 {
    color: white;
    font-size:180%;
    font-weight:normal;
}
#contenido {
    transition: margin-left .4s;
    padding: 1rem;
}

.abrir-cerrar {
    color: #2E88C7;
    font-size:1rem;   
}

#abrir {
    
}
#cerrar {
    display:none;
}



</style>
</head>

<div id="sidebar" class="sidebar" style="width: 230px; " >
<!--	<a href="#" class="boton-cerrar" onclick="ocultar()">X</a>-->
  <a class="navbar-brand" href="company_profile.php" style="margin-left: 25px; margin-right: 25px;">
    <img src="imagenes/LOGO-CANACINTRA DELEGACIÓN MONCLOVA BLANCO.png" alt="logo" style="width:150px;">
  </a>
      <nav class='animated bounceInDown'>
      <ul>
        <li><a href='company_profile.php'>Perfil/Profile</a></li><br>
         
        <li class='sub-menu'><a href='#settings'>Catálogo/Catalogue <div class='fa fa-caret-down right'></div></a><br>
          <ul>
            <li><a href='catalogo_busqueda.php'>Empresas</a></li>
           <!-- <li><a href='new_product.php'>Producto</a></li>
            <li><a href='new_process.php'>Proceso</a></li>
            <li><a href='new_customer.php'>Cliente</a></li>
            <li><a href='new_certification.php'>Certificación</a></li>-->
          </ul>
        </li>
        
        <li class='sub-menu'><a href='#settings'>Agregar nuevo <div class='fa fa-caret-down right'></div></a><br>
          <ul>
            <li><a href='new_product.php'>Producto</a></li>
            <li><a href='new_process.php'>Proceso</a></li>
            <li><a href='new_customer.php'>Cliente</a></li>
            <li><a href='new_certification.php'>Certificación</a></li>
          </ul>
        </li>
        <li class='sub-menu'><a href='#settings'>Concentrados <div class='fa fa-caret-down right'></div></a><br>
          <ul>
            <li><a href='products_table.php'>Productos</a></li>
            <li><a href='processes_table.php'>Procesos</a></li>
            <li><a href='customers_table.php'>Clientes</a></li>
            <li><a href='certifications_table.php'>Certificaciones</a></li>
          </ul>
        </li>

      <!--  <li class='sub-menu'><a href='#settings'>Catálogo clasificaciones<div class='fa fa-caret-down right'></div></a><br>
          <ul>
		  	<li><a href='admin/busqueda.php'>General-Empresas</a></li>
            <li><a href='admin/productos_generales.php'>Productos</a></li>
            <li><a href='admin/procesos_generales.php'>Procesos</a></li>
            <li><a href='admin/clientes_generales.php'>Clientes</a></li>
            <li><a href='admin/certificaciones_generales.php'>Certificaciones</a></li>
          </ul>
        </li>-->
       
            <li><a href='contact.php'>Contacto/Contact</a></li><br>
         
        <li><a href='salir.php'>Salir/Logout</a></li>
      </ul>
    </nav>
</div>

<!--<div id="contenido">
	<h1>Un menú lateral</h1>
	<a id="abrir" class="abrir-cerrar" href="javascript:void(0)" onclick="mostrar()" style="display: none;">Abrir menú</a>
	<a id="cerrar" class="abrir-cerrar" href="#" onclick="ocultar()" style="display: inline;">Cerrar menú</a>
</div>-->


</html>

<script>
/*function mostrar() {
    document.getElementById("sidebar").style.width = "260px";
    document.getElementById("nvartop").style.marginLeft = "260px";
    document.getElementById("contenido").style.marginLeft = "260px";
    document.getElementById("abrir").style.display = "none";
    document.getElementById("cerrar").style.display = "inline";
}

function ocultar() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("contenido").style.marginLeft = "0";
    document.getElementById("nvartop").style.marginLeft = "0";
    document.getElementById("abrir").style.display = "inline";
    document.getElementById("cerrar").style.display = "none";
}*/

$('.sub-menu ul').hide();
$(".sub-menu a").click(function () {
	$(this).parent(".sub-menu").children("ul").slideToggle("100");
	$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});
</script>
