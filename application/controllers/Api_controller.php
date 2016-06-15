<?php

/**
 * Description of Api_controller
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Api_controller {
    private $config;
    public function __construct () {
        $this->config = Config::getInstance();
    }
    /**
     * Index action
     * @param array $uriData
     */
    public function index ($uriData) {
        $data = ['error'=>true, 'message'=>'Not a valid API call.'];
        View::renderJSON($data);
    }
    /**
     * Get article list
     * @param array $uriData
     */
    public function articles ($uriData) {
        $model = new Article_model(false);
        View::renderJSON(array_values($model->getArticles()));
    }
    /**
     * Get individual article
     * @param array $uriData
     */
    public function article ($uriData) {
        $model = new Article_model(false);
        View::renderJSON($model->getArticle($uriData[2]));
    }
    /**
     * Save article
     * @param array $uriData
     */
    public function save ($uriData) {
        $body = file_get_contents('php://input');
        $response = [];
        if (empty($body)) {
            $response['error'] = true;
            $response['message'] = 'Empty post body. You must send data in a valud format (JSON) to create an article.';
        }
        else {
            $record = json_decode($body, true);
            if (!empty($record) && !empty($record['title'])
                    && !empty($record['content'])) {
                $model = new Api_model();
                $record['id'] = $model->getRecordCount('articles')+1;
                $record['subheader'] = empty($record['subheader']) ? '' : $record['subheader'];
                $record['title_slug'] = preg_replace('/[^a-z0-9\-]/','',preg_replace('/[\s]+/', '-', strtolower($record['title'])));
                $record['author'] = empty($record['author']) ? 'Unknown' : $record['author'];
                $record['published_timestamp'] = time();
                $record['date_published'] = date('D, d F Y', $record['published_timestamp']);
                $record['image'] = empty($record['image']) ? '/img/default.jpg' : $record['image'];
                $record['summary'] = (strlen($record['content']) > 255) ? substr($record['content'], 0, 255) : $record['content'];
                $response = $model->save('articles',$record);
            }
            else {
                $response['error'] = true;
                $response['message'] = 'You must provide at least a title and content to publish an article.';
            }
        }
        View::renderJSON($response);
    }
    /**
     * Update article
     * @param array $uriData
     */
    public function update ($uriData) {
        $body = file_get_contents('php://input');
        $response = [];
        if (empty($body)) {
            $response['error'] = true;
            $response['message'] = 'Empty post body. You must send data in a valud format (JSON) to create an article.';
        }
        else if (isset($uriData[2])) {
            $record = json_decode($body, true);
            $model = new Api_model();
            $response['success'] = $model->update('articles', $record, $uriData[2]);
            $response['message'] = $response['success'] ? 'Article updated successfully.' : 'Article was not found.';
        }
        else {
            $response['error'] = true;
            $response['message'] = 'Article id not found. Article not deleted.';
        }
        View::renderJSON($response);
    }
    /**
     * Delete article
     * @param array $uriData
     */
    public function delete ($uriData) {
        $response = [];
        if (isset($uriData[2])) {
            $model = new Api_model();
            $response['success'] = $model->delete('articles', $uriData[2]);
            $response['message'] = $response['success'] ? 'Article deleted successfully.' : 'Article was not found.';
        }
        else {
            $response['error'] = true;
            $response['message'] = 'Article id not found. Article not deleted.';
        }
        View::renderJSON($response);
    }
}
