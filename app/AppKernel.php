<?php


use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
            
            // Debut Add sonata Admin
            // These are the other bundles the SonataAdminBundle relies on
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            // And finally, the storage and SonataAdminBundle
            new Sonata\AdminBundle\SonataAdminBundle(),
            // Fin Add sonata Admin
            
            new AppBundle\AppBundle(),
            
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            
            // chart graphique
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            
            // EasyExtends
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            
            // UserBundle
             new FOS\UserBundle\FOSUserBundle(),
             new Sonata\UserBundle\SonataUserBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            
            
            
            // MediaBundle
            new Sonata\MediaBundle\SonataMediaBundle(),
            // You need to add this dependency to make media functional
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            
            
            // Translation
            new Sonata\TranslationBundle\SonataTranslationBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            
            
            // change locale manually from dashboard  sonata
            new Lunetics\LocaleBundle\LuneticsLocaleBundle(),
            
            // TimeLine
            new Sonata\TimelineBundle\SonataTimelineBundle(),
            new Spy\TimelineBundle\SpyTimelineBundle(),
            new Application\Sonata\TimelineBundle\ApplicationSonataTimelineBundle(),
            
            
             new Sonata\IntlBundle\SonataIntlBundle(),
            
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
