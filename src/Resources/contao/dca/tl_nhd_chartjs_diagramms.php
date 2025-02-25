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

use Contao\Backend;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Input;

/**
 * Table tl_nhd_chartjs_diagramms
 */
$GLOBALS['TL_DCA']['tl_nhd_chartjs_diagramms'] = [
    'config'      => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary'
            ]
        ],
    ],
    'list'        => [
        'sorting'           => [
            'mode'        => 1,
            'fields'      => ['chartGroup','title'],
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit',
            'group_callback' => ['tl_nhd_chartjs_diagramms', 'groupChartGroup']
        ],
        'label'             => [
            'fields' => ['id','title'],
            'showColumns'  => true,
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ],
        'operations'        => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg'
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.svg'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ],
            'show'   => [
                'label'      => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ],
        ]
    ],
    'palettes'    => [
        '__selector__' => ['addSubpalette'],
        'default'      => '{first_legend},chartGroup,title,chartType,size,cssID,cssClass;{second_legend},activeAnimation,responsiveWidth,singleSRC,jsonInput,jsonInputLabels,jsonInputOptions;'
    ],
    'fields'      => [
        'chartGroup'   => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'long clr'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'id'             => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'  => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'title'          => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'long clr'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'chartType'    => [
            'inputType' => 'select',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'options'   => &$GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['chartTypes']['options'],
            'eval'      => ['submitOnChange' => true, 'includeBlankOption' => false, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
        ],
        'size' => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['multiple' => true, 'size' => 2, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'cssID'  => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'cssClass'  => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'activeAnimation'  => [
            'inputType'  => 'checkbox',
            'sql' => [
                'type'  => 'boolean',
                'default'  => false,
            ],
            'eval'  => ['tl_class' => 'w50 m12'],
        ],
        'responsiveWidth' => [
            'inputType' => 'checkbox',
            'sql' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'eval'  => ['tl_class' => 'w50 m12'],
        ],
        'jsonInput'  => [
            'inputType' => 'textarea',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['rte' => 'ace|js', 'mandatory' => true, 'tl_class' => 'long clr m12'],
            'sql'       => "text NOT NULL default ''",
            'load_callback' => [
                ['tl_nhd_chartjs_diagramms', 'jsonInputCallback']
            ]
        ],
        'jsonInputLabels'  => [
            'inputType' => 'textarea',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['rte' => 'ace|js', 'mandatory' => true, 'tl_class' => 'long clr m12'],
            'sql'       => "text NOT NULL default ''",
            'load_callback' => [
                ['tl_nhd_chartjs_diagramms', 'jsonInputLabelsCallback']
            ]
        ],
        'jsonInputOptions'  => [
            'inputType' => 'textarea',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'eval'      => ['rte' => 'ace|js', 'mandatory' => true, 'tl_class' => 'long clr m12'],
            'sql'       => "text NOT NULL default ''",
            'load_callback' => [
                ['tl_nhd_chartjs_diagramms', 'jsonInputOptionsCallback']
            ]
        ],
    ]
];

$GLOBALS['TL_DCA']['tl_nhd_chartjs_diagramms']['config']['onsubmit_callback'][] = ['tl_nhd_chartjs_diagramms', 'groupChartGroup'];

class tl_nhd_chartjs_diagramms extends Backend
{
    public function groupChartGroup($group, $mode, $field, $row, DataContainer $dc)
    {
        var_dump($group); exit;
        return '<div style="background:#f3f3f3; font-weight:bold; padding:5px; border-bottom:1px solid #ddd;">
                    <span style="color:#4a90e2;">' . htmlspecialchars($group) . '</span>
                </div>';
    }

    public function jsonInputOptionsCallback($varValue, DataContainer $dc)
    {
        if(!empty($varValue)) {
            return $varValue;
        } else {
            return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInputOptions']['default']);
        }
    }

    public function jsonInputLabelsCallback($varValue, DataContainer $dc)
    {
        if(!empty($varValue)) {
            return $varValue;
        } else {
            return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInputLabels']['default']);
        }
    }

    public function jsonInputCallback($varValue, DataContainer $dc)
    {
        if(!empty($varValue)) {
            return $varValue;
        } else {
            switch($dc->activeRecord->chartType) {
                case 'bar':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['bar']);
                    break;
                case 'bubble':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['bubble']);
                    break;
                case 'line':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['line']);
                    break;
                case 'scatter':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['scatter']);
                    break;
                case 'pie':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['pie']);
                    break;
                case 'doughnut':
                    return json_decode($GLOBALS['TL_LANG']['tl_nhd_chartjs_diagramms']['fields']['jsonInput']['default']['doughnut']);
                    break;
                default:
                    return " ";
                    break;
            }
        }
    }
}
