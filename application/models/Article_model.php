<?php
/**
 * Description of Article_model
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Article_model {
    private $pageDetails;
    private $config;
    private $model;
    public function __construct ($pageDetails=true) {
        $this->pageDetails = $pageDetails;
        $this->config = Config::getInstance();
        $db = JSONFileDB::getInstance($this->config->getConfig('data_dir').$this->config->getConfig('data_filename'));
        $this->model = $db->selectOne('pages','page','=','article');
    }
    public function getArticles () {
        $db = JSONFileDB::getInstance($this->config->getConfig('data_dir').$this->config->getConfig('data_filename'));
        $data = $db->selectAll('articles');
        if ($this->pageDetails) {
            $this->model['articles'] = $data;
            return $this->model;
        }
        else {
             return $data;
        }
    }
    public function getArticle ($id) {
        $db = JSONFileDB::getInstance($this->config->getConfig('data_dir').$this->config->getConfig('data_filename'));
        $data = $db->selectOne('articles','id','=',$id);
        if (empty($data)) {
            $data = $db->selectOne('articles','title_slug','=',$id);
            $this->model['article'] = empty($data) ? [] : $data;
        }
        $this->model['article_id'] = empty($data) ? 0 : $data['id'];
        if ($this->pageDetails) {
            $this->model['article'] = $data;
            return $this->model;
        }
        else {
            return $data;
        }
    }
    public function getModel () {
        return $this->model;
    }
}
