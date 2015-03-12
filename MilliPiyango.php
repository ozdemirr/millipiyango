<?php

class MilliPiyango
{

    private $sonucAdresi = "http://www.millipiyango.gov.tr/sonuclar/cekilisler/";

    private $tarihListesiAdresi = "http://www.millipiyango.gov.tr/sonuclar/listCekilisleriTarihleri.php?tur=";

    public function cekilisSonucuGetir($cekilis, $tarih){

        if(is_array($tarih)) {

            $sonuc = array();

                foreach($tarih as $t) {

                    $sonuc[] = $this->cekilisSonucuGetir($cekilis, $t);

                }

        } elseif(is_string($tarih)) {

            $sonuc = json_decode(file_get_contents($this->servisAdresiGetir($cekilis, "sonuc", $tarih)));

        } else {

            $tarihler = $this->tarihleriGetir($cekilis, $tarih);

            $sonuc = $this->cekilisSonucuGetir($cekilis, $tarihler);

        }

        return $sonuc;

    }

    public function tarihleriGetir($cekilis, $hafta = null){

        $tarihler = json_decode(file_get_contents($this->servisAdresiGetir($cekilis, "tarih")));

            if(isset($hafta)) {

                $tarihler = array_slice($tarihler, 0, (int)$hafta);

            }

        $tarihler = array_map(function($tarih){

            return $tarih->tarih;

        }, $tarihler);

        return $tarihler;

    }

    public function servisAdresiGetir($cekilis, $tip, $tarih = null){

        switch($tip) {

            case "sonuc":
                return $this->sonucAdresi.$cekilis."/".$tarih.".json";
                break;
            case "tarih":
                return $this->tarihListesiAdresi.$cekilis;
                break;
            default:
                return "";
        }

    }

}