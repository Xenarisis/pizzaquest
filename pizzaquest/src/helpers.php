<?php 
    function nav_items (string $road, string $title): string {
        $class = 'nav-item';
        if ($_SERVER['SCRIPT_NAME'] === $title ) {
            $class .= ' active';
        }
        return <<<HTML
        <li class="$class">
            <a class="nav-link" href="$road">$title</a>
        </li>
HTML;
    }
?>