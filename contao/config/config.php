<?php

$GLOBALS['TL_HOOKS']['processFormData'][] = array('iMi\NewsletterForm\ImiNewsletterFormObserver', 'onProcessFormData');
