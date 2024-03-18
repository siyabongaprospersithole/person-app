Your information has been {{$type_}}

Hello  {{ $person->name }},

Your information has been {{$type_}} in the system, you'll be updated when your details are modified:

Name: {{ $person->name }}
Surname: {{ $person->surname }}
South African ID Number: {{ $person->sa_id_number }}
Mobile Number: {{ $person->mobile_number }}
Email: {{ $person->email }}
Birth Date: {{ $person->birth_date }}
Language: {{ $person->language }}
Interests:
@foreach ($person->interests as $interest)
    - {{ $interest['text'] }}
@endforeach

Thank you.
