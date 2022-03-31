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
        <h1>Hello {{$user->first_name}} {{$user->last_name}}</h1>
        <h2>You have new comment on your <a href="{{ route('idea.show', ['idea' => $idea->id]) }}">{{$idea->idea_title}}</a></h2>
        <p> Please check your idea see who comment</p>
     </div>
</body>
</html>