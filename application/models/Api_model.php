<?php
/**
 * Description of Api_model
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Api_model {
    private $config;
    private $dataFile;
    private $db;
    public function __construct () {
        $this->config = Config::getInstance();
        $this->dataFile = $this->config->getConfig('data_dir').$this->config->getConfig('data_filename');
        $this->db = JSONFileDB::getInstance($this->dataFile);
    }
    /**
     * Get array count of collection
     * @param array $collection
     * @return int
     */
    public function getRecordCount ($collection) {
        if (empty($collection)) {
            return 0;
        }
        else { 
            return $this->db->collectionCount($collection);
        }
    }
    /**
     * Save record into collection
     * @param array $collection
     * @param array $record
     * @return array
     */
    public function save ($collection, $record) {
        $this->db->createRecord($collection, $record);
        return $this->db->selectAll($collection);
    }
    /**
     * Update record in collection
     * @param array $collection
     * @param array $record
     * @param int $id
     * @return array
     */
    public function update ($collection, $record, $id) {
        return $this->db->updateRecord($collection, $record, 'id', '=', $id);
    }
    /**
     * Delete record from collection
     * @param array $collection
     * @param int $id
     * @return array
     */
    public function delete ($collection, $id) {
        return $this->db->delete($collection, 'id', '=', $id);
    }
}
