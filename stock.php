<?php
    if (isset($_POST["txt"])) {
        $txt = $_POST["txt"];
        $data = file_get_contents_utf8('https://www.fundamentus.com.br/detalhes.php?papel='.$txt);
        $cotacao = recuperaCotacao($data);
        echo $cotacao;
    } 

    function recuperaCotacao($data) {
        $pos = strpos($data, '<span class="txt">Cotação</span>');
        $rest = substr($data, $pos+74);
        return str_replace(",", ".", substr($rest, 18, 5));
    }
    
    function file_get_contents_utf8($fn) {
        $content = file_get_contents($fn);
         return mb_convert_encoding($content, 'UTF-8',
             mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Quote</title>
</head>
<body>
    
    <h1>Cotação</h1>
    <div>
        <form action="" method="POST" name="frm">
            <label for="txt">Empresa/Papel:</label>
            <input type="text" name="txt" id="txt" />
            <input type="submit" value="Cotar" />
        </form>
    </div>

</body>
</html>