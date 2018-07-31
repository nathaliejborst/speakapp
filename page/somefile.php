<?php

use Speakap\SDK as SpeakapSDK;

$signedRequest = new SpeakapSDK\SignedRequest('/* App ID */', '/* Secret */');

if (!$validator->validateSignature($_POST)) {
    die('Invalid signature');
}

$encSignedReq = $signedRequest->getSignedRequest($_POST);

echo <<<HTML
<html>
    <head>
        <title>Hello World</title>
        <script type="text/javascript">
            var Speakap = { appId: "/* App ID */", signedRequest: "$encSignedReq" };
        </script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/speakap.js"></script>
    </head>

    <body>
    <script type="text/javascript">
        Speakap.doHandshake.then(function() {
            Speakap.getLoggedInUser().then(function(user) {
                document.write('<p>Hello ' + user.fullName + '!</p>');
            });
        });
    </script>
</body>
</html>
HTML;
