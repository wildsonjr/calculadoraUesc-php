<?php

################################################################################

error_reporting(0);

################################################################################

require_once 'wjr' . DIRECTORY_SEPARATOR . 'functions.php';

################################################################################

$formulario = array_get($_POST, 'formulario');
$quantidade = array_get($_POST, 'quantidade');
$creditos   = null;
$pontos     = null;
$media      = null;
$final      = null;
$situacao   = null;

################################################################################

if (intval($quantidade) > 0)
{
    if ($quantidade > 32)
    {
        $quantidade = 32;
    }
    
    $creditos = array();
    for ($i = 0; $i < $quantidade; $i++)
    {
        $lbl = 'lblCredito' . ($i + 1);
        $txt = 'txtCredito' . ($i + 1);
        $val = floatval(str_replace(',', '.', array_get($_POST, $txt)));
        
        $creditos = array_merge($creditos, array(
            '<label id="' . $lbl . '">' . ($i + 1) . 'º crédito:</label>',
            '<input id="' . $txt . '" name="' . $txt . '" class="small" type="text" value="' . $val . '">',
            '<br>',
        ));
        
        $pontos += $val;
    }
    $creditos = implode("\n                    ", $creditos) . "\n";
    
    if ($formulario === 'resultado')
    {
        $media    = $pontos / $quantidade;
        $final    = $media < 7 ? ((50 - ($media * 6)) / 4) : 0;
        $situacao = $final > 10 ? 'Reprovado' : ($final > 0 ? 'Final' : 'Aprovado');
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Calculadora UESC</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
    </head>
    <body>
        <div id="pagina">
            <form id="frmQuantidade" method="post" action="<?= basename(__FILE__) ?>">
                <div>
                    <input type="hidden" name="formulario" value="quantidade">
                    <label>Quantidade de créditos:</label>
                    <input type="text" name="quantidade" value="<?= $quantidade ?>">
                    <input type="submit" value="OK">
                </div>
            </form>
            <form id="frmResultado" method="post" action="<?= basename(__FILE__) ?>">
                <fieldset  id="fdsCreditos" class="border-box">
                    <legend>Créditos</legend>
                    <input type="hidden" name="formulario" value="resultado">
                    <input type="hidden" name="quantidade" value="<?= $quantidade ?>">
                    <?= $creditos ?>
                </fieldset>
                <fieldset id="fdsResultado" class="border-box">
                    <legend>Resultado</legend>
<?php if ($creditos) { ?>
                    <input type="submit" value="Calcular">
<?php } ?>
<?php if ($situacao) { ?>
                    <table>
                        <tr>
                            <th>Situação:</th>
                            <td><?= $situacao ?></td>
                        </tr>
                        <tr>
                            <th>Média:</th>
                            <td><?= $media ?></td>
                        </tr>
                        <tr>
                            <th>Final:</th>
                            <td><?= $final ?></td>
                        </tr>
                    </table>
<?php } ?>
                </fieldset>
                <div class="clear"></div>
            </form>
        </div>
        <div style="width: 500px; margin: 0 auto; text-align: right;">
            <a href="http://www.wjr.eti.br/" alt="WJr" target="_blank" style="color: #000;">WJr</a>
        </div>
    </body>
</html>