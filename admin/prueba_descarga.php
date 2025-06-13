<?php
header("Content-disposition: attachment; filename= ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA_CORTO.pdf");
header("Content-type: application/pdf");
readfile("CATÁLOGO_CAPACIDADES_EMPRESA_CORTO.pdf");
?>