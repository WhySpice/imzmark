<?php
/*
# Welcome to WHYSPICE OS 0.0.1 (GNU/Linux 3.13.0.129-generic x86_64)

root@localhost:~ bash ./whyspice-work.sh
> Executing...

         _       ____  ____  _______ ____  ________________
        | |     / / / / /\ \/ / ___// __ \/  _/ ____/ ____/
        | | /| / / /_/ /  \  /\__ \/ /_/ // // /   / __/
        | |/ |/ / __  /   / /___/ / ____// // /___/ /___
        |__/|__/_/ /_/   /_//____/_/   /___/\____/_____/

                            Web Dev.
                WHYSPICE © 2024 # whyspice.su

> Disconnecting.

# Connection closed by remote host.
*/
class Router
{
    private $basePath;
    private array $routes = [];
    private array $settings;

    public function __construct($basePath = '')
    {
        $this->basePath = $basePath;
        $this->settings = [];
    }

    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function addRoute($methods, $path, $handler)
    {
        if (!is_array($methods)) {
            $methods = explode('|', $methods);
        }

        foreach ($methods as $method) {
            $this->routes[] = [
                'method' => strtoupper($method),
                'path' => $this->basePath . $path,
                'handler' => $handler,
                'settings' => $this->settings
            ];
        }
    }

    public function handleRequest($method, $path)
    {
        foreach ($this->routes as $route) {
            $pattern = '#^' . preg_replace('#\{([a-zA-Z]+)\}#', '([^/]+)', $route['path']) . '$#';
            if (in_array(strtoupper($method), (array)$route['method']) && preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                $handler = $route['handler'];

                $settings = $route['settings'];

                $handler($settings, ...$matches);

                return;
            }
        }

        http_response_code(404);
        include_once('pages/bootstrap/404.php');
    }
}



