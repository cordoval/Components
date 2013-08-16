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
 * Service registry interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ServiceRegistryInterface
{
    /**
     * Return all registered services.
     *
     * @return array
     */
    public function all();

    /**
     * Return all registered services.
     *
     * @param string $name
     *
     * @return Boolean
     */
    public function has($name);

    /**
     * Register service under given name.
     *
     * @param string $name
     * @param object $service
     */
    public function register($name, $service);

    /**
     * Unregister the service.
     *
     * @param string $name
     */
    public function unregister($name);
}
