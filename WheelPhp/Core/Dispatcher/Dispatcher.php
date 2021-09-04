<?php

namespace WheelPhp\Core\Dispatcher;

use WheelPhp\Core\Config\Config;
use WheelPhp\Core\Exceptions\ActionNotFound;
use WheelPhp\Core\Exceptions\ControllerNotFound;
use WheelPhp\Core\Exceptions\AutoloadClassNotFound;
use WheelPhp\Core\Exceptions\ValidatorNotFound;
use WheelPhp\Core\Http\Request;
use WheelPhp\Core\Validator\Validator;

class Dispatcher
{
    protected array $data;

    protected Request $request;

    protected Response $response;

    public function __construct()
    {
        $this->data = [];
    }

    public function setParam(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function setParams(array $params)
    {
        $this->data = $params;
    }

    public function deleteParam(string $name)
    {
        unset($this->data[$name]);
    }

    public function dispatch(Request $request, $response = null)
    {
        $requestUri = explode("?", $request->get("server")['REQUEST_URI'])[0];
        $requestUri = explode("#", $requestUri)[0];

        $routes = Config::get("routes");
        $application = Config::get("app");
        $controllerDir = $application["controller_namespace"];
        $validatorCoreDir = $application["validator_namespace_core"];
        $validatorUserDir = $application["validator_namespace_user"];

        $controllerLoaded = false;
        foreach ($routes as $route) {
            $urlTemplate = array_key_first($route);
            $route = reset($route);
            if ($route['validator']) {
                $validator = null;

                $userValidatorExists = "";
                $coreValidatorExists = "";

                //autoloader throws exception here
                try {
                    $userValidatorExists = class_exists($validatorUserDir . $route['validator']);
                } catch (AutoloadClassNotFound $e) {}

                try {
                    $coreValidatorExists = class_exists($validatorCoreDir . $route['validator']);
                } catch (AutoloadClassNotFound $e) {}

                if ($userValidatorExists) {
                    $validatorName = $validatorUserDir . $route['validator'];
                } elseif ($coreValidatorExists) {
                    $validatorName = $validatorCoreDir . $route['validator'];
                } else {
                    throw new ValidatorNotFound();
                }
                /** @var Validator $validator */
                $validator = new $validatorName();
                $matches = $validator->satisfies($urlTemplate, $requestUri);
                if ($matches) {
                    $controllerName = $controllerDir . ucfirst($route['controller']);
                    if (!class_exists($controllerName)) {
                        throw new ControllerNotFound();
                    }
                    $controller = new $controllerName();
                    if (method_exists($controller, $route['action'] . "Action")) {
                        $controllerLoaded = true;
                        $controller->{$route['action'] . "Action"}();
                        break;
                    } else {
                        throw new ActionNotFound();
                    }
                }
            }
        }
        if (!$controllerLoaded) {
            throw new ControllerNotFound();
        }
    }


}