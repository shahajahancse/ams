<?php

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @return void
     */
    function dd()
    {
        // Get the arguments passed to the function
        $args = func_get_args();

        foreach ($args as $arg) {
            // Start output buffering
            ob_start();

            // Print the argument using print_r
            print_r($arg);

            // Get the output and clean the buffer
            $output = ob_get_clean();

            // Echo the output with a styled <pre> tag
            echo '<pre style="background: black;color: #27ff00;width: fit-content;text-align: left;height: fit-content;">' . $output . '</pre>';
        }

        // Exit the script with a status code of 1
        exit(1);
    }
}