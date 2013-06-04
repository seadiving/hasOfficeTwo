<?php
/**
 * Mapper for {@link Todo} from array.
 * @see TodoValidator
 */
final class GeneriMapper {

    private function __construct() {
    }
 
    public static function map(Generi $generi, array $properties) {
        if (array_key_exists('ID', $properties)) {
            $generi->setId($properties['ID']);
        }
        if (array_key_exists('genere', $properties)) {
            $generi->setGenere($properties['genere']);
        }
        if (array_key_exists('genere_eng', $properties)) {
            $generi->setGenereEng($properties['genere_eng']);
        }
    }

}

?>
