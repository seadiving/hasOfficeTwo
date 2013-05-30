<?php
/**
 * Mapper for {@link Todo} from array.
 * @see TodoValidator
 */
final class TitoliMapper {

    private function __construct() {
    }
    /**
     * Maps array to the given {@link Titoli}.
     * <p>
     * Expected properties are:
     * <ul>
     *   <li>id</li>
     *   <li>autore</li>
     *   <li>esecutore</li>
     *   <li>cc_cn</li>
     *   <li>editore</li>
     *   <li>brano</li>
     *   <li>isrc</li>
     *   <li>produzioni_casa_id</li>
     *   <li>durata</li>
     *   <li>data_creazione</li>
     *   <li>isrc_video</li>
     *   <li>compositore</li>
     *   <li>altri_esecutori</li>
     *   <li>genere</li>
     *   <li>anno</li>
     *   <li>filepath</li>

     * </ul>
     */
    public static function map(Titoli $titoli, array $properties) {
        if (array_key_exists('ID', $properties)) {
            $titoli->setId($properties['ID']);
        }
        if (array_key_exists('autore', $properties)) {
            $titoli->setAutore($properties['autore']);
        }
        if (array_key_exists('esecutore', $properties)) {
            $titoli->setEsecutore($properties['esecutore']);
        }

        if (array_key_exists('descrizione', $properties)) {
            $titoli->setDescrizione(trim($properties['descrizione']));
        }
        if (array_key_exists('cc_cn', $properties)) {
            $titoli->setCcCn(trim($properties['cc_cn']));
        }
        if (array_key_exists('editore', $properties)) {
            $titoli->setEditore($properties['editore']);
        }
        if (array_key_exists('brano', $properties)) {
            $titoli->setBrano($properties['brano']);
        }
        if (array_key_exists('ISRC', $properties)) {
            $titoli->setIsrc($properties['ISRC']);
        }
        if (array_key_exists('produzioni_casa_id', $properties)) {
            $titoli->setProduzioniCasaId($properties['produzioni_casa_id']);
        }
        if (array_key_exists('durata', $properties)) {
            $titoli->setDurata($properties['durata']);
        }
        if (array_key_exists('data_creazione', $properties)) {
            $dataCreazione = self::createDateTime($properties['data_creazione']);
            if ($dataCreazione) {
                $titoli->setDataCreazione($dataCreazione);
            }
        }
        if (array_key_exists('isrc_video', $properties)) {
            $titoli->setISRCVideo($properties['isrc_video']);
        }
        
        if (array_key_exists('compositore', $properties)) {
            $titoli->setCompositore($properties['compositore']);
        }
        if (array_key_exists('altri_esecutori', $properties)) {
            $titoli->setAltriEsecutori($properties['altri_esecutori']);
        }
        if (array_key_exists('genere', $properties)) {
            $titoli->setGenere($properties['genere']);
        }
        if (array_key_exists('anno', $properties)) {
            $titoli->setAnno($properties['anno']);
        }
        if (array_key_exists('filepath', $properties)) {
            $titoli->setFilepath($properties['filepath']);
        }
        if (array_key_exists('proprieta_master', $properties)) {
            $titoli->setProprietaMaster($properties['proprieta_master']);
        }
        if (array_key_exists('tipo_prod_titoli', $properties)) {
            $titoli->setTipoProdTitoli($properties['tipo_prod_titoli']);
        }
        if (array_key_exists('note', $properties)) {
            $titoli->setNote($properties['note']);
        } 
        if (array_key_exists('tipo_trattativa', $properties)) {
            $titoli->setTipoTrattativa($properties['tipo_trattativa']);
        }
        if (array_key_exists('prezzo_base', $properties)) {
            $titoli->setPrezzoBase($properties['prezzo_base']);
        }
        if (array_key_exists('cantato', $properties)) {
            $titoli->setCantato($properties['cantato']);
        }
        //aggiunti
         if (array_key_exists('compositore', $properties)) {
            $titoli->setCompositore($properties['compositore']);
        }
          if (array_key_exists('genere', $properties)) {
            $titoli->setGenere($properties['genere']);
        }       
          if (array_key_exists('subgenere', $properties)) {
            $titoli->setSubgenere($properties['subgenere']);
        }
           if (array_key_exists('prezzo_minimo', $properties)) {
            $titoli->setPrezzoMinimo($properties['prezzo_minimo']);
        }
        if (array_key_exists('testo_brano', $properties)) {
            $titoli->setTestoBrano($properties['testo_brano']);
        }             
        //aggiunti da trasformare
        if (array_key_exists('Sproduzioni_casa', $properties)) {
            $appo = array();
            $appo = explode('-', $properties['Sproduzioni_casa']);
            $titoli->setProduzioniCasaId($appo[0]);
            $titoli->setProduzioniCasa($appo[1]);
        }
        if (array_key_exists('Sdurata', $properties)) {
            $appo = array();
            $appo = explode('-', $properties['Sdurata']);
            $ciccio =trim($appo[0])== ''?0:intval(trim($appo[0]));
            $titoli->setDurata(TitoliMapper::convertSecMin(trim($appo[0])== ''?0:intval(trim($appo[0])),trim($appo[1])== ''?0:intval(trim($appo[1]))));
        } 

    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }
    
    private static function convertSecMin($minuti,$secondi){
        $secondiMin = $minuti*60;
        return $secondiMin + $secondi;
    }

}

?>
