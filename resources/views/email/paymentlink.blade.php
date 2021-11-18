<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $name }},
    <br>
    Click on this link or copy it to new browser tab for payment of your Order on Petspace. : 
    <h4><a href="{{$payment_link}}" target="_blank">{{$payment_link}}</a></h4>
    <br>
    <h6>This Link will expire soon in case of expiry contact the adminstrator or sales department for new link</h6>
</div>

</body>
</html>