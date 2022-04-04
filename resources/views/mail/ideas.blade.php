<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello</title>
</head>
<body>
    <div>
        <h1>Hello {{$user->personal_info->first_name}} {{$user->personal_info->last_name}}</h1>
        <h2>Staff submit new Idea on {{$category_mail->category_name}}</h2>
        <p> Please check new idea of staff</p>
     </div>
</body>
</html>