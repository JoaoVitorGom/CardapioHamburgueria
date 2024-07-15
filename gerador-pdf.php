<?php
// Inclui a biblioteca Dompdf através do autoload do Composer
require "vendor/autoload.php";

// Usa o namespace Dompdf
use Dompdf\Dompdf;

// Cria uma instância do Dompdf
$dompdf = new Dompdf();

// Inicia o buffer de saída para capturar o conteúdo do arquivo conteudo-pdf.php
ob_start();
require "conteudo-pdf.php"; // Inclui o conteúdo HTML que será convertido em PDF
$html = ob_get_clean(); // Captura o conteúdo do buffer e limpa o buffer

// Carrega o HTML no Dompdf
$dompdf->loadHtml($html);

// (Opcional) Configura o tamanho do papel e a orientação (padrão é A4)
$dompdf->setPaper('A4');

// Renderiza o HTML para PDF
$dompdf->render();

// Saída do PDF gerado para o navegador (stream)
$dompdf->stream();
?>
