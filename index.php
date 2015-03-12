<?php

require_once 'MilliPiyango.php';
require_once 'CekilisTipEnum.php';

$milliPiyango = new MilliPiyango();

/**
 * son x hafta
 * $sonuc değişkeni, her haftanın sonucunun object olarak tutulduğu bir dizi olarak dönmektedir.
 * İstenirse DB' ye kaydedilir, istenirse Cache' e atılabilir, yada aşağıdaki gibi basitçe listelenebilir.
 * Çekiliş Tipini CekilisTipEnum' dan seçebilirsiniz.
 */
$sonuclar = $milliPiyango->cekilisSonucuGetir(CekilisTipEnum::SAYISAL_LOTO, 3);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Milli Piyango Sonuçları</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<div class="container">
    <h2><?=$sonuclar[0]->data->cekilisTuru?></h2>
<ul class="list-group">

    <?php foreach($sonuclar as $sonuc) { ?>

    <li class="list-group-item">

        <div class="panel panel-<?php if($sonuc->data->devretti) { echo "danger"; } else { echo "primary"; } ?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$sonuc->data->cekilisTarihi?></h3>
            </div>
            <div class="panel-body">
                <?=$sonuc->data->rakamlarNumaraSirasi?>
            </div>
            <table class="table">

                <?php foreach($sonuc->data as $indis => $deger) { ?>

                <tr>

                    <td><?=$indis?></td>

                    <td><?php if( is_array($deger) ) { /*echo implode(' , ', $deger );*/ } else { echo $deger; }?></td>

                </tr>

                <?php } ?>

            </table>
        </div>

    </li>

    <? } ?>

</ul>
</div>
</body>
</html>

