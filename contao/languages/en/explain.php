<?php

$GLOBALS['TL_LANG']['XPL']['newsletterModule'] = <<<EOT
<h3>How to use the newsletter functionality in the form generator</h3>
<ol>
<li>Create a form which contains at least field with the name "email".</li>
<li>Create a frontend module of the type "Newsletter &gt; Subscribe" and choose it in this field of the form.</li>
<li>For the frontend module, select the template "nl_message_only" and include it along with this form here in your page.</li>
<li>The "Newsletter &gt; Subscribe" module you include in the page will only show the messages and handle subscription activation.</li>
</ol>
EOT;
