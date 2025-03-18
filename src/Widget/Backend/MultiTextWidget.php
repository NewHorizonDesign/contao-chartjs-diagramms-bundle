<?php

namespace Newhorizondesign\ContaoChartjsDiagrammsBundle\Widget\Backend;

use Contao\Backend;
use Contao\BackendTemplate;
use Contao\BackendUser;
use Contao\System;
use Contao\Widget;

class MultiTextWidget extends Widget
{
    protected $blnSubmitInput = true;
    protected $blnForAttribute = true;
    protected $strTemplate = 'be_multi_text_widget';
    protected $strPrefix = 'widget-multi-text-field';

    public function generate($arrAttributes = null)
    {
        System::loadLanguageFile('default');

        return '';
    }

    public function parse($arrAttributes = null, $arrConfiguration = [])
    {
        $template = new BackendTemplate($this->strTemplate);

        $template->theme = (BackendUser::getInstance()->theme == 'dark') ? 'ace/theme/twilight' : 'ace/theme/clouds';
        $template->arrConfiguration = $this->arrConfiguration;
        $template->arrAttributes = $this->arrAttributes;
        $template->strPrefix = $this->strPrefix;
        $template->strLabel = $this->strLabel;
        $template->strName = $this->strName;
        $template->varValue = $this->varValue;

        return $template->parse();
    }
}