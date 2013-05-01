<?php


/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
	/**
	 * @ignore
	 */
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../');
}

/** PHPExcel */
require_once PHPEXCEL_ROOT . 'PHPExcel.php';

/** PHPExcel_Worksheet */
require_once PHPEXCEL_ROOT . 'PHPExcel/Worksheet.php';



class PHPExcel_WorksheetIterator extends IteratorIterator
{
	/**
	 * Spreadsheet to iterate
	 *
	 * @var PHPExcel
	 */
	private $_subject;
	
	/**
	 * Current iterator position
	 *
	 * @var int
	 */
	private $_position = 0;

	/**
	 * Create a new worksheet iterator
	 *
	 * @param PHPExcel 		$subject
	 */
	public function __construct(PHPExcel $subject = null) {
		// Set subject
		$this->_subject = $subject;
	}
	
	/**
	 * Destructor
	 */
	public function __destruct() {
		unset($this->_subject);
	}
	
	/**
	 * Rewind iterator
	 */
    public function rewind() {
        $this->_position = 0;
    }

    /**
     * Current PHPExcel_Worksheet
     *
     * @return PHPExcel_Worksheet
     */
    public function current() {
    	return $this->_subject->getSheet($this->_position);
    }

    /**
     * Current key
     *
     * @return int
     */
    public function key() {
        return $this->_position;
    }

    /**
     * Next value
     */
    public function next() {
        ++$this->_position;
    }

    /**
     * More PHPExcel_Worksheet instances available?
     *
     * @return boolean
     */
    public function valid() {
        return $this->_position < $this->_subject->getSheetCount();
    }
}
