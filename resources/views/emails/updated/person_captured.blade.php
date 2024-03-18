<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your information has been updated</title>
</head>
<body>
  
    <p>Hello  {{ $person->name }},</p>
    <p>Your information has been updated in the system, you'll be updated when your details are modified:</p>
    <p>Name: {{ $person->name }}</p>
    <p>Surname: {{ $person->surname }}</p>
    <p>South African ID Number: {{ $person->sa_id_number }}</p>
    <p>Mobile Number: {{ $person->mobile_number }}</p>
    <p>Email: {{ $person->email }}</p>
    <p>Birth Date: {{ $person->birth_date }}</p>
    <p>Language: {{ $person->language }}</p>
    <p>Interests:</p>
    <ul>
        @foreach ($person->interests as $interest)
            <li>{{ $interest['text'] }}</li>
        @endforeach
    </ul>
    <p>Thank you.</p>
</body>
</html>
