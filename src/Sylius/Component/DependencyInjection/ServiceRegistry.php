<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\DependencyInjection;

/**
 * Default service registry.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class ServiceRegistry implements ServiceRegistryInterface
{
    protected $interface;
    protected $services;

    /**
     * Constructor.
     *
     * @param string $interface Required service interface
     */
    public function __construct($interface)
    {
        $this->interface = $interface;
        $this->services = array();
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->services;
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return array_key_exists($name, $this->services);
    }

    /**
     * {@inheritdoc}
     */
    public function register($name, $service)
    {
        if(!$service instanceof $this->interface) {
            throw new \InvalidArgumentException(sprintf('This service registry requires "%s".', $this->interface));
        }

        $this->services[$name] = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if(!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('Service with name "%s" is not registered.', $name));
        }

        return $this->services[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function unregister($service)
    {
        if(!$this->has($service)) {
            throw new \InvalidArgumentException(sprintf('Service with name "%s" is not registered.', $name));
        }
    }
}
