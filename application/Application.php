<?php
/**
 * Application Class
 * Evaluates request URI and instantiates appropriate controller class.
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Application {
    public static $config;
    private $uriData;
    private $uriDataLen = 0;
    private $controllerInstance;

    public function __construct () {
        self::$config = Config::getInstance();
        $this->uriData = (empty($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '/') ? ['home'] : array_values(array_filter(preg_split('/[\\/]+/', $_SERVER['REQUEST_URI'])));
        $controllerPart = strtolower($this->uriData[0]);
        $this->uriDataLen = count($this->uriData);
        $className = ucfirst($controllerPart).'_controller';
        try {
            if (preg_match('/[^a-zA-Z\_]+/',$className)) {
                $articleController = new Article_controller();
                call_user_func( array($articleController, 'loadArticle'), ['article',$controllerPart]);
            }
            else {
                $this->controllerInstance = new $className;
                $methodName = ($this->uriDataLen > 1) ? lcfirst($this->uriData[1]) : Config::DEFAULT_CONTROLLER_METHOD;
                if (method_exists($this->controllerInstance, $methodName)) {
                    call_user_func( array($this->controllerInstance, $methodName), $this->uriData);
                }
                else if (strtolower($controllerPart) === 'article') {
                    call_user_func( array($this->controllerInstance, 'loadArticle'), $this->uriData);
                }
                else {
                    $this->controllerInstance->index($this->uriData);
                }
            }
        }
        catch (AutoloaderClassNotFound $acnf) {
            // attempt to call method in default Home_controller before calling Notfound_controller.
            $homeController = new Home_controller();
            if (method_exists($homeController, lcfirst($controllerPart))) {
                call_user_func( array($homeController, lcfirst($controllerPart)), $this->uriData);
            }
            else {
                $this->controllerInstance = new Notfound_controller();
                $this->controllerInstance->index();
            }
        }
        catch (Exception $e) {
            $this->controllerInstance = new Error_controller();
            $this->controllerInstance->index($e);
        }
    }
}
