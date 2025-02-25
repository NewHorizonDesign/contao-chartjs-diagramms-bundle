<?php

declare(strict_types=1);

/*
 * This file is part of Contao ChartJS Diagramms.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms
 */

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle;

use Newhorizondesign\ContaoChartjsDiagrammsBundle\DependencyInjection\NewhorizondesignContaoChartjsDiagrammsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NewhorizondesignContaoChartjsDiagrammsBundle extends Bundle
{
	public function getContainerExtension(): NewhorizondesignContaoChartjsDiagrammsExtension
	{
		return new NewhorizondesignContaoChartjsDiagrammsExtension();
	}
}
