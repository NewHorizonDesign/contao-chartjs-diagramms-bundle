<?php

declare(strict_types=1);

/*
 * This file is part of Contao ChartJS Diagramms Bundle.
 *
 * (c) Newhorizondesign 2025 <service@newhorizon-design.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/Newhorizondesign/contao-chartjs-diagramms-bundle
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\Database;
use Contao\StringUtil;
use Newhorizondesign\ContaoChartjsDiagrammsBundle\Controller\ContentElement\DiagramElementController;

/**
 * Content elements
 */
$GLOBALS['TL_DCA']['tl_content']['palettes'][DiagramElementController::TYPE] = '{type_legend},type,configSelect;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

/**
 * Palette Manipulator
 */
PaletteManipulator::create()
    ->addLegend('configSelect', 'type_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_content')
;

/**
 *
 * Add additional Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['configSelect'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fields']['configSelect'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_nhd_chartjs_diagramms.title',
    'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
    'options_callback'        => function() {
        $options = array();

        $tariffsConfigurations = Database::getInstance()->prepare('SELECT id,title FROM tl_nhd_chartjs_diagramms')->execute();

        while ($tariffsConfigurations->next()) {
            $options[$tariffsConfigurations->id] = StringUtil::deserialize($tariffsConfigurations->title)['value'];
        }

        return $options;
    }
];
