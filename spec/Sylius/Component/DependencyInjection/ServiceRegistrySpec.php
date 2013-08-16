<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\DependencyInjection;

use PhpSpec\ObjectBehavior;

/**
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ServiceRegistrySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Symfony\Component\DependencyInjection\ContainerInterface');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\DependencyInjection\ServiceRegistry');
    }

    function it_implements_Sylius_service_registry_interface()
    {
        $this->shouldImplement('Sylius\Component\DependencyInjection\ServiceRegistryInterface');
    }

    function it_initializes_services_hash_by_default()
    {
        $this->all()->shouldReturn(array());
    }

    /**
     * @param Symfony\Component\DependencyInjection\ContainerAwareInterface $containerAware
     */
    function it_throws_exception_if_invalid_class_instance_given($containerAware)
    {
        $this
           ->shouldThrow('InvalidArgumentException')
           ->duringRegister('foo', $containerAware)
        ;
    }

    /**
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    function it_registers_service_with_given_name($service)
    {
        $this->has('foo')->shouldReturn(false);
        $this->register('foo', $service);

        $this->has('foo')->shouldReturn(true);
        $this->get('foo')->shouldReturn($service);
    }

    /**
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    function it_throws_exception_if_trying_to_register_service_with_taken_name($service)
    {
        $this->register('default', $service);

        $this
            ->shouldThrow('Sylius\Bundle\ShippingBundle\service\Registry\ExistingserviceException')
            ->duringRegister('default', $service)
        ;
    }

    /**
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    function it_unregisters_service_with_given_name($service)
    {
        $this->register('foo', $service);
        $this->unregister('foo');

        $this->has('foo')->shouldReturn(false);
    }

    function it_returns_all_registered_services($foo, $bar)
    {
        $this->register('foo', $foo);
        $this->register('bar', $bar);

        $this->all()->shouldReturn(array('foo' => $foo, 'bar' => $bar));
    }

    function it_throws_exception_if_trying_to_retrieve_non_existing_service()
    {
        $this
            ->shouldThrow('InvalidArgumentException')
            ->duringGet('bar')
        ;
    }
}
