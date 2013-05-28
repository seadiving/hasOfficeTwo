<?php
require_once 'Error.php';
/**
 * Validator for {@link Titoli}.
 * @see TodoMapper
 */
final class TitoliValidator {

    private function __construct() {
    }

    /**
     * Validate the given {@link Titoli} instance.
     * @param Titoli $titoli {@link Titoli} instance to be validated
     * @return array array of {@link Error} s
     */
    public static function validate(Titoli $titoli) {
        $errors = array();
        if (!$titoli->getISRC()) {
            $errors[] = new Error('ISRC', 'Empty or invalid ISRC.');
        }
         if (!trim($titoli->getAnno())) {
            $errors[] = new Error('anno', 'Anno cannot be empty.');
        }
       /* if (!trim($titoli->getPriority())) {
            $errors[] = new Error('priority', 'Priority cannot be empty.');
        } elseif (!self::isValidPriority($titoli->getPriority())) {
            $errors[] = new Error('priority', 'Invalid Priority set.');
        }
        if (!trim($titoli->getStatus())) {
            $errors[] = new Error('status', 'Status cannot be empty.');
        } elseif (!self::isValidStatus($titoli->getStatus())) {
            $errors[] = new Error('status', 'Invalid Status set.');
        }*/
        return $errors;
    }

    /**
     * Validate the given status.
     * @param string $status status to be validated
     * @throws Exception if the status is not known
     */
    public static function validateStatus($status) {
        if (!self::isValidStatus($status)) {
            throw new Exception('Unknown status: ' . $status);
        }
    }

    /**
     * Validate the given priority.
     * @param int $priority priority to be validated
     * @throws Exception if the priority is not known
     */
    public static function validatePriority($priority) {
        if (!self::isValidPriority($priority)) {
            throw new Exception('Unknown priority: ' . $priority);
        }
    }

   /* private static function isValidStatus($status) {
        return in_array($status, Todo::allStatuses());
    }

    private static function isValidPriority($priority) {
        return in_array($priority, Todo::allPriorities());
    }*/

}

?>
