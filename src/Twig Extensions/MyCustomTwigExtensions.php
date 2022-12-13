<?php
    
namespace App\TwigExtensions;

use Doctrine\DBAL\Driver\AbstractException;
use Twig\TwigFilter;

class MyCustomTwigExtensions extends AbstractException
{
    public function getFilters() {

        return [
            // Creation d'un filtre en Twig
            new TwigFilter('defaultImage', [$this, 'defaultImage'])
        ];
    }    

    public function defaultImage(string $path): string {

        if (strlen(trim($path)) == 0 ) {
            return 'photo.jpg';
        }
        return $path;
    }

}
