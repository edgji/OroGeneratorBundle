<?php

namespace Edgji\OroGeneratorBundle\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\Container;

use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator;

/**
 * Generates a bundle with Oro Platform configuration defaults.
 *
 * @author Jose Garcia <j.edgji@gmail.com>
 */
class OroBundleGenerator extends BundleGenerator
{
    public function generate($namespace, $bundle, $dir, $format, $structure)
    {
        // include Sensio Bundle Generator generated files as base to work off of
        parent::generate($namespace, $bundle, $dir, $format, false);

        // additional Oro specific bundle file generations
        $this->generateOroBundleFiles($namespace, $bundle, $dir, $format, $structure);
    }

    private function generateOroBundleFiles($namespace, $bundle, $dir, $format, $structure)
    {
        $dir .= '/'.strtr($namespace, '\\', '/');
        $basename = substr($bundle, 0, -6);
        $parameters = array(
            'dir' => $dir,
            'namespace' => $namespace,
            'bundle'    => $bundle,
            'format'    => $format,
            'bundle_basename' => $basename,
            'extension_alias' => Container::underscore($basename),
        );

        $this->renderFile('bundle/oro/config/bundles.yml.twig', $dir.'/Resources/config/oro/bundles.yml', $parameters);
        $this->renderFile('bundle/oro/config/routing.yml.twig', $dir.'/Resources/config/oro/routing.yml', $parameters);
        // $this->renderFile('bundle/oro/navigation.yml.twig', $dir.'/Resources/config/navigation.yml', $parameters);
    }
}
