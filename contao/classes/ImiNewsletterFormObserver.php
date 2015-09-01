<?php


namespace iMi\NewsletterForm;


class ImiNewsletterFormObserver
{

    protected function getModule($intId)
    {
        $objRow = \ModuleModel::findByPk($intId);

        if ($objRow === null)
        {
            return null;
        }

        // Check the visibility (see #6311)
        if (!\Controller::isVisibleElement($objRow))
        {
            return null;
        }

        $strClass = \Module::findClass($objRow->type);
        if (!class_exists($strClass))
        {
            static::log('Module class "'.$strClass.'" (module "'.$objRow->type.'") does not exist', __METHOD__, TL_ERROR);
            return null;
        }

        $objRow->typePrefix = 'mod_';
        return new $strClass($objRow, 'main');
    }


    /**
     * Process newsletter subscription if enabled
     *
     * @param $arrSubmitted
     * @param $arrData
     * @param $arrFiles
     * @param $arrLabels
     * @param $that
     */
    public function onProcessFormData($arrSubmitted, $arrData, $arrFiles, $arrLabels, $that)
    {
        $intModule = $that->newsletterModule;
        if (!$intModule) {
            return;
        }

        /** @var $objModule \Contao\ModuleSubscribe */
        $objModule = $this->getModule($intModule);

        // always subscribe all channels
        $arrChannels = unserialize($objModule->nl_channels);
        \Input::setPost('channels', $arrChannels);

        // simulate newsletter form post
        \Input::setPost('FORM_SUBMIT', 'tl_subscribe');
        $objModule->generate();

        \Input::setPost('FORM_SUBMIT', null);
    }

}