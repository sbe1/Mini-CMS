<?php
/**
 * Description of View
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class View {
    private static $pattern = '/\[\[([\S\s]*?)\]\]/';
    /**
     * Simple template parser. Does not support loops or complex logic.
     * @param string $view
     * @param array $data
     * @return string
     */
    public static function parse ($view, $data) {
        $m = [];
        preg_match_all(self::$pattern, $view, $m);
        $mlen = count($m[1]);
        for ($i=0;$i<$mlen;$i++) {
            $view = preg_replace('/\[\['.$m[1][$i].'\]\]/', $data[$m[1][$i]], $view);
        }
        return $view;
    }
    /**
     * Render standard view.
     * @param string $view
     * @param array $data
     * @throws Exception
     */
    public static function renderView ($view, array $data) {
        $config = Config::getInstance();
        $viewFile = $config->getConfig('view_dir').$view.'_view.php';
        if (file_exists($viewFile)) {
            ob_start();
            include_once $config->getConfig('view_dir').$view.'_view.php';
            $str = ob_get_clean( );
            echo self::parse($str, $data);
        }
        else {
            throw new Exception('View \''.$view.'\'not found.');
        }
    }
    /**
     * Render data as JSON text.
     * @param array $data
     * @param boolean $cache
     */
    public static function renderJSON ($data, $cache=false) {
        if (!$cache) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Thu, 19 Aug 1971 05:00:00 GMT');
        }
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($data, JSON_OBJECT_AS_ARRAY);
    }
}
