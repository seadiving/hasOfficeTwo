<?php
//set_include_path('.:/opt/local/share/pear/'); 

final class Index {

    const DEFAULT_PAGE = 'login/login';
    const LAYOUT_DIR = '../layout/';


    /**
     * System config.
     */
    public function init() {
        // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
        error_reporting(E_ALL | E_STRICT);
        //mb_internal_encoding('UTF-8');
        set_exception_handler(array($this, 'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
        // session
        //if(!array_key_exists('user',$_SESSION)){
           
           if(isset($_SESSION['user'])){

              //echo "lo user esiste";
           }else{
             session_start();
              //echo "lo user non esiste";
           }
       //}
    }

    /**
     * Run the application!
     */
    public function run() {
        //echo 'carico la pagina';
        $this->runPage($this->getPage());
        //echo 'sto uscendo dal run';
    }

    /**
     * Exception handler.
     */
    public function handleException(Exception $ex) {
        $extra = array('message' => $ex->getMessage());
        if ($ex instanceof Exception) {
            header('HTTP/1.0 404 Not Found');
            $this->runPage('404', $extra);
        } else {
            // TODO log exception
            header('HTTP/1.1 500 Internal Server Error');
            $this->runPage('500', $extra);
        }
    }

    /**
     * Class loader.
     */
    public function loadClass($name) {
        $classes = array(
            'Config' => '../config/Config.php',
            'Error' => '../validation/Error.php',
            'Flash' => '../flash/Flash.php',
            'NotFoundException' => '../exception/NotFoundException.php',
            'TitoliDao' => '../dao/TitoliDao.php',
            'UserDao' => '../dao/UserDao.php',
            'TitoliMapper' => '../mapping/TitoliMapper.php',
            'Titoli' => '../model/Titoli.php',
            'Utente' => '../model/Utente.php',
            'Permesso' => '../model/Permesso.php',
            'TitoliSearchCriteria' => '../dao/TitoliSearchCriteria.php',
            'UserSearchCriteria' => '../dao/UserSearchCriteria.php',
            'TitoliValidator' => '../validation/TitoliValidator.php',
            'Utils' => '../util/Utils.php',
            'Pager_Common' => '../Pager/Common.php',
            'Pager_Sliding' => '../Pager/Sliding.php',
			'Pager_Jumping' => '../Pager/Jumping.php',
            'Pager' => '../Pager/Pager.php'
			
        );
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];

    }

    private function getPage() {
        $page = self::DEFAULT_PAGE;
        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
        }
        //echo 'valore di getPage'.$_GET['page'];
        return $this->checkPage($page);
    }

    private function checkPage($page) {
        /*if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new Exception('Unsafe page "' . $page . '" requested');
        }*/
        //echo 'a';
        if (!$this->hasScript($page) && !$this->hasTemplate($page)) {
            // TODO log attempt, redirect attacker, ...
            throw new Exception('Page "' . $page . '" not found');
        }
        return $page;
    }

    private function runPage($page, array $extra = array()) {
        $run = false;
        //echo 'run1';
        if ($this->hasScript($page)) {
            $run = true;
            //echo 'run11';
            require_once $this->getScript($page);
            //echo 'run111';
        }
         //echo 'run2';
        if ($this->hasTemplate($page)) {
            $run = true;
            // data for main template
            $template = $this->getTemplate($page);
            $flashes = null;
            if (Flash::hasFlashes()) {
                $flashes = Flash::getFlashes();
            }
             //echo 'run3';

            // main template (layout)
            require self::LAYOUT_DIR . 'index.phtml';
        }
        if (!$run) {
            die('Page "' . $page . '" has neither script nor template!');
        }
    }

    private function getScript($page) {
        //echo 'pagina '.$page . 'Inc.php';
        return $page . 'Inc.php';
    }

    private function getTemplate($page) {
        return $page . 'Temp.php';
    }

    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    private function hasTemplate($page) {
        return file_exists($this->getTemplate($page));
    }

}

$index = new Index();
$index->init();
// run application!
$index->run();

?>
