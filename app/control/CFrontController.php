<?php

class CFrontController {
    
    public function run($requestUri){
        // Parse the request URI
        echo $requestUri;

        $requestUri = trim($requestUri, '/');
        //echo $requestUri;
        $uriParts = explode('/', $requestUri);

        array_shift($uriParts);
        //var_dump($uriParts);

        // Extract controller and method names
        $condition = empty($uriParts[0]);
        //echo $condition == False;
        if ($condition == False) {
            $controllerName = ucfirst($uriParts[0]);
            //echo $controllerName;
        } else {
            $controllerName = 'User';
        }
        /* $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'User'; */
        // var_dump($controllerName);

        $condition = empty($uriParts[1]);
        if ($condition == False) {
            $methodName = $uriParts[1];
        } else {
            $methodName = 'home';
        }
        /* $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'login'; */

        // Load the controller class
        $controllerClass = 'C' . $controllerName;
        // var_dump($controllerClass);
        $controllerFile = __DIR__ . "/{$controllerClass}.php";
        // var_dump($controllerFile);

        //return $controllerClass. "  ". $methodName;
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Check if the method exists in the controller
            if (method_exists($controllerClass, $methodName)) {
                // Call the method
                $params = array_slice($uriParts, 2); // Get optional parameters
                /* $_SERVER['REQUEST_URI'] = "/Slope"; */
                call_user_func_array([$controllerClass, $methodName], $params);
            } else {
                // Method not found, handle appropriately (e.g., show 404 page)
                header('Location: /Slope/User/home');
            }
        } else {
            // Controller not found, handle appropriately (e.g., show 404 page)
            header('Location: /Slope/User/home');
        }
    }
}