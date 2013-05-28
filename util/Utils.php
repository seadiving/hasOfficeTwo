<?php

/**
 * Miscellaneous utility methods.
 */
 final class Utils {

    private function __construct() {
    }

    /**
     * Generate link.
     * @param string $page target page
     * @param array $params page parameters
     */
    public static function createLink($page, array $params = array()) {
        $params = array_merge(array('page' => $page), $params);
        // TODO add support for Apache's module rewrite
        return 'index.php?' .http_build_query($params);
    }

    /**
     * Format date.
     * @param DateTime $date date to be formatted
     * @return string formatted date
     */
    public static function formatDate(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('m/d/Y');
    }

    /**
     * Format date and time.
     * @param DateTime $date date to be formatted
     * @return string formatted date and time
     */
    public static function formatDateTime(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('m/d/Y H:i');
    }

    /**
     * Redirect to the given page.
     * @param type $page target page
     * @param array $params page parameters
     */
    public static function redirect($page, array $params = array()) {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new Exception('URL parameter "' . $name . '" not found.');
        }
        return $_GET[$name];
    }
    
        /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function getPostParam($name) {
        if (!array_key_exists($name, $_POST)) {
            throw new Exception('POST parameter "' . $name . '" not found.');
        }
        return $_POST[$name];
    }

    /**
     * Get {@link Todo} by the identifier 'id' found in the URL.
     * @return Todo {@link Todo} instance
     * @throws NotFoundException if the param or {@link Todo} instance is not found
     */
    public static function getTitoloByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new Exception('No Titolo identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new Exception('Invalid Titolo identifier provided.');
        }
        $dao = new TitoliDao();
        $titoli = $dao->findById($id);
        if ($titoli === null) {
            throw new Exception('Unknown Titolo identifier provided.');
        }
        return $titoli;
    }
    
        public static function getUser() {
        $username = null;
        $password = null;
        try {
            $username = self::getUrlParam('username');
            $password = self::getUrlParam('password');
        } catch (Exception $ex) {
            throw new Exception('No Username identifier provided.');
        }
        $dao = new TitoliDao();
        $titoli = $dao->findById($id);
        if ($titoli === null) {
            throw new Exception('Unknown Titolo identifier provided.');
        }
        return $titoli;
    }

    /**
     * Capitalize the first letter of the given string
     * @param string $string string to be capitalized
     * @return string capitalized string
     */
    public static function capitalize($string) {
        return ucfirst(mb_strtolower($string));
    }

    /**
     * Escape the given string
     * @param string $string string to be escaped
     * @return string escaped string
     */
    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES);
    }
    
    public static function getFormatISRC($isrc) {
    $isrc = str_replace('-', '', $isrc);
    $isrc = substr($isrc, 0, 2)
        . '-' . substr($isrc, 2, 3)
        . '-' . substr($isrc, 5, 2)
        . '-' . substr($isrc, 7);
    return $isrc;
  }

}

?>
