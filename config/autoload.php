<?php
// autoload.php — charge automatiquement les classes


spl_autoload_register(function ($class) {
    // Dossiers à explorer pour trouver les classes
    $directories = [
        ROOT_PATH . '/controllers/',
        ROOT_PATH . '/models/',
    ];

    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
