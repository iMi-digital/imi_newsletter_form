<?php
/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'iMi\NewsletterForm',
));
/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    'iMi\NewsletterForm\ImiNewsletterFormObserver' => 'system/modules/imi_newsletter_form/classes/ImiNewsletterFormObserver.php',
));

TemplateLoader::addFiles(array
(
    'nl_message_only'            => 'system/modules/imi_newsletter_form/templates',
));
