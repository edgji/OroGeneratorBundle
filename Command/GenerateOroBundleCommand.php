<?php

namespace Edgji\OroGeneratorBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\HttpKernel\KernelInterface;
use Sensio\Bundle\GeneratorBundle\Manipulator\KernelManipulator;
use Sensio\Bundle\GeneratorBundle\Manipulator\RoutingManipulator;
use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Sensio\Bundle\GeneratorBundle\Command\GenerateBundleCommand;

use Edgji\OroGeneratorBundle\Generator\OroBundleGenerator;

/**
 * Generates OroCRM/Platform bundles.
 *
 * @author Jose Garcia <j.edgji@gmail.com>
 */
class GenerateOroBundleCommand extends GenerateBundleCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setDescription('Generates a bundle with OroCRM/Platform specific bootstraping')
            ->setName('oro:generate:bundle');
    }

    protected function updateKernel(DialogHelper $dialog, InputInterface $input, OutputInterface $output, KernelInterface $kernel, $namespace, $bundle)
    {
        // intentionally left blank
    }

    protected function updateRouting(DialogHelper $dialog, InputInterface $input, OutputInterface $output, $bundle, $format)
    {
        // intentionally left blank
    }

    protected function createGenerator()
    {
        return new OroBundleGenerator($this->getContainer()->get('filesystem'));
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath().'/Resources/EdgjiOroGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get('kernel')->getRootdir().'/Resources/EdgjiOroGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }
}